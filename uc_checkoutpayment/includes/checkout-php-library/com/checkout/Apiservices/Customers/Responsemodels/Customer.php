<?php

/**
 * Checkout.com Apiservices\Customers\Responsemodels\Customer.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Customers\Responsemodels;

/**
 * Class Customer.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Customer extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  private $object;
  private $id;
  private $name;
  private $customerName;
  private $created;
  private $email;
  private $phoneNumber;
  private $description;
  private $ltv;
  private $defaultCard;
  private $responseCode;
  private $liveMode;
  private $cards;
  private $metadata;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setObject($response->getObject());
    $this->setCards($response->getCards());
    $this->setCreated($response->getCreated());
    $this->setDefaultCard($response->getdDefaultCard());
    $this->setDescription($response->getdDescription());
    $this->setEmail($response->getEmail());
    $this->setId($response->getId());
    $this->setLiveMode($response->getLiveMode());
    $this->setLtv($response->getLtv());
    $this->setMetadata($response->getMetadata());
    $this->setName($response->getName());
    $this->setPhoneNumber($response->getPhoneNumber());
    $this->setResponseCode($response->getResponseCode());
    $this->setCustomerName($response->getCustomerName());
  }

  /**
   * Get all customer cards.
   *
   * A hash containing an array of cards.
   *
   * @return mixed
   *   The array of cards.
   */
  public function getCards() {
    return $this->cards;
  }

  /**
   * Get a card.
   *
   * @param mixed $card
   *   The card.
   */
  private function getCard($card) {

    $cardObg = new \com\checkout\Apiservices\Cards\Responsemodels\Cardlist($card);
    return $cardObg;
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
   * Get the cardId of the customer's default card.
   *
   * Note: The card id is prefixed with card_.
   *
   * @return mixed
   *   The defaultCard.
   */
  public function getDefaultCard() {
    return $this->defaultCard;
  }

  /**
   * Get a description that can be added to this object.
   *
   * @return mixed
   *   The description.
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Get the email address of the customer.
   *
   * @return mixed
   *   The email.
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Get the customer name.
   *
   * @return mixed
   *   The customerName.
   */
  public function getCustomerName() {
    return $this->customerName;
  }

  /**
   * Get the customer ID.
   *
   * Note: The customer id is prefixed with cust_.
   *
   * @return mixed
   *   The CustomerId.
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
   * Get the lifetime value of the customer.
   *
   * Sum of all captured transactions made by the customer.
   * Refunded transactions do not have an effect on LTV.
   *
   * @return mixed
   *   The ltv.
   */
  public function getLtv() {
    return $this->ltv;
  }

  /**
   * Get a hash of FieldName and value pairs.
   *
   * A hash of FieldName and value pairs e.g. {'keys1': 'Value1'}.
   * Max length of key(s) and value(s) is 100 each. A max. of 10 KVP are allowed.
   *
   * @return mixed
   *   The metadata.
   */
  public function getMetadata() {
    return $this->metadata;
  }

  /**
   * Get the customer name.
   *
   * @return mixed
   *   The customerName.
   */
  public function getName() {
    return $this->name;
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
   * Get the phone number object of the customer/cardholder.
   *
   * It contains:
   *   countryCode: Valid country code for the phone number
   *   number: Phone number.
   *
   * @return mixed
   *   The phoneNumber.
   */
  public function getPhoneNumber() {
    return $this->phoneNumber;
  }

  /**
   * Get the response Code indicating the status of the request.
   *
   * @return mixed
   *   The responseCode.
   */
  public function getResponseCode() {
    return $this->responseCode;
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
   * Set the customer cards.
   *
   * A hash containing an array of cards.
   *
   * @param mixed $cards
   *   The array of cards.
   */
  private function setCards($cards) {
    if ($cards) {
      $cardsArray = $cards->toArray();
      $this->cards = $this->getCard($cards);
    }
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
   * Set the cardId of the customer's default card.
   *
   * Note: The card id is prefixed with card_.
   *
   * @param mixed $defaultCard
   *   The defaultCard.
   */
  private function setDefaultCard($defaultCard) {
    $this->defaultCard = $defaultCard;
  }

  /**
   * Set a description that can be added to this object.
   *
   * @param mixed $description
   *   The description.
   */
  private function setDescription($description) {
    $this->description = $description;
  }

  /**
   * Set the email address of the customer.
   *
   * @param mixed $email
   *   The email.
   */
  private function setEmail($email) {
    $this->email = $email;
  }

  /**
   * Set the customer name.
   *
   * @param mixed $customerName
   *   The customerName.
   */
  private function setCustomerName($customerName) {
    $this->customerName = $customerName;
  }

  /**
   * Set the customer ID.
   *
   * Note: The customer id is prefixed with cust_.
   *
   * @param mixed $id
   *   The CustomerId.
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
   * Set the lifetime value of the customer.
   *
   * Sum of all captured transactions made by the customer.
   * Refunded transactions do not have an effect on LTV.
   *
   * @param mixed $ltv
   *   The ltv.
   */
  private function setLtv($ltv) {
    $this->ltv = $ltv;
  }

  /**
   * Set a hash of FieldName and value pairs.
   *
   * A hash of FieldName and value pairs e.g. {'keys1': 'Value1'}.
   * Max length of key(s) and value(s) is 100 each. A max. of 10 KVP are allowed.
   *
   * @param mixed $metadata
   *   The metadata.
   */
  private function setMetadata($metadata) {
    if ($metadata) {
      $this->metadata = $metadata->toArray();
    }
  }

  /**
   * Set the customer name.
   *
   * @param mixed $name
   *   The customerName.
   */
  private function setName($name) {
    $this->name = $name;
  }

  /**
   * Set the phone number object of the customer/cardholder.
   *
   * It contains:
   *   countryCode: Valid country code for the phone number
   *   number: Phone number.
   *
   * @return mixed $phoneNumber
   *   The phoneNumber.
   */
  private function setPhoneNumber($phoneNumber) {
    $this->phoneNumber = $phoneNumber;
  }

  /**
   * Set the response Code indicating the status of the request.
   *
   * @return mixed $responseCode
   *   The responseCode.
   */
  private function setResponseCode($responseCode) {
    $this->responseCode = $responseCode;
  }

}
