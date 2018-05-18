<?php

/**
 * The Checkout.com Customer Payment Plan.
 */
class Charge {
  public $id;
  public $created;
  public $email;
  public $trackId;
  public $value;
  public $currency;
  public $responseMessage;
  public $responseCode;
  public $status;

  /**
   * PHP Class constructor
   */
  public function __construct ($trackId) {
    $this->trackId = $trackId;
    $this->get();
  }

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
    if ($this->db_get() || $this->api_query()) {
      return true;
    }

    return false;
  }

  public function save() {
    if ($this->db_add()) {
      return true;
    }

    return false;
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
    if ($this->trackId == null) {
      return false;
    }
    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Reporting/Reportingservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Reporting/Requestmodels/Transactionfilter';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    $apiClient = new com\checkout\Apiclient(variable_get('cko_private_key'),variable_get('cko_mode'));
    $service = $apiClient->Reportingservice();

    $request = new com\checkout\Apiservices\Reporting\Requestmodels\Transactionfilter();
    $request->setPageSize('100');
    $request->setSortColumn('date');
    $request->setFilters(
      array(
        "action" => "include",
        "field" => "TrackID",
        "operator" => "EQUALS",
        "value" => $this->trackId,
      )
    );

    $response = $service->queryTransaction($request);

    if (!empty($response)) {
      foreach ($response as $value) {
        $this->id = $value->id;
        $this->created = $value->created;
        $this->trackId = $value->track_id;
        $this->currency = $value->currency;
        $this->responseMessage = $value->responseMessage;
        $this->responseCode = $value->responseCode;
        $this->status = $value->status;
        $this->value = $data->value;
        $this->email = $data->email;

        $this->db_add();
      }

      return $this->db_get();
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
    if ($this->trackId == null) {
      return FALSE;
    }

    $sqlRepsonse = db_select('uc_checkoutpayment_hub_communication', 'c')
      ->fields('c')
      ->condition('track_id', $this->trackId, '=')
      ->orderBy('created', 'DESC')
      ->execute()
      ->fetchAll();
  
    if (!empty($sqlRepsonse)) {
      $data = reset($sqlRepsonse);
      $default = end($sqlRepsonse);

      $this->email = $default->email;

      foreach ($sqlRepsonse as $charge) {
        if ($charge->status == $data->status) {
          $this->value += $charge->value;
        }
    
        if ($charge->responseCode == '10100') {
          $data->responseMessage = $charge->responseMessage;
        }
      }

      $this->id = $data->id;
      $this->created = $data->created;
      $this->trackId = $data->track_id;
      $this->currency = $data->currency;
      $this->responseMessage = $data->responseMessage;
      $this->responseCode = $data->responseCode;
      $this->status = $data->status;

      return TRUE;
    }

    return false;
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
  private function db_add() {
    try {
      db_insert('uc_checkoutpayment_hub_communication')
      ->fields(array(
        'id'              => $this->id,
        'created'         => $this->created,
        'email'           => $this->email,
        'track_id'        => $this->trackId,
        'value'           => $this->value,
        'currency'        => $this->currency,
        'responseMessage' => $this->responseMessage,
        'responseCode'    => $this->responseCode,
        'status'          => $this->status,
      ))
      ->execute();
    }
    catch (Exception $e) {
      watchdog(
        'Checkout.com',
        'Notice: The charge wasn\'t added to the the local database.
        (:errorMessage)',
        array(
          ':errorMessage' => $e->getMessage(),
        ),
        WATCHDOG_NOTICE
      );

      return false;
    }

    return true;
  }
}
