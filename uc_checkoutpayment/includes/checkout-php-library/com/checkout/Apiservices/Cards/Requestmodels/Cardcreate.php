<?php

/**
 * Checkout.com Apiservices\Cards\Requestmodels\CardCreate.
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
 * Class Card Creates.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardcreate {
  private $customerId;
  private $baseCardcreate;

  /**
   * Get the customer ID.
   *
   * Note: The customer id is prefixed with cust_.
   *
   * @return mixed
   *   The CustomerId.
   */
  public function getCustomerId() {
    return $this->customerId;
  }

  /**
   * Set the customer ID.
   *
   * Note: The customer id is prefixed with cust_.
   *
   * @param mixed $customerId
   *   The CustomerId.
   */
  public function setCustomerId($customerId) {
    $this->customerId = $customerId;
  }

  /**
   * Get the base card create object.
   *
   * @return mixed
   *   The baseCardcreate.
   */
  public function getBasecardcreate() {
    return $this->baseCardcreate;
  }

  /**
   * Set the base card create object.
   *
   * @param mixed $baseCardcreate
   *   The baseCardcreate.
   */
  public function setBasecardcreate(
    \com\checkout\Apiservices\Cards\Requestmodels\Basecardcreate $baseCardcreate
  ) {
    $this->baseCardcreate = $baseCardcreate;
  }
}
