<?php

/**
 * Checkout.com Apiservices\Charges\Requestmodels\Cardtokenchargecreate.
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
 * Class Card Token Charge Create.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardtokenchargecreate extends Basecharge {
  private $cardToken;
  protected $transactionIndicator;

  /**
   * Get a card token.
   *
   * Note: The card token is prefix card_tok_.
   * Note: A cardToken can only be used once and will expire after 15 minutes.
   *
   * @return mixed
   *   The cardToken.
   */
  public function getCardtoken() {
    return $this->cardToken;
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
  public function setCardtoken($cardToken) {
    $this->cardToken = $cardToken;
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
