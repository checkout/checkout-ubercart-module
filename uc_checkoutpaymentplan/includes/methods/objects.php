<?php

/**
 * The Checkout.com Payment Plan
 */
class PaymentPlan {
  public $id;
  public $name;
  public $trackId;
  public $autoCapTime;
  public $currency;
  public $value;
  public $cycle;
  public $recurringCount;
  public $status;

  /**
   * Get a paymentplan from the Checkout.com server.
   *
   * How to use this:
   *   $payment_plan = new PaymentPlan;
   *   $payment_plan->id = 'rp_000000000000000';
   *   $payment_plan->get();
   * 
   *   $payment_plan = new PaymentPlan;
   *   $payment_plan->trackId = 'example_tracker';
   *   $payment_plan->get();
   *
   * @return bool
   *   Returns true if succeeded or false (with drupal message) when failed.
   */
  public function get() {
    if ($this->db_get() || $this->api_get() || $this->api_query()) {
      return TRUE;
    }

    return FALSE;
  }

  public function getString($property) {

    if (property_exists($this, $property)) {
      switch ($property) {
        case 'id':
          return $this->id;
          break;

        case 'name':
          return $this->name;
          break;
      
        case 'trackId':
          return $this->trackId;
          break;

        case 'autoCapTime':
          return $this->autoCapTime . ' seconds';
          break;

        case 'currency':
          return $this->currency;
          break;

        case 'value':
          return uc_currency_format($this->value/100);
          break;

        case 'cycle': {
          if (($totalCount = substr($this->cycle, 0, -1)) == 1) {
            switch (strtolower(substr($this->cycle, -1))) {
              case 'd':
                return t('Every day');
                break;
    
              case 'w':
                return t('Every week');
                break;
    
              case 'm':
                return t('Every month');
                break;
    
              case 'y':
                return t('Every year');
                break;
            }
          }
          else {
            switch (strtolower(substr($this->cycle, -1))) {
              case 'd':
                return t(
                  'Every :count days', 
                  array(':count' => $totalCount)
                );
                break;
    
              case 'w':
                return t(
                  'Every :count weeks', 
                  array(':count' => $totalCount)
                );
                break;
    
              case 'm':
                return t(
                  'Every :count months', 
                  array(':count' => $totalCount)
                );
                break;
    
              case 'y':
                return t(
                  'Every :count years', 
                  array(':count' => $totalCount)
                );
                break;
            }
          }
          break; 
        }

        case 'recurringCount':
          return $this->recurringCount;
          break;

        case 'status':
          return $this->status;
          break;
      }
    }

    return null;
  }

  /**
   * Create a paymentplan from the Checkout.com server.
   *
   * How to use this:
   *   $payment_plan = new PaymentPlan;
   *   $payment_plan->id = 'rp_000000000000000';
   *   $payment_plan->name = 'example_name';
   *   $payment_plan->trackId = 'example_tracker';
   *   $payment_plan->autoCapTime = 0;
   *   $payment_plan->currency = 'EUR';
   *   $payment_plan->value = 8000;
   *   $payment_plan->cycle = 7d;
   *   $payment_plan->status = 1;
   *   $payment_plan->create();
   *
   * @return bool
   *   Returns true if succeeded or false (with drupal message) when failed.
   */
  public function create() {
    try {
      $this->api_create();
    }
    catch (Exception $e) {
      drupal_set_message(t(':message', array(':message' => $e->getMessage(),)), 'error');
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Update a paymentplan from the Checkout.com server.
   *
   * How to use this:
   *   $payment_plan = new PaymentPlan;
   *   $payment_plan->id = 'rp_000000000000000';
   *   $payment_plan->status = 1;
   *   $payment_plan->db_update();
   * 
   * The folling fields can be updated:
   *   name.
   *   autoCapTime.
   *   value.
   *   status.
   *
   * @return bool
   *   Returns true if succeeded or false (with drupal message) when failed.
   */
  public function update() {
    try {
      $this->api_update();
    }
    catch (Exception $e) {
      drupal_set_message(t(':message', array(':message' => $e->getMessage(),)), 'error');
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Delete a paymentplan from the Checkout.com server.
   *
   * How to use this:
   *   $payment_plan = new PaymentPlan;
   *   $payment_plan->id = 'rp_000000000000000';
   *   $payment_plan->delete();
   *
   *   $payment_plan = new PaymentPlan;
   *   $payment_plan->trackId = 'example_tracker';
   *   $payment_plan->delete();
   *
   * @return bool
   *   Returns true if succeeded or false (with drupal message) when failed.
   */
  public function delete() {
    if ($this->get()) {
      try {
        $this->api_cancel();
      }
      catch (Exception $e) {
        drupal_set_message(t(':message', array(':message' => $e->getMessage(),)), 'error');
        return FALSE;
      }
  
      return TRUE;
    }
  
    drupal_set_message(t('The payment plan was not found on the Checkout.com server.'), 'error');
    return false;
  }

  /**
   * Checks a parameter in this object for validity.
   *
   * Simple usage:
   *   $payment_plan = new PaymentPlan;
   *   $error = $payment_plan->validate('id', 'rp_000000000000000');
   *
   * @return array|null
   *   Riether the error-message or nothing.
   */
  public function validate($object = null, $value = null) {
    switch ($object) {
      case 'autoCapTime':
        if (!is_numeric($value)) {
          return t('The automatic capture time needs to be a number.');
        }
        elseif ($value < 0) {
          return t('The automatic capture time cannot be below zero.');
        }
        elseif ($value >= 168) {
          return t('The automatic capture time cannot be above 168.');
        }
        break;
      
      case 'cycle':
        if (strlen($value) > 4) {
          return t(
            'The cycle needs to formatted as :xd, :xw, :xm, or :xy.',
            array(
              ':xd' => 'xd',
              ':xw' => 'xw',
              ':xm' => 'xm',
              ':xy' => 'xy',
            )
          );
        }
        else{
          $int = (int) substr($value, 0, -1);

          if ($int < 1) {
            return t('The cycle needs to at least 1 day long.');
          }

          switch (strtolower(substr($value, -1))) {
            case 'd':
              if ($int > 730) {
                return t('The cycle can maximum be 730 days long.');
              }
              break;
        
            case 'w':
              if ($int > 730) {
                return t('The cycle can maximum be 104 weeks long.');
              }
              break;
        
            case 'm':
              if ($int > 730) {
                return t('The cycle can maximum be 24 months long.');
              }
              break;
        
            case 'y':
              if ($int > 730) {
                return t('The cycle can maximum be 2 years long.');
              }
              break;
            
            default:
              return t(
                'The cycle needs to formatted as :xd, :xw, :xm, or :xy.',
                array(
                  ':xd' => 'xd',
                  ':xw' => 'xw',
                  ':xm' => 'xm',
                  ':xy' => 'xy',
                )
              );
              break;
          }
        }
        break;

      case 'recurringCount':
        if (!is_numeric($value)) {
          return t('The recurring count needs to be a number.');
        }
        elseif ($value > 6993) {
          return t('The recurring count cannot be more than 6993.');
        }
        break;
      
      case 'status':
        if ($value != 1 && $value != 0) {
          return t('The status can only be active or suspended.');
        }
        break;

      case 'trackId':
        if (strlen($value) > 100) {
          return t('The SKU cannot be longer then a 100 characters.');
        }
        break;

      case 'value':
        if ($value <= 0) {
          return t('The selling price cannot be zero or negative.');
        }
        break;

      default:
        return t('The requested object cannot be validated.');
        break;
    }

    return null;
  }

  /**
   * Gets this paymentplan from the Checkout.com API.
   *
   * Minimal usage:
   *   $payment_plan->id = 'rp_000000000000000';
   *   $this->api_query();
   *
   * @return bool
   *   TRUE if it was succesfull, FALSE if it doesn't.
   */
  private function api_get() {
    if ($this->id == NULL) {
      return FALSE;
    }

    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Responsemodels/Paymentplan';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
    $service = $apiClient->Recurringpaymentservice();
    $reponse = $service->getPlan($this->id);

    if ($reponse != NULL) {
      $this->id = $reponse->getPlanId();
      $this->name = $reponse->getName();
      $this->trackId = $reponse->getPlanTrackId();
      $this->autoCapTime = $reponse->getAutoCapTime();
      $this->currency = $reponse->getCurrency();
      $this->value = $reponse->getValue();
      $this->cycle = $reponse->getCycle();
      $this->recurringCount = $reponse->getRecurringCount();
      $this->status = $reponse->getStatus();

      $this->db_add();

      return TRUE;
    }

    return FALSE;
  }

  /**
   * Searches this paymentplan from the Checkout.com API.
   *
   * Minimal usage:
   *   $this->trackId = 'example_tracker';
   *   $this->api_query();
   *
   * @return bool
   *   TRUE if it was succesfull, FALSE if it doesn't.
   */
  private function api_query() {
    if ($this->trackId == NULL) {
      return FALSE;
    }

    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Requestmodels/Querypaymentplan';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Responsemodels/Paymentplanlist';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
    $service = $apiClient->Recurringpaymentservice();

    $request = new com\checkout\Apiservices\Recurringpayments\Requestmodels\Querypaymentplan();
    $request->setPlanTrackId($this->trackId);

    $reponse = $service->queryPlan($request);
    

    if ($reponse->getTotalRows() == 1) {
      $reponseplan = $reponse->getData()[0];

      $this->id = $reponseplan['planId'];
      $this->name = $reponseplan['name'];
      $this->trackId = $reponseplan['planTrackId'];
      $this->autoCapTime = $reponseplan['autoCapTime'];
      $this->currency = $reponseplan['currency'];
      $this->value = $reponseplan['value'];
      $this->cycle = $reponseplan['cycle'];
      $this->recurringCount = $reponseplan['recurringCount'];
      $this->status = $reponseplan['status'];

      $this->db_add();

      return TRUE;
    }

    return FALSE;
  }

  /**
   * Gets this paymentplan from the Checkout.com API.
   *
   * Minimal usage:
   *   $this->trackId = 'example_tracker';
   *   $this->api_query();
   *
   * @return mixed
   *   TRUE if it was succesfull or the error message if it's not.
   */
  private function api_create() {
    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Requestmodels/Baserecurringpayment';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Responsemodels/Recurringpayment';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    try {
      $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
      $service = $apiClient->Recurringpaymentservice();

      $request = new com\checkout\Apiservices\Recurringpayments\Requestmodels\Baserecurringpayment();
      $request->setName($this->name);
      $request->setPlanTrackId($this->trackId);
      $request->setAutoCapTime($this->autoCapTime);
      $request->setCurrency($this->currency);
      $request->setValue($this->value);
      $request->setCycle($this->cycle);
      $request->setRecurringCount($this->recurringCount);
      $request->setStatus($this->status);

      $reponse = $service->createSinglePlan($request);
    }
    catch (Exception $e) {
      throw new Exception(
        "API " . $e->getErrorCode() . " | " . $e->getErrorMessage()
      );
    }

    $reponseplan = $reponse->getPaymentPlans()[0];
    
    $this->id = $reponseplan->getPlanId();
    $this->value = $reponseplan->getValue();

    $this->db_add();

    return TRUE;
  }

  /**
   * Update this paymentplan from the Checkout.com API.
   *
   * Minimal usage:
   *   $this->id = 'rp_000000000000000';
   *   $this->trackId = 'example_tracker';
   *   $this->api_update();
   *
   * @return mixed
   *   TRUE if it was succesfull or the error message if it's not.
   */
  private function api_update() {
    if ($this->id == NULL) {
      throw new Exception("Cannot update a payment plan without an id.");
    }

    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Requestmodels/Planupdate';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Sharedmodels/Okresponse';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    try {
      $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
      $service = $apiClient->Recurringpaymentservice();

      $request = new com\checkout\Apiservices\Recurringpayments\Requestmodels\Planupdate();
      $request->setPlanId($this->id);

      if ($this->name != NULL) {
        $request->setName($this->name);
      }
      if ($this->trackId != NULL) {
        $request->setPlanTrackId($this->trackId);
      }
      if ($this->autoCapTime != NULL) {
        $request->setAutoCapTime($this->autoCapTime);
      }
      if ($this->value != NULL) {
        $request->setValue($this->value);
      }
      if ($this->status != NULL) {
        $request->setStatus((int)$this->status);
      }

      $reponse = $service->updatePlan($request);
    }
    catch (Exception $e) {
      if (strpos($e->getErrorMessage(), 'Recurring Plan already exists')) {
        return TRUE;
      }

      throw new Exception(
        "API " . $e->getErrorCode() . " | " . $e->getErrorMessage()
      );
    }

    if ($reponse->hasError()) {
      throw new Exception(
        "API " . $e->getHttpStatus() . " | " . $e->getMessage()
      );
    }

    $this->db_update();

    return TRUE;
  }

  /**
   * Cancel this paymentplan from the Checkout.com API.
   *
   * Note: The payment plan will be deleted and cannot be restored.
   *
   * Minimal usage:
   *   $this->id = 'rp_000000000000000';
   *   $this->api_cancel();
   *
   * @return mixed
   *   TRUE if it was succesfull or the error message if it's not.
   */
  private function api_cancel() {
    if ($this->id == NULL) {
      throw new Exception("Cannot cancl a payment plan without an id.");
    }

    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Sharedmodels/Okresponse';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    try {
      $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
      $service = $apiClient->Recurringpaymentservice();

      $request = new com\checkout\Apiservices\Recurringpayments\Requestmodels\Planupdate();
      $reponse = $service->cancelPlan($this->id);
    }
    catch (Exception $e) {
      throw new Exception(
        "API " . $e->getErrorCode() . " | " . $e->getErrorMessage()
      );
    }

    if ($reponse->hasError()) {
      throw new Exception(
        "API " . $e->getHttpStatus() . " | " . $e->getMessage()
      );
    }

    return TRUE;
  }

  /**
   * Gets this paymentplan from the local database.
   *
   * Minimal usage:
   *   $this->id = 'rp_000000000000000';
   *   $this->db_get();
   *
   *   $this->trackId = 'example_tracker';
   *   $this->db_get();
   *
   * @return bool
   *   TRUE if it was succesfull, FALSE if it doesn't.
   */
  private function db_get() {
    if ($this->id != NULL) {
      $findcolumn = 'id';
      $findrow    = $this->id;
    }
    elseif ($this->trackId != NULL) {
      $findcolumn = 'track_id';
      $findrow    = $this->trackId;
    }
    else {
      return FALSE;
    }

    $sqlRepsonse = db_select('uc_checkoutpaymentplan_payment_plan', 'c')
      ->fields('c')
      ->condition($findcolumn, (string) $findrow, '=')
      ->execute()
      ->fetchAll();

    if (!empty($sqlRepsonse)) {
      $pp = reset($sqlRepsonse);
      $this->id = $pp->id;
      $this->name = $pp->name;
      $this->trackId = $pp->track_id;
      $this->autoCapTime = $pp->auto_cap_time;
      $this->currency = $pp->currency;
      $this->value = $pp->value;
      $this->cycle = $pp->cycle;
      $this->recurringCount = $pp->recurring_count;
      $this->status = $pp->status;

      return TRUE;
    }
    return FALSE;
  }

  /**
   * Adds this paymentplan to the local database.
   *
   * Minimal usage:
   *   $this->id             = 'rp_000000000000000';
   *   $this->name           = 'Example title';
   *   $this->autoCapTime    = 0;
   *   $this->currency       = 'USD';
   *   $this->value          = 500;
   *   $this->recurringCount = 10;
   *   $this->cycle          = '7d';
   *   $this->status         = 1;
   *   $this->db_add();
   *
   * @return bool
   *   TRUE if it successfully added to the database.
   */
  private function db_add() {
    try {
      $db = db_insert('uc_checkoutpaymentplan_payment_plan')
        ->fields(array(
          'id'              => $this->id,
          'name'            => $this->name,
          'track_id'        => $this->trackId,
          'auto_cap_time'   => $this->autoCapTime,
          'currency'        => $this->currency,
          'value'           => $this->value,
          'cycle'           => $this->cycle,
          'recurring_count' => $this->recurringCount,
          'status'          => $this->status,
        ))
        ->execute();
    }
    catch (Exception $e) {
      if (empty($this->name)) {
        $this->name = 'UNKNOWN';
      }

      watchdog(
        'Checkout.com Recurring Payments',
        'Notice: Subscription, :name, was not added to local database.
        (:errorMessage)',
        array(
          ':name' => $this->name,
          ':errorMessage' => $e->getMessage(),
        ),
        WATCHDOG_NOTICE
      );

      return FALSE;
    }

    return TRUE;
  }
}

/**
 * The Checkout.com Customer Payment Plan.
 */
class CustomerPaymentPlan {
  public $id;
  public $planId;
  public $cardId;
  public $customerId;
  public $recurringCountLeft;
  public $status;
  public $totalCollectionCount;
  public $totalCollectionValue;
  public $startDate;
  public $previousRecurringDate;
  public $nextRecurringDate;

  /**
   * Get a customer payment plan from the Checkout.com server.
   *
   * How to use this:
   *   $customer_payment_plan = new CustomerPaymentPlan;
   *   $customer_payment_plan->id = 'rp_000000000000000';
   *   $customer_payment_plan->get();
   *
   *   $customer_payment_plan = new CustomerPaymentPlan;
   *   $customer_payment_plan->customerId = 'cust_000000000000000';
   *   $customer_payment_plan->planId     = 'rp_000000000000000';
   *   $customer_payment_plan->get();
   *
   * @return bool
   *   Returns true if succeeded or false (with drupal message) when failed.
   */
  public function get() {
    if ($this->db_get() || $this->api_get() || $this->api_query()) {
      return TRUE;
    }

    return FALSE;
  }

  public function getString($property) {
    if (property_exists($this, $property)) {
      switch ($property) {
        case 'id':
          return $this->id;
          break;

        case 'planId':
          return $this->planId;
          break;
      
        case 'cardId':
          return $this->cardId;
          break;

        case 'customerId':
          return $this->customerId;
          break;

        case 'recurringCountLeft':
          return $this->recurringCountLeft;
          break;

        case 'status':
          $statusses = array(
            t("Failed Initial"),
            t("Active"),
            t("Cancelled"),
            t("In Arrears"),
            t("Suspended"),
            t("Completed")
          );
          return $statusses[$this->status];
          break;

        case 'totalCollectionCount':
          return $this->recurringCountLeft;
          break;

        case 'totalCollectionValue':
          return uc_currency_format($this->totalCollectionValue);
          break;

        case 'startDate':
          $date = new DateTime($this->startDate);
          return $date->format('d M \'y');
          break;

        case 'previousRecurringDate':
          $date = new DateTime($this->previousRecurringDate);
          return $date->format('d M \'y');
          break;

        case 'nextRecurringDate':
          $date = new DateTime($this->nextRecurringDate);
          return $date->format('d M \'y');
          break;
      }
    }

    return null;
  }

  /**
   * Update a paymentplan from the Checkout.com server.
   *
   * How to use this:
   *   $payment_plan = new PaymentPlan;
   *   $payment_plan->id = 'rp_000000000000000';
   *   $payment_plan->status = 1;
   *   $payment_plan->db_update();
   * 
   * The folling fields can be updated:
   *   name.
   *   autoCapTime.
   *   value.
   *   status.
   *
   * @return bool
   *   Returns true if succeeded or false (with drupal message) when failed.
   */
  public function update() {
    try {
      $this->api_update();
    }
    catch (Exception $e) {
      drupal_set_message(
        t(':message', array(':message' => $e->getMessage(),)), 
        'error'
      );
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Delete a paymentplan from the Checkout.com server.
   *
   * How to use this:
   *   $payment_plan = new PaymentPlan;
   *   $payment_plan->id = 'rp_000000000000000';
   *   $payment_plan->delete();
   *
   *   $payment_plan = new PaymentPlan;
   *   $payment_plan->trackId = 'example_tracker';
   *   $payment_plan->delete();
   *
   * @return bool
   *   Returns true if succeeded or false (with drupal message) when failed.
   */
  public function delete() {
    if ($this->get()) {
      try {
        $this->api_cancel();
        $this->db_remove();
      }
      catch (Exception $e) {
        drupal_set_message(
          t(':message', array(':message' => $e->getMessage(),)), 
          'error'
        );
        return FALSE;
      }
  
      return TRUE;
    }
  
    drupal_set_message(
      t('The payment plan was not found on the Checkout.com server.'), 
      'error'
    );
    return false;
  }

  /**
   * Checks if a customer already has a specific subscription.
   *
   * How to use this:
   *   $customer_payment_plan = new CustomerPaymentPlan;
   *   $bool = $customer_payment_plan->exists(
   *     'integration@checkout.com', 
   *     'example_tracker'
   *   );
   *
   * Note: This function will also fill this object with the correct values.
   *
   * @param string $email
   *   The e-mail address which uniquely identiefies the customer.
   * @param string $trackId
   *   The unique identifier for the recurring plan set by the Merchant.
   *   This is equal to the Ubercart SKU.
   *
   * @return bool
   *   Returns true if link exists or false when it doesn't.
   */
  public function exists($email, $trackId) {
    $customer = new Customer;
    $customer->email = $email;

    $payment_plan = new PaymentPlan;
    $payment_plan->trackId = $trackId;

    if ($customer->get() && $payment_plan->get()) {
      $this->customerId = $customer->id;
      $this->planId = $payment_plan->id;
      return $this->get();
    }

    return FALSE;
  }

  /**
   * Gets this customer paymentplan from the Checkout.com API.
   *
   * Minimal usage:
   *   $this->id = 'cp_000000000000000';
   *   $this->api_query();
   *
   * @return bool
   *   TRUE if it was succesfull, FALSE if it doesn't.
   */
  private function api_get() {
    if ($this->id == NULL) {
      return FALSE;
    }

    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Responsemodels/Customerpaymentplan';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
    $service = $apiClient->Recurringpaymentservice();
    $reponse = $service->getCustomerPlan($this->id);

    if ($reponse != NULL) {
      $this->id = $reponse->getCustomerPlanId();
      $this->planId = $reponse->getPlanId();
      $this->recurringCountLeft = $reponse->getRecurringCountLeft();
      $this->status = $reponse->getStatus();
      $this->totalCollectionCount = $reponse->getTotalCollectedCount();
      $this->totalCollectionValue = $reponse->getTotalCollectedValue();
      $this->startDate = $reponse->getStartDate();
      $this->previousRecurringDate = $reponse->getPreviousRecurringDate();
      $this->nextRecurringDate = $reponse->getNextRecurringDate();

      $this->db_add();

      return TRUE;
    }

    return FALSE;
  }

  /**
   * Update this paymentplan from the Checkout.com API.
   *
   * Minimal usage:
   *   $this->id     = 'cp_000000000000000';
   *   $this->status = 4;
   *   $this->api_update();
   *
   * @return mixed
   *   TRUE if it was succesfull or the error message if it's not.
   */
  private function api_update() {
    if ($this->id == NULL) {
      throw new Exception("Cannot update a payment plan without an id.");
    }

    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Requestmodels/Planupdate';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Sharedmodels/Okresponse';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    try {
      $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
      $service = $apiClient->Recurringpaymentservice();

      $request = new com\checkout\Apiservices\Recurringpayments\Requestmodels\Planupdate();
      $request->setPlanId($this->id);

      if ($this->name != NULL) {
        $request->setName($this->name);
      }
      if ($this->trackId != NULL) {
        $request->setPlanTrackId($this->trackId);
      }
      if ($this->autoCapTime != NULL) {
        $request->setAutoCapTime($this->autoCapTime);
      }
      if ($this->value != NULL) {
        $request->setValue($this->value);
      }
      if ($this->status != NULL) {
        $request->setStatus($this->status);
      }

      $reponse = $service->updatePlan($request);
    }
    catch (Exception $e) {
      throw new Exception(
        "API " . $e->getErrorCode() . " | " . $e->getErrorMessage()
      );
    }

    if ($reponse->hasError()) {
      throw new Exception(
        "API " . $e->getHttpStatus() . " | " . $e->getMessage()
      );
    }

    $this->db_update();

    return TRUE;
  }

  /**
   * Cancel this paymentplan from the Checkout.com API.
   *
   * Note: The payment plan will be deleted and cannot be restored.
   *
   * Minimal usage:
   *   $this->id = 'rp_000000000000000';
   *   $this->api_cancel();
   *
   * @return mixed
   *   TRUE if it was succesfull or the error message if it's not.
   */
  private function api_cancel() {
    if ($this->id == NULL) {
      throw new Exception("Cannot cancel a payment plan without an id.");
    }

    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Sharedmodels/Okresponse';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    try {
      $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
      $service = $apiClient->Recurringpaymentservice();

      $reponse = $service->cancelCustomerPlan($this->id);
    }
    catch (Exception $e) {
      throw new Exception(
        "API " . $e->getErrorCode() . " | " . $e->getErrorMessage()
      );
    }

    if ($reponse->hasError()) {
      throw new Exception(
        "API " . $e->getHttpStatus() . " | " . $e->getMessage()
      );
    }

    return TRUE;
  }

  /**
   * Queries for a customer paymentplan from the Checkout.com API.
   *
   * Minimal usage:
   *   $this->customerId = 'cust_000000000000000';
   *   $this->planId     = 'rp_000000000000000';
   *   $this->api_query();
   *
   * @return bool
   *   TRUE if it was succesfull, FALSE if it doesn't.
   */
  private function api_query() {
    if ($this->customerId == NULL || $this->planId == NULL) {
      return FALSE;
    }

    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Requestmodels/Querycustomerplan';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Responsemodels/Paymentplanlist';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
    $service = $apiClient->Recurringpaymentservice();

    $request = new com\checkout\Apiservices\Recurringpayments\Requestmodels\Querycustomerplan();
    $request->setCustomerId($this->customerId);
    $request->setPlanId($this->planId);

    $response = $service->queryCustomerPlan($request);

    if ($response->getTotalRows() == 1) {
      $reponseplan = $response->getData()[0];

      $this->id = $reponseplan['customerPlanId'];
      $this->planId = $reponseplan['planId'];
      $this->recurringCountLeft = $reponseplan['recurringCountLeft'];
      $this->status = $reponseplan['status'];
      $this->totalCollectionCount = $reponseplan['totalCollectedCount'];
      $this->totalCollectionValue = $reponseplan['totalCollectedValue'];
      $this->startDate = $reponseplan['startDate'];
      $this->previousRecurringDate = $reponseplan['previousRecurringDate'];
      $this->nextRecurringDate = $reponseplan['nextRecurringDate'];

      $this->db_add();

      return TRUE;
    }

    return FALSE;
  }

  /**
   * Gets this customer payment plan from the local database.
   *
   * Minimal usage:
   *   $this->id = 'cp_000000000000000';
   *   $this->db_get();
   *
   *   $this->customerId = 'cust_000000000000000';
   *   $this->planId     = 'rp_000000000000000';
   *   $this->db_get();
   *
   * @return bool
   *   TRUE if it was succesfull, FALSE if it doesn't.
   */
  private function db_get() {
    if ($this->id != NULL) {
      $findcolumn1 = 'id';
      $findrow1    = $this->id;
      $findcolumn2 = TRUE;
      $findrow2 = TRUE;
    }
    elseif ($this->customerId != NULL || $this->planId != NULL) {
      $findcolumn1 = 'customer_id';
      $findrow1    = $this->customerId;
      $findcolumn2 = 'plan_id';
      $findrow2 = $this->planId;
    }
    else {
      return FALSE;
    }

    $sqlRepsonse = db_select(
      'uc_checkoutpaymentplan_customer_payment_plan', 
      'c'
    )
      ->fields('c')
      ->condition($findcolumn1, (string) $findrow1, '=')
      ->condition($findcolumn2, (string) $findrow2, '=')
      ->execute()
      ->fetchObject();

    if (!empty($sqlRepsonse)) {
      $this->id                    = $sqlRepsonse->id;
      $this->planId                = $sqlRepsonse->plan_id;
      $this->cardId                = $sqlRepsonse->card_id;
      $this->customerId            = $sqlRepsonse->customer_id;
      $this->recurringCountLeft    = $sqlRepsonse->recurring_count_left;
      $this->status                = $sqlRepsonse->status;
      $this->totalCollectionCount  = $sqlRepsonse->total_collection_count;
      $this->totalCollectionValue  = $sqlRepsonse->total_collection_value;
      $this->startDate             = $sqlRepsonse->start_date;
      $this->previousRecurringDate = $sqlRepsonse->previous_recurring_date;
      $this->nextRecurringDate     = $sqlRepsonse->next_recurring_date;

      return TRUE;
    }
    return FALSE;
  }

  /**
   * Adds this customer payment plan to the local database.
   *
   * Minimal usage:
   *   $this->id         = 'cp_000000000000000';
   *   $this->planId     = 'rp_000000000000000';
   *   $this->customerId = 'cust_000000000000000';
   *   $this->db_add();
   *
   * @return bool
   *   TRUE if it successfully added to the database.
   *   FALSE if an error ocourred and a the error is added to Watchdog.
   */
  public function db_add() {
    try {
      db_insert('uc_checkoutpaymentplan_customer_payment_plan')
        ->fields(array(
          'id'                      => $this->id,
          'plan_id'                 => $this->planId,
          'card_id'                 => $this->cardId,
          'customer_id'             => $this->customerId,
          'recurring_count_left'    => $this->recurringCountLeft,
          'status'                  => $this->status,
          'total_collection_count'  => $this->totalCollectionCount,
          'total_collection_value'  => $this->totalCollectionValue,
          'start_date'              => $this->startDate,
          'previous_recurring_date' => $this->previousRecurringDate,
          'next_recurring_date'     => $this->nextRecurringDate,
        ))
        ->execute();
    }
    catch (Exception $e) {
      watchdog(
        'Checkout.com Recurring Payments',
        'Notice: Customer payment plan was not added to the local database.
        (:errorMessage)',
        array(
          ':errorMessage' => $e->getMessage(),
        ),
        WATCHDOG_NOTICE
      );

      return FALSE;
    }

    return TRUE;
  }

  /**
   * Remove this customer payment plan from the local database.
   *
   * Minimal usage:
   *   $this->id = 'cp_000000000000000';
   *   $this->db_remove();
   *
   * @return bool
   *   TRUE if it was succesfull, FALSE if it doesn't.
   */
  public function db_remove() {
    try {
      $sqlRepsonse = db_delete('uc_checkoutpaymentplan_customer_payment_plan')
        ->condition('id', (string) $this->id, '=')
        ->execute();
    }
    catch (Exception $e) {
      if (empty($this->id)) {
        $this->id = 'UNKNOWN';
      }

      watchdog(
        'Checkout.com Recurring Payments',
        'Notice: Subscription, :id, was not deleted from the local database.
        (:errorMessage) You can solve this problem by manualy dropping the
        table [uc_checkoutpaymentplan_customer_payment_plan] or by running
        a synscronisation in the Checkout.com payment settings.',
        array(
          ':id' => $this->id,
          ':errorMessage' => $e->getMessage(),
        ),
        WATCHDOG_WARNING
      );

      return FALSE;
    }

    if (!empty($sqlRepsonse)) {
      return TRUE;
    }
    return FALSE;
  }
}

/**
 * The Checkout.com Customer Payment Plan List.
 */
class CustomerPaymentPlanList {
  public $list;

  /**
   * Get a customer payment plan from the Checkout.com server.
   *
   * How to use this:
   *   $customer_payment_plan = new CustomerPaymentPlan;
   *   $customer_payment_plan->id = 'rp_000000000000000';
   *   $customer_payment_plan->get();
   *
   *   $customer_payment_plan = new CustomerPaymentPlan;
   *   $customer_payment_plan->customerId = 'cust_000000000000000';
   *   $customer_payment_plan->planId     = 'rp_000000000000000';
   *   $customer_payment_plan->get();
   *
   * @return bool
   *   Returns true if succeeded or false (with drupal message) when failed.
   */
  public function get($email = null) {
    if (!empty($email)) {
      $customer = new Customer;
      $customer->email = $email;

      if ($customer->get()) {
        $this->customerId = $customer->id;
      }
    }

    if ($this->db_get() || $this->api_query()) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * Queries for a customer paymentplan from the Checkout.com API.
   *
   * Minimal usage:
   *   $this->customerId = 'cust_000000000000000';
   *   $this->api_query();
   *
   * @return bool
   *   TRUE if it was succesfull, FALSE if it doesn't.
   */
  public function api_query() {
    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Requestmodels/Querycustomerplan';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Responsemodels/Paymentplanlist';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
    $service = $apiClient->Recurringpaymentservice();

    $request = new com\checkout\Apiservices\Recurringpayments\Requestmodels\Querycustomerplan();

    if (property_exists($this, 'customerId') && $this->customerId !== NULL) {
      $request->setCustomerId($this->customerId);
    }

    $response = $service->queryCustomerPlan($request);

    if ($response->getTotalRows() > 0) {
      $this->list = array();
      foreach ($response->getData() as $key => $value) {
        $cpp = new CustomerPaymentPlan;

        $cpp->id = $value['customerPlanId'];
        $cpp->planId = $value['planId'];
        $cpp->cardId = $value['cardId'];
        $cpp->customerId = $value['customerId'];
        $cpp->recurringCountLeft = $value['recurringCountLeft'];
        $cpp->status = $value['status'];
        $cpp->totalCollectionCount = $value['totalCollectedCount'];
        $cpp->totalCollectionValue = $value['totalCollectedValue'];
        $cpp->startDate = $value['startDate'];
        $cpp->previousRecurringDate = $value['previousRecurringDate'];
        $cpp->nextRecurringDate = $value['nextRecurringDate'];

        $this->db_add($cpp);
  
        $this->list[] = $cpp;
      }

      if ($this->list != array()) {
        return TRUE;
      }
    }

    return FALSE;
  }

  /**
   * Queries for a customer paymentplan from the Checkout.com API.
   *
   * Minimal usage:
   *   $this->customerId = 'cust_000000000000000';
   *   $this->api_query();
   *
   * @return bool
   *   TRUE if it was succesfull, FALSE if it doesn't.
   */
  public function db_get() {
    $findcolumn = $findrow = TRUE;

    if (property_exists($this, 'customerId') && $this->customerId !== NULL) {
      $findcolumn = 'customer_id';
      $findrow = $this->customerId;
    }

    $sqlRepsonse = db_select(
      'uc_checkoutpaymentplan_customer_payment_plan',
      'c'
    )
      ->fields('c')
      ->condition($findcolumn, $findrow, '=')
      ->orderBy('start_date', 'ASC')
      ->execute()
      ->fetchAll();

    if (!empty($sqlRepsonse)) {
      $this->list = array();
      foreach ($sqlRepsonse as $key => $value) {
        $cpp = new CustomerPaymentPlan;

        $cpp->id                    = $value->id;
        $cpp->planId                = $value->plan_id;
        $cpp->cardId                = $value->card_id;
        $cpp->customerId            = $value->customer_id;
        $cpp->recurringCountLeft    = $value->recurring_count_left;
        $cpp->status                = $value->status;
        $cpp->totalCollectionCount  = $value->total_collection_count;
        $cpp->totalCollectionValue  = $value->total_collection_value;
        $cpp->startDate             = $value->start_date;
        $cpp->previousRecurringDate = $value->previous_recurring_date;
        $cpp->nextRecurringDate     = $value->next_recurring_date;

        $this->list[] = $cpp;
      }

      if ($this->list != array()) {
        return TRUE;
      }
    }
    return FALSE;
  }

  /**
   * Adds this customer payment plan to the local database.
   *
   * @return bool
   *   TRUE if it successfully added to the database.
   */
  private function db_add($cpp) {
    $db = db_insert('uc_checkoutpaymentplan_customer_payment_plan')
      ->fields(array(
        'id'                      => $cpp->id,
        'plan_id'                 => $cpp->planId,
        'card_id'                 => $cpp->cardId,
        'customer_id'             => $cpp->customerId,
        'recurring_count_left'    => $cpp->recurringCountLeft,
        'status'                  => $cpp->status,
        'total_collection_count'  => $cpp->totalCollectionCount,
        'total_collection_value'  => $cpp->totalCollectionValue,
        'start_date'              => $cpp->startDate,
        'previous_recurring_date' => $cpp->previousRecurringDate,
        'next_recurring_date'     => $cpp->nextRecurringDate,
      ))
      ->execute();

    return TRUE;
  }
}

/**
 * The Checkout.com List.
 */
class CheckoutComList {
  public $fromDate;
  public $toDate;
  public $offset;
  public $totalRows;
  public $count;

  public $queryObject;
  public $list = array();

  /**
   * Get a customer payment plan from the Checkout.com server.
   *
   * Minimal usage:
   *   $checkout_com_list = new CheckoutComList;
   *   $checkout_com_list->queryObject = new PaymentPlan;
   *   $checkout_com_list->queryObject->id = 'rp_000000000000000';
   *   $checkout_com_list->get();
   *
   * @return bool
   *   Returns the list if succeeded or false (with drupal message) when failed.
   */
  public function get() {
    switch (get_class($this->queryObject)) {
      case 'PaymentPlan':
        if ($this->api_getCustomerPaymentPlans()) {
          return TRUE;
        }
        break;
      
      case 'CustomerPaymentPlan':
        if ($this->api_getCustomerPaymentPlans()) {
          return TRUE;
        }
        break;

      case 'Customer':
        return get_class($this->queryObject);
        break;
    }

    return FALSE;
  }

  public function getAll() {
    switch (get_class($this->queryObject)) {
      case 'PaymentPlan':
        if ($this->api_getCustomerPaymentPlans()) {
          return TRUE;
        }
        break;
      
      case 'CustomerPaymentPlan':
        if ($this->db_getCustomerPaymentPlans()) {
          return TRUE;
        }

        // @todo check if this runs properly
        do {
          $this->api_getCustomerPaymentPlans();
          $this->offset += $this->count;
        } while ($this->count == $this->totalRows);
        break;

      case 'Customer':
        return get_class($this->queryObject);
        break;
    }

    return FALSE;
  }

  public function api_getCustomerPaymentPlans() {
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Responsemodels/Paymentplanlist';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Requestmodels/Querycustomerplan';

    $service = $this->api_load($class);

    $request = new com\checkout\Apiservices\Recurringpayments\Requestmodels\Querycustomerplan();

    if (property_exists($this->queryObject, 'customerId') && $this->queryObject->customerId !== NULL) {
      $request->setCustomerId($this->queryObject->customerId);
    }

    if (!empty($this->offset)) {
      $request->setOffset($this->offset);
    }

    if (!empty($this->count)) {
      $request->setCount($this->count);
    }

    if (!empty($this->fromDate)) {
      $request->setFromDate($this->fromDate);
    }

    if (!empty($this->toDate)) {
      $request->setToDate($this->toDate);
    }

    $response = $service->queryCustomerPlan($request);

    if ($response->getTotalRows() > 0) {
      $this->totalRows = $response->getTotalRows();
      $this->count = $response->getCount();

      foreach ($response->getData() as $key => $value) {
        $cpp = new CustomerPaymentPlan;

        $cpp->id = $value['customerPlanId'];
        $cpp->planId = $value['planId'];
        $cpp->cardId = $value['cardId'];
        $cpp->customerId = $value['customerId'];
        $cpp->recurringCountLeft = $value['recurringCountLeft'];
        $cpp->status = $value['status'];
        $cpp->totalCollectionCount = $value['totalCollectedCount'];
        $cpp->totalCollectionValue = $value['totalCollectedValue'];
        $cpp->startDate = $value['startDate'];
        $cpp->previousRecurringDate = $value['previousRecurringDate'];
        $cpp->nextRecurringDate = $value['nextRecurringDate'];

        $cpp->db_add();
  
        $this->list[] = $cpp;
      }
      return TRUE;
    }
    return FALSE;
  }


  private function api_load($class) {
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/autoload';

    foreach (array_reverse($class) as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
    return $apiClient->Recurringpaymentservice();
  }


  public function db_getCustomerPaymentPlans() {
    $findcolumn = $findrow = TRUE;

    if (property_exists($this->queryObject, 'customerId') && $this->queryObject->customerId !== NULL) {
      $findcolumn = 'customer_id';
      $findrow = $this->queryObject->customerId;
    }

    $sqlRepsonse = db_select(
      'uc_checkoutpaymentplan_customer_payment_plan',
      'c'
    )
      ->fields('c')
      ->condition($findcolumn, $findrow, '=')
      ->orderBy('start_date', 'ASC')
      ->execute()
      ->fetchAll();

    if (!empty($sqlRepsonse)) {
      $this->list = array();
      foreach ($sqlRepsonse as $key => $value) {
        $cpp = new CustomerPaymentPlan;

        $cpp->id                    = $value->id;
        $cpp->planId                = $value->plan_id;
        $cpp->cardId                = $value->card_id;
        $cpp->customerId            = $value->customer_id;
        $cpp->recurringCountLeft    = $value->recurring_count_left;
        $cpp->status                = $value->status;
        $cpp->totalCollectionCount  = $value->total_collection_count;
        $cpp->totalCollectionValue  = $value->total_collection_value;
        $cpp->startDate             = $value->start_date;
        $cpp->previousRecurringDate = $value->previous_recurring_date;
        $cpp->nextRecurringDate     = $value->next_recurring_date;

        $this->list[] = $cpp;
      }

      if ($this->list != array()) {
        return TRUE;
      }
    }
    return FALSE;
  }
}

/**
 * The Checkout.com store settings.
 */
class PaymentPlanStoreSettings {
  public $planId;
}

/**
 * The Checkout.com customer objects.
 */
class Customer {
  public $id;
  public $name;
  public $created;
  public $email;
  public $phoneNumber;
  public $description;
  public $defaultCard;
  public $liveMode;
  public $cards;
  public $metadata;

  /**
   * Get a Checkout.com customer.
   *
   * How to use this:
   *   $customer = new Customer;
   *   $customer->email = 'integration@checkout.com';
   *   $customer->get();
   *
   *   $customer = new Customer;
   *   $customer->id = 'cust_0000000000000000000000';
   *   $customer->get();
   *
   * @return bool
   *   Returns true if succeeded or false when failed.
   */
  public function get() {
    if ($this->db_get() || $this->api_get()) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * Gets this customer from the Checkout.com API.
   *
   * Minimal usage:
   *   $this->email = 'integration@checkout.com';
   *   $this->api_query();
   *
   * @return bool
   *   TRUE if it was succesfull, FALSE if it doesn't.
   */
  private function api_get() {
    if ($this->email === NULL && $this->id === NULL) {
      return FALSE;
    }
    elseif ($this->email === NULL) {
      $queryValue = $this->id;
    }
    else {
      $queryValue = $this->email;
    }

    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Customers/Customerservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Customers/Responsemodels/Customer';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'));
    $service = $apiClient->Customerservice();
    $response = $service->getCustomer($queryValue);

    if ($response != NULL) {
      $this->id = $response->getId();
      $this->name = $response->getName();
      $this->created = $response->getCreated();
      $this->email = $response->getEmail();
      $this->phoneNumber = $response->getPhoneNumber();
      $this->description = $response->getDescription();
      $this->defaultCard = $response->getDefaultCard();
      $this->liveMode = $response->getLiveMode();
      $this->cards = $response->getCards();
      $this->metadata = $response->getMetadata();

      $this->db_add();

      return TRUE;
    }

    return FALSE;
  }

  /**
   * Gets this customer from the local database.
   *
   * Minimal usage:
   *   $this->email = 'integration@checkout.com';
   *   $this->db_get();
   *
   * @return bool
   *   TRUE if it was succesfull, FALSE if it doesn't.
   */
  private function db_get() {
    if ($this->email === NULL && $this->id === NULL) {
      return FALSE;
    }
    elseif ($this->email === NULL) {
      $query = array('id', $this->id);
    }
    else {
      $query = array('email', $this->email);
    }


    $sqlRepsonse = db_select('uc_checkoutpaymentplan_customer', 'c')
      ->fields('c')
      ->condition($query[0],$query[1], '=')
      ->execute()
      ->fetchObject();

    if (!empty($sqlRepsonse)) {
      $this->id          = $sqlRepsonse->id;
      $this->name        = $sqlRepsonse->name;
      $this->created     = $sqlRepsonse->created;
      $this->email       = $sqlRepsonse->email;
      $this->phoneNumber = $sqlRepsonse->phone_number;
      $this->description = $sqlRepsonse->description;
      $this->defaultCard = $sqlRepsonse->default_card;
      $this->liveMode    = $sqlRepsonse->live_mode;
      $this->cards       = $sqlRepsonse->cards;
      $this->metadata    = $sqlRepsonse->metadata;

      return TRUE;
    }

    return FALSE;
  }

  /**
   * Adds this customer to the local database.
   *
   * Minimal usage:
   *   $this->id    = 'cust_0000000000000000000000';
   *   $this->email = 'integration@checkout.com';
   *   $this->db_add();
   *
   * @return bool
   *   TRUE if it successfully added to the database.
   *   FALSE if an error ocourred and a the error is added to Watchdog.
   */
  private function db_add() {
    try {
      db_insert('uc_checkoutpaymentplan_customer')
        ->fields(array(
          'id' => $this->id,
          'name' => $this->name,
          'created' => $this->created,
          'email' => $this->email,
          'phone_number' => $this->phoneNumber,
          'description' => $this->description,
          'default_card' => $this->defaultCard,
          'live_mode' => $this->liveMode,
          'cards' => null,
          'metadata' => null,
        ))
        ->execute();
    }
    catch (Exception $e) {
      if (empty($this->name)) {
        $this->name = 'UNKNOWN';
      }

      watchdog(
        'Checkout.com Recurring Payments',
        'Notice: Customer, :name, was not added to local database.
        (:errorMessage)',
        array(
          ':name' => $this->name,
          ':errorMessage' => $e->getMessage(),
        ),
        WATCHDOG_NOTICE
      );

      return FALSE;
    }

    return TRUE;
  }
}
