<?php

/**
 * Checkout.com Apiservices\Customers\Requestmodels\Customerupdate.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Customers\Requestmodels;

/**
 * Class Customer.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Customerupdate extends Basecustomer {

  private $customerId;

  /**
   * Get the customer id.
   *
   * Note: ID prefixed with cust_.
   *
   * @return mixed
   *   The customerId.
   */
  public function getCustomerId() {
    return $this->customerId;
  }

  /**
   * Set the customer id.
   *
   * Note: ID prefixed with cust_.
   *
   * @param mixed $customerId
   *   The customerId.
   */
  public function setCustomerId($customerId) {
    $this->customerId = $customerId;
  }
}
