<?php

/**
 * Checkout.com Apiservices\Recurringpayments\Requestmodels\Planwithcardtokencreate.
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
 * Class Plan With Card Token Create.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Planwithcardtokencreate extends \com\checkout\Apiservices\Charges\Requestmodels\Basecharge {
  protected $cardToken;
  protected $transactionIndicator;
  protected $paymentPlans;

  /**
   * Get a card token.
   *
   * Note: Card token prefixed with card_tok_.
   * Note: A cardToken can only be used once and will expire after 15 minutes.
   *
   * @return mixed
   *   The cardToken.
   */
  public function getCardtoken() {
    return $this->cardToken;
  }

  /**
   * Set a card token.
   *
   * Note: Card token prefixed with card_tok_.
   * Note: A cardToken can only be used once and will expire after 15 minutes.
   *
   * @param mixed $cardToken
   *   The cardToken.
   */
  public function setCardtoken($cardToken) {
    $this->cardToken = $cardToken;
  }

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
