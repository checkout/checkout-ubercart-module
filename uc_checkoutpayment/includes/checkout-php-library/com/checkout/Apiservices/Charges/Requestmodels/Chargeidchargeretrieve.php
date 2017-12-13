<?php

/**
 * Checkout.com Apiservices\Charges\Requestmodels\Chargeidchargeretrieve.
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
 * Class Charge Id Charge Retrieve.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Chargeidchargeretrieve {
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
  private $chargeId;
}
