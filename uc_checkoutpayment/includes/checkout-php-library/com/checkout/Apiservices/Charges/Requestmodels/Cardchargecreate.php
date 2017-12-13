<?php

/**
 * Checkout.com Apiservices\Charges\Requestmodels\CardChargeCreate.
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
 * Class Card Charge Create.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class CardChargeCreate extends Basecharge {
  protected $baseCardcreate;
  protected $transactionIndicator;

  /**
   * Get the base card create.
   *
   * @return mixed
   *   The baseCardcreate.
   */
  public function getBasecardcreate() {
    return $this->baseCardcreate;
  }

  /**
   * Get the base card create.
   *
   * @param mixed $baseCardcreate
   *   The baseCardcreate.
   */
  public function setBasecardcreate(
    \com\checkout\Apiservices\Cards\Requestmodels\Basecardcreate $baseCardcreate
  ) {
    $this->baseCardcreate = $baseCardcreate;
  }

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
