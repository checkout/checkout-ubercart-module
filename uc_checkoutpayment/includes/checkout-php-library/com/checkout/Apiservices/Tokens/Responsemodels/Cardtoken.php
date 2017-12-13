<?php

/**
 * Checkout.com Apiservices\Tokens\Responsemodels\Cardtoken.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Tokens\Responsemodels;

/**
 * Class Card Token.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardtoken {
  private $object;
  private $id;
  private $liveMode;
  private $created;
  private $used;
  private $paymentType;
  private $card;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    $this->setCard($response->getCard());
    $this->setCreated($response->getCreated());
    $this->setId($response->getId());
    $this->setLiveMode($response->getLiveMode());
    $this->setObject($response->getObject());
    $this->setPaymentType($response->getPaymentType());
    $this->setUsed($response->getUsed());
  }

  /**
   * Set a card.
   *
   * @param mixed $card
   *   The card.
   */
  private function setCard($card) {
    $cardObg = new \com\checkout\Apiservices\Cards\Responsemodels\Card();
    $billingDetails = new \com\checkout\Apiservices\Sharedmodels\Address();
    $billingAddress = $card->getBillingDetails();
    $billingDetails->setAddressLine1($billingAddress->getAddressLine1());
    $billingDetails->setAddressLine2($billingAddress->getAddressLine2());
    $billingDetails->setPostcode($billingAddress->getPostcode());
    $billingDetails->setCountry($billingAddress->getCountry());
    $billingDetails->setCity($billingAddress->getCity());
    $billingDetails->setState($billingAddress->getState());
    $billingDetails->setPhone($billingAddress->getPhone());

    $cardObg->setId($card->getId());
    $cardObg->setObject($card->getObject());
    $cardObg->setName($card->getName());
    $cardObg->setLast4($card->getLast4());
    $cardObg->setPaymentMethod($card->getPaymentMethod());
    $cardObg->setFingerprint($card->getFingerprint());
    $cardObg->setCustomerId($card->getCustomerId());
    $cardObg->setExpiryMonth($card->getExpiryMonth());
    $cardObg->setExpiryYear($card->getExpiryYear());
    $cardObg->setBillingDetails($billingDetails);
    $cardObg->setCvcCheck($card->getCvcCheck());
    $cardObg->setAvsCheck($card->getAvsCheck());
    $cardObg->setAuthCode($card->getAuthCode());
    $cardObg->setDefaultCard($card->getDefaultCard());
    $cardObg->setLiveMode($card->getLiveMode());
    $this->card = $cardObg;

  }

  /**
   * Set the UTC date and time based on ISO 8601 profile.
   *
   * @param mixed $created
   *   The created date.
   */
  private function setCreated($created) {
    $this->created = $created;
  }

  /**
   * Set the string that uniquely identifies the transaction.
   *
   * Note: The card id is prefixed with charge_.
   *
   * @param mixed $id
   *   The chargeId.
   */
  private function setId($id) {
    $this->id = $id;
  }

  /**
   * Set the live mode.
   *
   * Defined as true if live keys were used in the request.
   * Defined as false if test keys were used in the request.
   *
   * @param mixed $liveMode
   *   The LiveMode.
   */
  private function setLiveMode($liveMode) {
    $this->liveMode = $liveMode;
  }

  /**
   * Set an object.
   *
   * @param int $object
   *   The object.
   */
  private function setObject($object) {
    $this->object = $object;
  }

  /**
   * Set the payment type.
   * 
   * @param mixed $paymentType
   *   The payment type.
   */
  private function setPaymentType($paymentType) {
    $this->paymentType = $paymentType;
  }

  /**
   * Set the used variable, whatever this is.
   * 
   * @param mixed $used
   *   The used variable.
   */
  private function setUsed($used) {
    $this->used = $used;
  }

  /**
   * Get a card.
   *
   * @return mixed
   *   The card.
   */
  public function getCard() {
    return $this->card;
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
   * Get the string that uniquely identifies the transaction.
   *
   * Note: The card id is prefixed with charge_.
   *
   * @return mixed
   *   The chargeId.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get the live mode.
   *
   * Defined as true if live keys were used in the request.
   * Defined as false if test keys were used in the request.
   *
   * @return mixed
   *   The LiveMode.
   */
  public function getLiveMode() {
    return $this->liveMode;
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
   * Get the payment type.
   * 
   * @return mixed
   *   The payment type.
   */
  public function getPaymentType() {
    return $this->paymentType;
  }

  /**
   * Get the used variable, whatever this is.
   * 
   * @return mixed
   *   The used variable.
   */
  public function getUsed() {
    return $this->used;
  }

}
