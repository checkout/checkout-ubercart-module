<?php

/**
 * Checkout.com Apiservices\Sharedmodels\ShippingAddress.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Sharedmodels;

/**
 * Class ShippingAddress.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class ShippingAddress extends Address {
  protected $recipientName;

  /**
   * Get recipients name.
   *
   * @return mixed
   *   The recipientName.
   */
  public function getRecipientName() {
    return $this->recipientName;
  }

  /**
   * Set recipients name.
   *
   * @param mixed $recipientName
   *   The recipientName.
   */
  public function setRecipientName($recipientName) {
    $this->recipientName = $recipientName;
  }
}
