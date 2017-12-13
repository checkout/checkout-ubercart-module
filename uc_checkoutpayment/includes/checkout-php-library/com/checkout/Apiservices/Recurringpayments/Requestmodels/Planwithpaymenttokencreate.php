<?php

/**
 * Checkout.com Apiservices\Recurringpayments\Requestmodels\Planwithpaymenttokencreate.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */
namespace com\checkout\Apiservices\Recurringpayments\Requestmodels;

/**
 * Class Plan With Payment Token Create.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Planwithpaymenttokencreate extends \com\checkout\Apiservices\Charges\Requestmodels\Basecharge {
  protected $transactionIndicator;
  protected $paymentPlans = array();

  /**
   * Get the transaction indicator.
   * 
   * Transaction indicator.
   *   Set to 1 for regular.
   *   Set to 2 for recurring.
   *   Set to 3 for MOTO.
   *
   * @return mixed
   *   The transactionIndicator.
   */
  public function getTransactionIndicator() {
    return $this->transactionIndicator;
  }

  /**
   * Set the transaction indicator.
   * 
   * Transaction indicator.
   *   Set to 1 for regular.
   *   Set to 2 for recurring.
   *   Set to 3 for MOTO.
   *
   * @return mixed
   *   The transactionIndicator.
   */
  public function setTransactionIndicator($transactionIndicator) {
    $this->transactionIndicator = $transactionIndicator;
  }

  /**
   * Get an array of payment plans.
   *
   * Payment Plans store all the necessary information in support of implementing
   * subscription services, membership services, and other popular recurring
   * payment models. The fields within the Payment Plan object allow you to
   * customise several important details, including the amount charged to the
   * customer, currency, recurring billing cycle, and the number of recurring
   * transactions in the plan.
   *
   * @return mixed
   *   The paymentPlans.
   */
  public function getPaymentplans() {
    return $this->paymentPlans;
  }

  /**
   * Set an array of payment plans.
   *
   * Payment Plans store all the necessary information in support of implementing
   * subscription services, membership services, and other popular recurring
   * payment models. The fields within the Payment Plan object allow you to
   * customise several important details, including the amount charged to the
   * customer, currency, recurring billing cycle, and the number of recurring
   * transactions in the plan.
   *
   * @param mixed $paymentPlans
   *   The paymentPlans.
   */
  public function setPaymentplans(Baserecurringpayment $paymentPlans) {
    $this->paymentPlans[] = $paymentPlans;
  }
}
