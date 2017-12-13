<?php

/**
 * Checkout.com Apiservices\Cards\Responsemodels\Card.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Cards\Responsemodels;

/**
 * Class Card.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Card extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  protected $object;
  protected $id;
  protected $last4;
  protected $paymentMethod;
  protected $customerId;
  protected $name;
  protected $expiryMonth;
  protected $liveMode;
  protected $expiryYear;
  protected $fingerprint;
  protected $billingDetails;
  protected $cvvCheck;
  protected $avsCheck;
  protected $responseCode;
  protected $authCode;
  protected $defaultCard;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setAuthCode($response->getAuthCode());
    $this->setAvsCheck($response->getAvsCheck());

    if ($response->getBillingDetails()) {
      $this->setBillingDetails($response->getBillingDetails());
    }

    $this->setCustomerId($response->getCustomerId());
    $this->setCvvCheck($response->getCvvCheck());
    $this->setDefaultCard($response->getDefaultCard());
    $this->setExpiryMonth($response->getExpiryMonth());
    $this->setExpiryYear($response->getExpiryYear());
    $this->setFingerprint($response->getFingerprint());
    $this->setId($response->getId());
    $this->setLast4($response->getLast4());
    $this->setLiveMode($response->getLiveMode());
    $this->setName($response->getName());
    $this->setObject($response->getObject());
    $this->setPaymentMethod($response->getPaymentMethod());
    $this->setResponseCode($response->getResponseCode());
  }

  /**
   * Get the transaction authorisation code.
   *
   * @return mixed
   *   The Authcode.
   */
  public function getAuthCode() {
    return $this->authCode;
  }

  /**
   * Get the Address Verification Service Code.
   *
   * @return mixed
   *   The avsCheck.
   */
  public function getAvsCheck() {
    return $this->avsCheck;
  }

  /**
   * Get the Billing Details object.
   *
   * It contains address details along with an associated phone number (optional).
   *
   * "billingDetails": {
   *   "addressLine1": "333 Cormier Bypass",
   *   "addressLine2": "Rolfson Alley",
   *   "postcode": "ue0 2ou",
   *   "country": "US",
   *   "city": "Schmittchester",
   *   "state": "Jakubowskiton",
   *   "phone": {
   *       "countryCode": "44",
   *       "number": "12345678"
   *     }
   *   }
   *
   * @return mixed
   *   The BillingDetails .
   */
  public function getBillingDetails() {
    return $this->billingDetails;
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
   * Get a CVV code as a response.
   *
   * If a CVV is provided, returns a CVV code as a response.
   * For example, "cvvCheck": "Y", signals that Card Verification
   * was done and the CVD was valid.
   *
   * @return mixed
   *   The cvvCheck.
   */
  public function getCvvCheck() {
    return $this->cvvCheck;
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
   * Get the two-digit number representing the expiry month of the card.
   *
   * @return mixed
   *   The expiryMonth.
   */
  public function getExpiryMonth() {
    return $this->expiryMonth;
  }

  /**
   * Get the two or four-digit number representing the expiry year of the card.
   *
   * @return mixed
   *   The expiryYear.
   */
  public function getExpiryYear() {
    return $this->expiryYear;
  }

  /**
   * Get the string of characters that uniquely identifies a card.
   *
   * If a card is used by multiple customers, the same
   * fingerprint will be generated each time.
   *
   * @return mixed
   *   The fingerprint.
   */
  public function getFingerprint() {
    return $this->fingerprint;
  }

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
  public function getId() {
    return $this->id;
  }

  /**
   * Get the last 4 digits of the card.
   *
   * @return mixed
   *   The last4.
   */
  public function getLast4() {
    return $this->last4;
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
   * Get the customer name.
   *
   * @return mixed
   *   The name.
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
   * Get The payment method (e.g. 'VISA').
   *
   * @return mixed
   *   The paymentMethod.
   */
  public function getPaymentMethod() {
    return $this->paymentMethod;
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
   * Set the transaction authorisation code.
   *
   * @param mixed $authCode
   *   The Authcode.
   */
  private function setAuthCode($authCode) {
    $this->authCode = $authCode;
  }

  /**
   * Set the Address Verification Service Code.
   *
   * @param mixed $avsCheck
   *   The avsCheck.
   */
  private function setAvsCheck($avsCheck) {
    $this->avsCheck = $avsCheck;
  }

  /**
   * Set the Billing Details object.
   *
   * It contains address details along with an associated phone number (optional).
   *
   * "billingDetails": {
   *   "addressLine1": "333 Cormier Bypass",
   *   "addressLine2": "Rolfson Alley",
   *   "postcode": "ue0 2ou",
   *   "country": "US",
   *   "city": "Schmittchester",
   *   "state": "Jakubowskiton",
   *   "phone": {
   *       "countryCode": "44",
   *       "number": "12345678"
   *     }
   *   }
   *
   * @param mixed $billingDetails
   *   The BillingDetails .
   */
  private function setBillingDetails($billingDetails) {

    $billingAddress = new \com\checkout\Apiservices\Sharedmodels\Address();
    $phone = new \com\checkout\Apiservices\Sharedmodels\Phone();

    $billingAddress->setAddressLine1($billingDetails->getAddressLine1());
    $billingAddress->setAddressLine2($billingDetails->getAddressLine2());
    $billingAddress->setPostcode($billingDetails->getPostcode());
    $billingAddress->setCountry($billingDetails->getCountry());
    $billingAddress->setCity($billingDetails->getCity());
    $billingAddress->setState($billingDetails->getState());
    $phone->setNumber($billingDetails->getPhone()->getNumber());
    $billingAddress->setPhone($phone);

    $this->billingDetails = $billingAddress;
  }

  /**
   * Set the customer ID.
   *
   * Note: The customer id is prefixed with cust_.
   *
   * @param mixed $customerId
   *   The CustomerId.
   */
  private function setCustomerId($customerId) {
    $this->customerId = $customerId;
  }

  /**
   * Set a CVV code as a response.
   *
   * If a CVV is provided, returns a CVV code as a response.
   * For example, "cvvCheck": "Y", signals that Card Verification
   * was done and the CVD was valid.
   *
   * @param mixed $cvvCheck
   *   The cvvCheck.
   */
  private function setCvvCheck($cvvCheck) {
    $this->cvvCheck = $cvvCheck;
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
   * Set the two-digit number representing the expiry month of the card.
   *
   * @param mixed $expiryMonth
   *   The expiryMonth.
   */
  private function setExpiryMonth($expiryMonth) {
    $this->expiryMonth = $expiryMonth;
  }

  /**
   * Set the two or four-digit number representing the expiry year of the card.
   *
   * @param mixed $expiryYear
   *   The expiryYear.
   */
  private function setExpiryYear($expiryYear) {
    $this->expiryYear = $expiryYear;
  }

  /**
   * Set the string of characters that uniquely identifies a card.
   *
   * If a card is used by multiple customers, the same
   * fingerprint will be generated each time.
   *
   * @param mixed $fingerprint
   *   The fingerprint.
   */
  private function setFingerprint($fingerprint) {
    $this->fingerprint = $fingerprint;
  }

  /**
   * Set the string that uniquely identifies a card per customer.
   *
   * Each time the same card is used by a different customer,
   * a new cardId will be generated.
   *
   * Note: The card id is prefixed with card_.
   *
   * @param mixed $id
   *   The cardId.
   */
  private function setId($id) {
    $this->id = $id;
  }

  /**
   * Set the last 4 digits of the card.
   *
   * @param mixed $last4
   *   The last4.
   */
  private function setLast4($last4) {
    $this->last4 = $last4;
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
   * Set the customer name.
   *
   * @param mixed $name
   *   The name.
   */
  private function setName($name) {
    $this->name = $name;
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
   * Set The payment method (e.g. 'VISA').
   *
   * @param mixed $paymentMethod
   *   The paymentMethod.
   */
  private function setPaymentMethod($paymentMethod) {
    $this->paymentMethod = $paymentMethod;
  }

  /**
   * Set the response Code indicating the status of the request.
   *
   * @param mixed $responseCode
   *   The responseCode.
   */
  private function setResponseCode($responseCode) {
    $this->responseCode = $responseCode;
  }
}
