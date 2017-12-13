<?php

/**
 * Checkout.com Apiservices\Cards\Requestmodels\CardUpdate.
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
 * Class Card Update.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardupdate {
  private $cardId;
  private $customerId;
  private $baseCard;

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
  public function getBasecard() {
    return $this->baseCard;
  }

  /**
   * Set the base card create object.
   *
   * @param mixed $baseCardcreate
   *   The baseCardcreate.
   */
  public function setBasecard(
    \com\checkout\Apiservices\Cards\Requestmodels\Basecard $baseCard
  ) {
    $this->baseCard = $baseCard;
  }
}
