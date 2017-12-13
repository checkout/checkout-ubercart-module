<?php

/**
 * Checkout.com Apiservices\Charges\Requestmodels\Chargeretrievewithpaymenttoken.
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
 * Class Charge Retrieve With Payment Token.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Chargeretrievewithpaymenttoken {
  private $paymentToken;

  /**
   * Get a card token.
   *
   * Note: The card token is prefix card_tok_.
   * Note: A cardToken can only be used once and will expire after 15 minutes.
   *
   * @return mixed
   *   The cardToken.
   */
  public function getPaymenttoken() {
    return $this->paymentToken;
  }

  /**
   * Set a card token.
   *
   * Note: The card token is prefix card_tok_.
   * Note: A cardToken can only be used once and will expire after 15 minutes.
   *
   * @param mixed $cardToken
   *   The cardToken.
   */
  public function setPaymenttoken($paymentToken) {
    $this->paymentToken = $paymentToken;
  }
}
