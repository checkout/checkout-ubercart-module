<?php

/**
 * Checkout.com Apiservices\Charges\Requestmodels\Chargecapture.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Charges\Requestmodels;

/**
 * Class Charge Capture.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Chargecapture {
  private $chargeId;
  private $value;

  /**
   * Get the value of the transaction.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @return mixed
   *   The value.
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Set the value of the transaction.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @param mixed $value
   *   The value.
   */
  public function setValue($value) {
    $this->value = $value;
  }

  /**
   * Get the string that uniquely identifies the transaction.
   *
   * Note: The card id is prefixed with charge_.
   *
   * @return mixed
   *   The chargeId.
   */
  public function getChargeId() {
    return $this->chargeId;
  }

  /**
   * Set the string that uniquely identifies the transaction.
   *
   * Note: The card id is prefixed with charge_.
   *
   * @param mixed $id
   *   The chargeId.
   */
  public function setChargeId($chargeId) {
    $this->chargeId = $chargeId;
  }
}
