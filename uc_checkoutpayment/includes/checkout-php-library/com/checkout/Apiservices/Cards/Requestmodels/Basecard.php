<?php

/**
 * Checkout.com Apiservices\Cards\Requestmodels\BaseCard.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Cards\Requestmodels;

/**
 * Class base card.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Basecard {
  protected $name;
  protected $expiryMonth;
  protected $expiryYear;
  protected $billingDetails;
  protected $defaultCard;

  /**
   * Get the customer name.
   *
   * @return mixed
   *   The name.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set the customer name.
   *
   * @param mixed $name
   *   The name.
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Get the two-digit number representing the expiry month of the card.
   *
   * @return mixed
   *   The expiryMonth.
   */
  public function getExpiryMonth() {
    return $this->expiryMonth;
  }

  /**
   * Set the two-digit number representing the expiry month of the card.
   *
   * @param mixed $expiryMonth
   *   The expiryMonth.
   */
  public function setExpiryMonth($expiryMonth) {
    $this->expiryMonth = $expiryMonth;
  }

  /**
   * Get the two or four-digit number representing the expiry year of the card.
   *
   * @return mixed
   *   The expiryYear.
   */
  public function getExpiryYear() {
    return $this->expiryYear;
  }

  /**
   * Set the two or four-digit number representing the expiry year of the card.
   *
   * @param mixed $expiryYear
   *   The expiryYear.
   */
  public function setExpiryYear($expiryYear) {
    $this->expiryYear = $expiryYear;
  }

  /**
   * Get the Billing Details object.
   *
   * It contains address details along with an associated phone number (optional).
   *
   * "billingDetails": {
   *   "addressLine1": "333 Cormier Bypass",
   *   "addressLine2": "Rolfson Alley",
   *   "postcode": "ue0 2ou",
   *   "country": "US",
   *   "city": "Schmittchester",
   *   "state": "Jakubowskiton",
   *   "phone": {
   *       "countryCode": "44",
   *       "number": "12345678"
   *     }
   *   }
   *
   * @return mixed
   *   The BillingDetails .
   */
  public function getBillingDetails() {
    return $this->billingDetails;
  }

  /**
   * Set the Billing Details object.
   *
   * It contains address details along with an associated phone number (optional).
   *
   * "billingDetails": {
   *   "addressLine1": "333 Cormier Bypass",
   *   "addressLine2": "Rolfson Alley",
   *   "postcode": "ue0 2ou",
   *   "country": "US",
   *   "city": "Schmittchester",
   *   "state": "Jakubowskiton",
   *   "phone": {
   *       "countryCode": "44",
   *       "number": "12345678"
   *     }
   *   }
   *
   * @param mixed $billingDetails
   *   The BillingDetails .
   */
  public function setBillingDetails(
    \com\checkout\Apiservices\Sharedmodels\Address $billingDetails
  ) {
    $this->billingDetails = $billingDetails;
  }

  /**
   * Get the cardId of the customer's default card.
   *
   * Note: The card id is prefixed with card_.
   *
   * @return mixed
   *   The defaultCard.
   */
  public function getDefaultCard() {
    return $this->defaultCard;
  }

  /**
   * Set the cardId of the customer's default card.
   *
   * Note: The card id is prefixed with card_.
   *
   * @param mixed $defaultCard
   *   The defaultCard.
   */
  public function setDefaultCard($defaultCard) {
    $this->defaultCard = $defaultCard;
  }
}
