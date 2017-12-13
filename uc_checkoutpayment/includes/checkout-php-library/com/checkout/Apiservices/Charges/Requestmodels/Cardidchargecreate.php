<?php

/**
 * Checkout.com Apiservices\Charges\Requestmodels\Cardidchargecreate.
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
 * Class Card Id Charge Create.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardidchargecreate extends Basecharge {
  protected $cardId;
  protected $cvv;
  protected $transactionIndicator;

  /**
   * Get the string that uniquely identifies a card per customer.
   *
   * Each time the same card is used by a different customer,
   * a new cardId will be generated.
   *
   * Note: The card id is prefixed with card_.
   *
   * @return mixed
   *   The cardId.
   */
  public function getCardId() {
    return $this->cardId;
  }

  /**
   * Set the string that uniquely identifies a card per customer.
   *
   * Each time the same card is used by a different customer,
   * a new cardId will be generated.
   *
   * Note: The card id is prefixed with card_.
   *
   * @param mixed $cardId
   *   The cardId.
   */
  public function setCardId($cardId) {
    $this->cardId = $cardId;
  }

  /**
   * Get a Card security code.
   *
   * Four-digits for Amex, three-digits for all other cards.
   *
   * @return mixed
   *   The cvv.
   */
  public function getCvv() {
    return $this->cvv;
  }

  /**
   * Set a Card security code.
   *
   * Four-digits for Amex, three-digits for all other cards.
   *
   * @param mixed $cvv
   *   The cvv.
   */
  public function setCvv($cvv) {
    $this->cvv = $cvv;
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
