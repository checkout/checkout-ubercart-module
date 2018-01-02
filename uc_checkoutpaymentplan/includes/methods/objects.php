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
    if ($this->api_query() || $this->api_get()) {
      return TRUE;
    }

    return FALSE;
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
    foreach ($this as $object => $value) {
      # code...
    }

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

    $apiClient = new com\checkout\Apiclient('sk_test_f574d9f5-225b-4d04-bb83-58f5a34e2a97');
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

    $apiClient = new com\checkout\Apiclient('sk_test_f574d9f5-225b-4d04-bb83-58f5a34e2a97');
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
      $apiClient = new com\checkout\Apiclient('sk_test_f574d9f5-225b-4d04-bb83-58f5a34e2a97');
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
      throw new Exception("API " . $e->getErrorCode() . " | " . $e->getErrorMessage());
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
      $apiClient = new com\checkout\Apiclient('sk_test_f574d9f5-225b-4d04-bb83-58f5a34e2a97');
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
      throw new Exception("API " . $e->getErrorCode() . " | " . $e->getErrorMessage());
    }

    if ($reponse->hasError()) {
      throw new Exception("API " . $e->getHttpStatus() . " | " . $e->getMessage());
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
      $apiClient = new com\checkout\Apiclient('sk_test_f574d9f5-225b-4d04-bb83-58f5a34e2a97');
      $service = $apiClient->Recurringpaymentservice();

      $request = new com\checkout\Apiservices\Recurringpayments\Requestmodels\Planupdate();
      $reponse = $service->cancelPlan($this->id);
    }
    catch (Exception $e) {
      throw new Exception("API " . $e->getErrorCode() . " | " . $e->getErrorMessage());
    }

    if ($reponse->hasError()) {
      throw new Exception("API " . $e->getHttpStatus() . " | " . $e->getMessage());
    }

    return TRUE;
  }

  /**
   * Checks if this paymentplan exist in the local database.
   *
   * Minimal usage:
   *   $this->id = 'rp_000000000000000';
   *   $this->db_exists();
   *
   * @return bool
   *   TRUE if it exists, FALSE if it doesn't.
   */
  private function db_exists() {
    $count = db_select('uc_checkoutpaymentplan_payment_plans', 'c')
      ->fields('c')
      ->condition('track_id', (string) $this->trackId, '=')
      ->execute()
      ->rowCount();

    if ($count == 1) {
      return TRUE;
    }

    return FALSE;
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

    $sqlRepsonse = db_select('uc_checkoutpaymentplan_payment_plans', 'c')
      ->fields('c')
      ->condition($findcolumn, (string) $findrow, '=')
      ->execute()
      ->fetchAll();

    if (!empty($sqlRepsonse)) {
      $pp = reset($sqlRepsonse);

      $this->id = $pp->id;
      $this->trackId = $pp->track_id;
      $this->autoCapTime = $pp->auto_cap_time;
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
   *   $this->trackId        = 'example_tracker';
   *   $this->autoCapTime    = 0;
   *   $this->recurringCount = 10;
   *   $this->cycle          = '7d';
   *   $this->status         = 1;
   *   $this->db_add();
   *
   * @return bool
   *   TRUE if it successfully added to the database.
   */
  private function db_add() {
    if ($this->db_exists()) {
      throw new Exception("The payment plan already exists.");
    }
    elseif (!$this->validate()) {
      throw new Exception("The supplied values aren't valid.");
    }

    $db = db_insert('uc_checkoutpaymentplan_payment_plans')
      ->fields(array(
        'id'              => $this->id,
        'track_id'        => $this->trackId,
        'auto_cap_time'   => $this->autoCapTime,
        'recurring_count' => $this->recurringCount,
        'cycle'           => $this->cycle,
        'status'          => $this->status,
      ))
      ->execute();

    return TRUE;
  }

  /**
   * Update this paymentplan in the local database.
   *
   * Minimal usage:
   *   $this->id     = 'rp_000000000000000';
   *   $this->status = 1;
   *   $this->db_update();
   *
   * @return bool
   *   TRUE if it successfully updated the database.
   */
  private function db_update() {
    if (!$this->db_exists() || !$this->validateAll()) {
      return FALSE;
    }

    if ($this->trackId != NULL) {
      $updatedvalues['track_id'] = $this->trackId;
    }
    if ($this->autoCapTime != NULL) {
      $updatedvalues['auto_cap_time'] = $this->autoCapTime;
    }
    if ($this->recurringCount != NULL) {
      $updatedvalues['recurring_count'] = $this->recurringCount;
    }
    if ($this->cycle != NULL) {
      $updatedvalues['cycle'] = $this->cycle;
    }
    if ($this->status != NULL) {
      $updatedvalues['status'] = $this->status;
    }

    $db = db_update('uc_checkoutpaymentplan_payment_plans')
      ->fields($updatedvalues)
      ->condition('id', $this->id, '=')
      ->execute();

    if ($db == 1) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * Checks all paremeters for validity and returns true if all are valid.
   *
   * Note: empty paramates are considered valid.
   *
   * @return bool
   *   TRUE if there are no invalid paramters.
   */
  private function validateAll() {
    foreach ($this as $object => $value) {
      if ($value != NULL) {
        $errors[$object] = $this->validate($object, $value);
      }
    }

    foreach ($errors as $field => $message) {
      if ($message != null) {
        return FALSE;
      }
    }

    return TRUE;
  }

  private function print_errors() {
    foreach ($this->errors as $error) {
      
    }
    
    $this->errors = null;
  }
}

/**
 * The Checkout.com Customer Payment Plan
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
   * Get a customer paymentplan from the Checkout.com server.
   *
   * How to use this:
   *   $customer_payment_plan = new PaymentPlan;
   *   $customer_payment_plan->id = 'rp_000000000000000';
   *   $customer_payment_plan->get();
   *
   * @return bool
   *   Returns true if succeeded or false (with drupal message) when failed.
   */
  public function get() {
    if ($this->api_get()) {
      return TRUE;
    }

    return FALSE;
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

    $apiClient = new com\checkout\Apiclient('sk_test_f574d9f5-225b-4d04-bb83-58f5a34e2a97');
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

      return TRUE;
    }

    return FALSE;
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
      $apiClient = new com\checkout\Apiclient('sk_test_f574d9f5-225b-4d04-bb83-58f5a34e2a97');
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
      throw new Exception("API " . $e->getErrorCode() . " | " . $e->getErrorMessage());
    }

    if ($reponse->hasError()) {
      throw new Exception("API " . $e->getHttpStatus() . " | " . $e->getMessage());
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
      $apiClient = new com\checkout\Apiclient('sk_test_f574d9f5-225b-4d04-bb83-58f5a34e2a97');
      $service = $apiClient->Recurringpaymentservice();

      $request = new com\checkout\Apiservices\Recurringpayments\Requestmodels\Planupdate();
      $reponse = $service->cancelPlan($this->id);
    }
    catch (Exception $e) {
      throw new Exception("API " . $e->getErrorCode() . " | " . $e->getErrorMessage());
    }

    if ($reponse->hasError()) {
      throw new Exception("API " . $e->getHttpStatus() . " | " . $e->getMessage());
    }

    return TRUE;
  }
}

/**
 * The Checkout.com Payment Plan
 */
class PaymentPlanStoreSettings {
  public $planId;
}
