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

  public function save() {
    $class[] = 'includes/checkout-php-library/autoload';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiclient';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Recurringpaymentsservice';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Requestmodels/Baserecurringpayment';
    $class[] = 'includes/checkout-php-library/com/checkout/Apiservices/Recurringpayments/Responsemodels/Recurringpayment';

    foreach ($class as $path) {
      module_load_include('php', 'uc_checkoutpayment', $path);
    }

    $apiClient = new com\checkout\Apiclient('sk_test_f574d9f5-225b-4d04-bb83-58f5a34e2a97');
    $rpService = $apiClient->Recurringpaymentservice();

    $ppModel = new com\checkout\Apiservices\Recurringpayments\Requestmodels\Baserecurringpayment();
    $ppModel->setName($this->name);
    $ppModel->setPlanTrackId($this->trackId);
    $ppModel->setAutoCapTime($this->autoCapTime);
    $ppModel->setCurrency($this->currency);
    $ppModel->setValue($this->value);
    $ppModel->setCycle($this->cycle);
    $ppModel->setRecurringCount($this->recurringCount);
    $ppModel->setStatus($this->status);

    $reponse = $rpService->createSinglePlan($ppModel);
    $reponseplan = $reponse->getPaymentPlans()[0];
    
    $this->id = $reponseplan->getPlanId();
    $this->value = $reponseplan->getValue();
    $this->add_to_database();
  }

  private function add_to_database() {
    db_insert('uc_checkoutpaymentplan_payment_plans')
    ->fields(array(
      'id'              => $this->id,
      'track_id'        => $this->trackId,
      'auto_cap_time'   => $this->autoCapTime,
      'recurring_count' => $this->recurringCount,
      'cycle'           => $this->cycle,
      'status'          => $this->status,
    ))
    ->execute();
  }

  public function get() {
    if ($this->trackId != NULL) {
      $findcolumn = 'track_id';
      $findrow    = $this->trackId;
    }
    else {
      return NULL;
    }

    $sqlRepsonse = db_select('uc_checkoutpaymentplan_payment_plans', 'c')
      ->fields('c')
      ->condition($findcolumn, (string) $findrow, '=')
      ->execute()
      ->fetchAll();

    $pp = reset($sqlRepsonse);

    $this->id = $pp->id;
    $this->autoCapTime = $pp->auto_cap_time;
    $this->cycle = $pp->cycle;
    $this->recurringCount = $pp->recurring_count;
    $this->status = $pp->status;
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
