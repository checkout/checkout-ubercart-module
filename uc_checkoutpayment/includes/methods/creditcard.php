<?php

class methods_creditcard extends methods_Abstract {

  /**
   * Payment method callback: checkout form submission.
   */
  public function submitFormCharge($payment_method, $pane_form, $pane_values, $order, $charge) {    
    $config = parent::submitFormCharge($payment_method, $pane_form, $pane_values, $order, $charge);
    $instance = uc_checkoutpayment_get_instance($payment_method);
    $data = $instance->getExtraInit($order, $payment_method);

  }

  /**
   * Payment method callback: checkout form.
   */
  public function submitForm($payment_method, $pane_values, $checkout_pane, $order) {
    $data = $this->getExtraInit($order, $payment_method);
    $form['pay_method_container'] = array(
      '#type' => 'container',
      '#attributes' => array(
        'class' => array('widget-container'),
      ),
    );

    $form['credit_card']['cko-cc-paymenToken'] = array(
      '#type' => 'hidden',
      '#value' => !empty($data['paymentToken']['token']) ? $data['paymentToken']['token'] : '',
      '#attributes' => array(
        'id' => array('cko-cc-paymenToken'),
      ),
    );

    $form['#attached']['js'] = array(
      drupal_get_path('module', 'uc_checkoutpayment') . '/includes/methods/js/checkoutapi.js' => array(
        'type' => 'file',
      ),
    );

    $form['#attached']['js'][] = array(
      'data' => array('uc_checkoutpayment' => $data['script']),
      'type' => 'setting',
    );

    return $form;
  }

  /**
   * Payment method settings form.
   *
   * @param $order
   * The order transaction
   * @param $payment_method
   * The payment method used
   *
   * @return array
   *   Settings form array
   */
  public function getExtraInit($order, $payment_method) {
    $array = array();

    $payment_token = $this->generatePaymentToken($order, $payment_method);

    if ($order) {
      $order_wrapper    = entity_metadata_wrapper('uc_order', $order);
      $order_array      = null; //TODO
      $default_currency = variable_get('uc_currency_code', 'EUR');
      $amount_cents     = number_format(round($order->order_total, variable_get('uc_currency_prec', 2)) * 100, 0, '', '');
      $config           = array();

      $config['email']        = $order->primary_email;
      $config['name']         = $order->billing_first_name . ' ' . $order->billing_last_name;
      $config['amount']       = $amount_cents;
      $config['currency']     = $order->currency;
      $config['paymentToken'] = $payment_token['token'];

      $config['billingDetails'] = array(
        'addressLine1'  => $order->billing_street1,
        'addressLine2'  => $order->billing_street2,
        'postcode'      => $order->billing_postal_code,
        'country'       => uc_get_country_data(array('country_id' => $order->billing_country))[0]['country_iso_code_2'],
        'city'          => $order->billing_city,
        'state'         => $order->delivery_zone,
        'phone'         => array( 
          "number"        => $order->billing_phone
        )
      );

      $config['shippingDetails'] = array(
        'addressLine1'  => $order->delivery_street1,
        'addressLine2'  => $order->delivery_street2,
        'postcode'      => $order->delivery_postal_code,
        'country'       => uc_get_country_data(array('country_id' => $order->delivery_country))[0]['country_iso_code_2'],
        'city'          => $order->delivery_city,
        'state'         => $order->delivery_zone,
        'phone'         => array(
          "number"        => $order->delivery_phone
        )
      );

      foreach ($order->products as $order_product_id => $product) {    
        $config['products'][] = array(
          'name'        => $product->title,
          'description' => $product->title,
          'price'       => round($product->price, 2),
          'quantity'    => (int)$product->qty,
          'sku'         => $product->model,
        );
      }

      $array['script']       = $config;
      $array['paymentToken'] = $payment_token;
    }

    return $array;
  }

  /**
   * Generate payment token.
   *
   * @param $order
   * The order transaction
   * @param $payment_method
   * The payment method used
   *
   * @return array
   * Payment token form array
   */
  public function generatePaymentToken($order, $payment_method) {
    $config = array();

    $product_items = $order->products;

    if (isset($order)) {

      $order_id = $order->order_id;
      $default_currency = $order->currency;
      $amount_cents = number_format((100 * $order->order_total), 0, '', '');
      $autoCapture = ($payment_method['settings']['payment_action'] == UC_CREDIT_AUTH_CAPTURE ? "y" : "n");

      $config['authorization'] = $payment_method['settings']['private_key'];
      $config['mode']          = $payment_method['settings']['mode'];
      $config['timeout']       = $payment_method['settings']['timeout'];

      if ($payment_method['settings']['payment_action'] == 'authorize') {
        $config = array_merge($config, $this->authorizeConfig());
      }
      else {
        $config = array_merge($config, $this->captureConfig($payment_method));
      }

      $products = array();
      if (!empty($product_items)) {
        foreach ($product_items as $key => $item) {  
          if(isset($item)){
            $products[$key] = array(
              'name'     => $item->title,
              'sku'      => $item->qty,
              'price'    => $item->price,
              'quantity' => $item->qty,
            );
          }
        }
      }
    
      $billing_address_config = array(
        'addressLine1'  => $order->billing_street1,
        'addressLine2'  => $order->billing_street2,
        'postcode'      => $order->billing_postal_code,
        'country'       => uc_get_country_data(array('country_id' => $order->billing_country))[0]['country_iso_code_2'],
        'city'          => $order->billing_city,
        'state'         => $order->delivery_zone,
        'phone'         => array(
                             "number"      => $order->billing_phone
                           )
      );

      $shipping_address_config = array(
        'addressLine1'  => $order->delivery_street1,
        'addressLine2'  => $order->delivery_street2,
        'postcode'      => $order->delivery_postal_code,
        'country'       => uc_get_country_data(array('country_id' => $order->delivery_country))[0]['country_iso_code_2'],
        'city'          => $order->delivery_city,
        'state'         => $order->delivery_zone,
        'phone'         => array(
                            "number"      => $order->delivery_phone
                          )
      );

      $config['postedParam'] = array(
        'chargeMode'      => "3", // Should always be 3 in a payment token
        'autoCapture'     => $autoCapture, 
        'autoCapTime'     => $payment_method['settings']['autocaptime'],
        'email'           => $order->primary_email,
        'value'           => $amount_cents,
        'trackId'         => $order_id,
        'currency'        => $default_currency,
        'description'     => 'Order number::' . $order_id,
        'shippingDetails' => $shipping_address_config,
        'products'        => $products,
        'card'            => array(
                              'billingDetails' => $billing_address_config,
                             ),
      );

      $api = CheckoutApi_Api::getApi(array('mode' => $config['mode']));

      $payment_token_charge = $api->getPaymentToken($config);

      $payment_token_array = array(
        'message' => '',
        'success' => '',
        'eventId' => '',
        'token' => '',
      );

      if ($payment_token_charge->isValid()) {
        $payment_token_array['token'] = $payment_token_charge->getId();
        $payment_token_array['success'] = TRUE;
      }
      else {
        $payment_token_array['message'] = $payment_token_charge->getExceptionState()->getErrorMessage();
        $payment_token_array['success'] = FALSE;
        $payment_token_array['eventId'] = $payment_token_charge->getEventId();
      }
    }
    
    return $payment_token_array;
  }

  /**
   * Create charge settings.
   *
   * @param $config
   * Charge settings
   *
   * @return array
   * Settings form array
   */
  protected function createCharge($config) {
    $config = array();

    $payment_method = ubercart_payment_method_instance_load('uc_checkoutpayment|ubercart_payment_uc_checkoutpayment');
    $secret_key = $payment_method['settings']['private_key'];
    $mode = $payment_method['settings']['mode'];
    $timeout = $payment_method['settings']['timeout'];

    $config['authorization'] = $secret_key;
    $config['timeout'] = $timeout;
    $config['paymentToken'] = $_POST['cko-cc-paymenToken'];

    $api = CheckoutApi_Api::getApi(array('mode' => $mode));
    return $api->verifyChargePaymentToken($config);
  }

  /**
   * Capture config settings.
   *
   * @param $action
   * Capture charge settings
   *
   * @return array
   * Settings form array
   */
  protected function captureConfig($action) {
    $to_return['postedParam'] = array(
      'autoCapture' => CheckoutApi_Client_Constant::AUTOCAPUTURE_CAPTURE,
      'autoCapTime' => $action['settings']['autocaptime'],
    );
    return $to_return;
  }

  /**
   * Authorize config settings.
   *
   * @return array
   * Settings form array
   */
  protected function authorizeConfig() {
    $to_return['postedParam'] = array(
      'autoCapture' => CheckoutApi_Client_Constant::AUTOCAPUTURE_AUTH,
      'autoCapTime' => 0,
    );
    return $to_return;
  }

  /**
   * Create capture
   *
   * @param $config
   * Capture settings
   *
   * @return array
   * Settings form array
   */
  public function captureCharge($order, $payment_method, $value) {
    $config = array();

    $secret_key = $payment_method['settings']['private_key'];
    $mode       = $payment_method['settings']['mode'];


    $result = db_select('uc_checkoutpayment_charge_details', 'c')
      ->fields('c')
      ->condition('order_id', $order->order_id,'=')
      ->condition('transaction_type', "succeeded",'=')
      ->execute()
      ->fetchObject();

    $config['authorization'] = $secret_key;
    $config['chargeId']      = $result->charge_id;
    $config['postedParam']   = array( 
       'value' => $value 
    );

    $api = CheckoutApi_Api::getApi(array('mode' => $mode));
    $api->captureCharge($config);
  }

  /**
   * Refund
   *
   * @param $config
   * Refund settings
   *
   * @return array
   * Settings form array
   */
  public function refundCharge($order, $payment_method, $value) {
    $payedAmount = ($order->order_total - uc_payment_balance($order)) * 100;

    if($value <= $payedAmount){
      
      $config = array();

      $secret_key = $payment_method['settings']['private_key'];
      $mode       = $payment_method['settings']['mode'];

      $result = db_select('uc_checkoutpayment_charge_details', 'c')
        ->fields('c')
        ->condition('order_id', $order->order_id,'=')
        ->condition('transaction_type', "captured",'=')
        ->execute()
        ->fetchObject();

      $config['authorization'] = $secret_key;
      $config['chargeId']      = $result->charge_id;
      $config['postedParam']   = array( 
        'value' => $value 
      );

      $api = CheckoutApi_Api::getApi(array('mode' => $mode));
      return $api->refundCharge($config);
    }    
  }
}
