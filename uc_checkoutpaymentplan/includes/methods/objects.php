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
  public $errors;

  public function save() {
    if (!$this->db_exists()) {
      try {
        $this->api_create();
      }
      catch (Exception $e) {
        drupal_set_message(t(':message', array(':message' => $e->getMessage(),)), 'error');
        return FALSE;
      }

      return TRUE;
    }

    try {
      $this->api_update();
      $this->db_update();
    }
    catch (Exception $e) {
      drupal_set_message(t(':message', array(':message' => $e->getMessage(),)), 'error');
      return FALSE;
    }

    return TRUE;
  }

  public function get() {
    if (/*$this->db_exists() || */$this->api_query()) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * Check if the parameters are valid.
   *
   * Note: empty paramates are considered valid.
   *
   * @return bool
   *   TRUE if there are no invalid paramters.
   */
  public function validate() {
    if ($this->id != NULL) {
      $tests[] = (substr($this->id, 0, 3) === "rp_");
    }

    if ($this->name != NULL) {
      $tests[] = strlen($this->name) <= 100;
    }

    if ($this->value != NULL) {
      $tests[] = is_int((int) $this->value);
    }

    if ($this->currency != NULL) {
      $tests[] = strlen($this->currency) == 3;
    }

    if ($this->trackId != NULL) {
      $tests[] = strlen($this->trackId) <= 50;
    }

    if ($this->autoCapTime != NULL) {
      $tests[] = is_numeric($this->autoCapTime);
    }

    if ($this->recurringCount != NULL) {
      $tests[] = is_int($this->recurringCount);
      $tests[] = $this->recurringCount <= 6993;
    }

    if ($this->cycle != NULL) {
      $tests[] = strlen($this->cycle) <= 4;

      $int = (int) substr($this->cycle, 0, -1);
      switch (strtolower(substr($this->cycle, -1))) {
        case 'd':
          $tests[] = $int > 0 && $int <= 730;
          break;
    
        case 'w':
          $tests[] = $int > 0 && $int <= 104;
          break;
    
        case 'm':
          $tests[] = $int > 0 && $int <= 24;
          break;
    
        case 'y':
          $tests[] = $int > 0 && $int <= 2;
          break;
        
        default:
          $tests[] = FALSE;
          break;
      }
    }

    if ($this->status != NULL) {
      $tests[] = is_int($this->status);
      $tests[] = $this->status == 1 || $this->status == 4;
    }

    $result = TRUE;
    foreach ($tests as $test) {
      $result = $result && $test;
    }

    return $result;
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
   * Update this paymentplan from the Checkout.com API.
   *
   * Minimal usage:
   *   $this->trackId = 'example_tracker';
   *   $this->api_query();
   *
   * @return mixed
   *   TRUE if it was succesfull or the error message if it's not.
   */
  private function api_update() {
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
    if (!$this->db_exists() || !$this->validate()) {
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
   * Gets this paymentplan from the Checkout.com API.
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
  // @todo.
}

/**
 * The Checkout.com Payment Plan
 */
class PaymentPlanStoreSettings {
  public $planId;
}
