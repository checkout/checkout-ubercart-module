<?php

/**
 * Checkout.com Apiservices\Tokens\Responsemodels\Paymenttokencreate.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Tokens\Requestmodels;

/**
 * Class Payment Token Create.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Paymenttokencreate extends \com\checkout\Apiservices\Charges\Requestmodels\Basecharge {
  protected $transactionIndicator;

  /**
   * Get the transaction indicator.
   *
   * Options:
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
   * Options:
   *   Set to 1 for regular.
   *   Set to 2 for recurring.
   *   Set to 3 for MOTO.
   *
   * @param mixed $transactionIndicator
   *   The transactionIndicator.
   */
  public function setTransactionIndicator($transactionIndicator) {
    $this->transactionIndicator = $transactionIndicator;
  }
}
