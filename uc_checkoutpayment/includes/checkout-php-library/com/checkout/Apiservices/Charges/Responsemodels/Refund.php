<?php

/**
 * Checkout.com Api Services Recurring Payment Refund.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Charges\Responsemodels;

/**
 * Class Refund.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Refund extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  private $object;
  private $amount;
  private $currency;
  private $created;
  private $balanceTransaction;

  /**
   * Get a positive non-zero integer representing the refund amount.
   *
   * Cannot be greater than the original capture amount. Multiple refunds
   * up to the original capture amount are allowed. Defaults to the captured
   * amount if not specified.
   *
   * @return mixed
   *   The refundedValue.
   */
  public function getAmount() {
    return $this->amount;
  }

  /**
   * Set a positive non-zero integer representing the refund amount.
   *
   * Cannot be greater than the original capture amount. Multiple refunds
   * up to the original capture amount are allowed. Defaults to the captured
   * amount if not specified.
   *
   * @param mixed $refundedValue
   *   The refundedValue.
   */
  public function setAmount($amount) {
    $this->amount = $amount;
  }

  /**
   * Get the balance of the transaction.
   *
   * @return mixed
   *   The balanceTransaction.
   */
  public function getBalanceTransaction() {
    return $this->balanceTransaction;
  }

  /**
   * Set the balance of the transaction.
   *
   * @param mixed $balanceTransaction
   *   The balanceTransaction.
   */
  public function setBalanceTransaction($balanceTransaction) {
    $this->balanceTransaction = $balanceTransaction;
  }

  /**
   * Get the UTC date and time based on ISO 8601 profile.
   *
   * @return mixed
   *   The created date.
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * Set the UTC date and time based on ISO 8601 profile.
   *
   * @param mixed $created
   *   The created date.
   */
  public function setCreated($created) {
    $this->created = $created;
  }

  /**
   * Get the Three-letter ISO currency code.
   *
   * This code is representing the currency in
   * which the recurring charge will be made.
   *
   * @return mixed
   *   The currency.
   */
  public function getCurrency() {
    return $this->currency;
  }

  /**
   * Set the Three-letter ISO currency code.
   *
   * This code is representing the currency in
   * which the recurring charge will be made.
   *
   * @param mixed $currency
   *   The currency.
   */
  public function setCurrency($currency) {
    $this->currency = $currency;
  }

  /**
   * Get an object.
   *
   * @return mixed
   *   The object.
   */
  public function getObject() {
    return $this->object;
  }

  /**
   * Set an object.
   *
   * @param int $object
   *   The object.
   */
  public function setObject($object) {
    $this->object = $object;
  }

}
