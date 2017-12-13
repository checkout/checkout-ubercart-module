<?php

/**
 * Checkout.com Apiservices\Recurringpayments\Requestmodels\Customerplanupdate.
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
 * Class Customer Plan Update.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Customerplanupdate extends Baserecurringpayment {
  private $customerPlanId;
  private $cardId;

  /**
   * Get the ID that uniquely identifies the customer payment plan.
   *
   * Note: ID prefixed with cp_ .
   *
   * @return mixed
   *   The customerPlanId.
   */
  public function getCustomerPlanId() {
    return $this->customerPlanId;
  }

  /**
   * Set the ID that uniquely identifies the customer payment plan.
   *
   * Note: ID prefixed with cp_ .
   *
   * @param mixed $customerPlanId
   *   The customerPlanId.
   */
  public function setCustomerPlanId($customerPlanId) {
    $this->customerPlanId = $customerPlanId;
  }

  /**
   * Get the card id that uniquely identifies the customer's card details.
   *
   * Note: ID prefixed with card_ .
   *
   * @return mixed
   *   The customerPlanId.
   */
  public function getCardId() {
    return $this->cardId;
  }

  /**
   * Set the card id that uniquely identifies the customer's card details.
   *
   * Note: ID prefixed with card_ .
   *
   * @param mixed $cardId
   *   The cardId.
   */
  public function setCardId($cardId) {
    $this->cardId = $cardId;
  }
}
