<?php

class methods_creditcard extends methods_Abstract {

  /**
   * Payment method callback: checkout form submission.
   */
  public function submitFormCharge($payment_method, $pane_form, $pane_values, $order, $charge) {
    
    $config = parent::submitFormCharge($payment_method, $pane_form, $pane_values, $order, $charge);
    $instance = ubercart_checkoutpayment_get_instance($payment_method);
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
      drupal_get_path('module', 'ubercart_checkoutpayment') . '/includes/methods/js/checkoutapi.js' => array(
        'type' => 'file',
      ),
    );

    $form['#attached']['js'][] = array(
      'data' => array('ubercart_checkoutpayment' => $data['script']),
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
  public function getExtraInit($order) {

    $array = array();

    $payment_token = $this->generatePaymentToken($order);

    if ($order) {
      $order_wrapper    = entity_metadata_wrapper('ubercart_order', $order);
      $billing_address  = null; //TODO
      $order_array      = null; //TODO
      $default_currency = "USD"; //TODO
      $amount_cents     = number_format(round($order->order_total, variable_get('uc_currency_prec', 2)) * 100, 0, '', '');
      $config           = array();

      $config['publicKey']    = variable_get('public_key', '');
      $config['mode']         = variable_get('mode', '');
      $config['logourl']      = variable_get('logourl', '');
      $config['title']        = variable_get('title', '');
      $config['themecolor']   = variable_get('themecolor', '');
      $config['currencycode'] = variable_get('uc_currency_code', 'EUR');
      $config['email']        = $order->primary_email;
      $config['name']         = "Test name"; //TODO
      $config['amount']       = $amount_cents;
      $config['currency']     = $default_currency;
      $config['paymentMode']  = variable_get('paymentMode', '');
      $config['paymentToken'] = $payment_token;//['token'];

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
  public function generatePaymentToken($order) {

    $config = array();

    $product_items = $order->products;

    if (isset($order)) {

      $order_id = $order->order_id;
      $default_currency = "USD"; //TODO
      $amount_cents = number_format(100000, 0, '', ''); //TODO

      $secret_key = variable_get('private_key', '');
      $mode       = variable_get('mode', '');
      $timeout    = variable_get('autocaptime', '');

      $config['authorization'] = $secret_key;
      $config['mode']          = $mode;
      $config['timeout']       = $timeout;

      // if ($payment_method['settings']['payment_action'] == 'authorize') {

      //   $config = array_merge($config, $this->authorizeConfig());
      // }
      // else {

      //   $config = array_merge($config, $this->captureConfig($payment_method));
      // }

      $products = array();
      if (!empty($product_items)) {
        foreach ($product_items as $key => $item) {  
          if(isset($item)){
            // $product_id = $item->order_product_id;
            // $product    = $item->title;
            // $price      = $item->price;
            // $sell_price = $item->sell_price;

            $products[$key] = array(
              'name'     => $item->title,
              'sku'      => $item->qty,
              'price'    => $item->sell_price,
              'quantity' => $item->qty,
            );
          }
        }
      }
    
      $billing_address_config = array(
        'addressLine1'  => $order->billing_street1,
        'addressLine2'  => $order->billing_street2,
        'postcode'      => $order->billing_postal_code,
        'country'       => $order->billing_country,
        'city'          => $order->billing_city,
      );

      $shipping_address_config = NULL;
      if (module_exists('uc_shipping')) {
        // Add the shipping address parameters to the request.
        $shipping_address_config = array(
          'addressLine1'  => $order->delivery_street1,
          'addressLine2'  => $order->delivery_street2,
          'postcode'      => $order->delivery_postal_code,
          'country'       => $order->delivery_country,
          'city'          => $order->delivery_city,
        );
      }

      $config['postedParam'] = array(
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

      $api = CheckoutApi_Api::getApi(array('mode' => $mode));

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

    $payment_method = ubercart_payment_method_instance_load('ubercart_checkoutpayment|ubercart_payment_ubercart_checkoutpayment');
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

}
