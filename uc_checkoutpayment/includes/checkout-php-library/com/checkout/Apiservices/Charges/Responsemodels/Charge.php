<?php

/**
 * Checkout.com Apiservices\Charges\Responsemodels\Charge.
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
 * Class Charge.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Charge extends \com\checkout\Apiservices\Charges\Requestmodels\Basecharge {
  protected $object;
  protected $id;
  protected $liveMode;
  protected $created;
  protected $value;
  protected $currency;
  protected $email;
  protected $chargeMode;
  protected $customerIp;
  protected $description;
  protected $responseMessage;
  protected $responseAdvancedInfo;
  protected $responseCode;
  protected $refundedValue;
  protected $balanceTransaction;
  protected $status;
  protected $authCode;
  protected $autoCapture;
  protected $autoCapTime;
  protected $paid;
  protected $refunded;
  protected $deferred;
  protected $expired;
  protected $captured;
  protected $isCascaded;
  protected $card;
  protected $shippingDetails;
  protected $products;
  protected $refunds;
  protected $localPayment;
  protected $descriptor;
  protected $metadata;
  protected $transactionIndicator;
  protected $originalId;
  protected $redirectUrl;
  protected $paymentToken;
  protected $response = null;
  protected $Customerpaymentplans;
  protected $responseType;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setResponse($response);
    $this->setObject($response->getObject());
    $this->setId($response->getId());
    $this->setLiveMode($response->getLiveMode());
    $this->setCreated($response->getCreated());
    $this->setValue($response->getValue());
    $this->setCurrency($response->getCurrency());
    $this->setChargeMode($response->getChargeMode());
    $this->setEmail($response->getEmail());
    $this->setCustomerIp($response->getCustomerIp());
    $this->setDescription($response->getDescription());
    $this->setResponseMessage($response->getResponseMessage());
    $this->setResponseAdvancedInfo($response->getResponseAdvancedInfo());
    $this->setResponseCode($response->getResponseCode());
    $this->setRefundedValue($response->getRefundedValue());
    $this->setBalanceTransaction($response->getBalanceTransaction());
    $this->setStatus($response->getStatus());
    $this->setAuthCode($response->getAuthCode());
    $this->setAutoCapture($response->getAutoCapture());
    $this->setAutoCapTime($response->getAutoCapTime());
    $this->setPaid($response->getPaid());
    $this->setRefunded($response->getRefunded());
    $this->setDeferred($response->getDeferred());
    $this->setExpired($response->getExpired());
    $this->setCaptured($response->getCaptured());
    $this->setIsCascaded($response->getIsCascaded());
    $this->setDescription($response->getDescription());
    $this->setTrackId($response->getTrackId());
    $this->setUdf1($response->getUdf1());
    $this->setUdf2($response->getUdf2());
    $this->setUdf3($response->getUdf3());
    $this->setUdf4($response->getUdf4());
    $this->setUdf5($response->getUdf5());

    if ($response->getDescriptor()) {
      $this->setDescriptor($response->getDescriptor());
    }

    if ($response->getMetadata()) {
      $this->setMetadata($response->getMetadata()->toArray());
    }

    if ($response->getCard()) {
      $this->setCard($response->getCard());
    }
    if ($response->getShippingDetails()) {
      $this->setShippingDetails($response->getShippingDetails());
    }

    if ($response->getProducts()) {
      $this->setProducts($response->getProducts());
    }
    if ($response->getRefunds()) {
      $this->setRefunds($response->getRefunds());
    }

    $this->setLocalPayment($response->getLocalPayment());

    if ($response->getMetadata()) {
      $this->setMetadata($response->getMetadata());
    }

    if ($response->getTransactionIndicator()) {
      $this->setTransactionIndicator($response->getTransactionIndicator());
    }

    if ($response->getOriginalId()) {
      $this->originalId = $response->getOriginalId();
    }

    if ($response->getCustomerpaymentplans()) {
      $this->setCustomerpaymentplans($response->getCustomerpaymentplans());
    }

    if ($response->getRedirectUrl()) {
      $this->setRedirectUrl($response->getRedirectUrl());
      $this->setPaymenttoken($response->getId());
    }

    $this->setResponseType(
      $response->getChargeMode(), 
      $response->getRedirectUrl()
    );

    $this->json = $response->getRawOutput();

    $this->setResponse($response->getResponse());
  }

  /**
   * Set the response.
   *
   * @param mixed $response
   *   The response.
   */
  public function setResponse($response) {
    $this->response = $response;
  }

  /**
   * Get the response.
   *
   * @return mixed
   *   The response.
   */
  public function getResponse() {
    return $this->response;
  }

  /**
   * Set the original charge id.
   *
   * @return mixed
   *   The original charge id.
   */
  public function getOriginalId() {
    return $this->originalId;
  }

  /**
   * Set the original charge id.
   *
   * @param mixed $setOriginalId
   *   The original charge id.
   */
  public function setOriginalId($setOriginalId) {
    $this->setOriginalId = $setOriginalId;
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
   * Get the UTC date and time based on ISO 8601 profile.
   *
   * @return mixed
   *   The created date.
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * Get the value of the transaction.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @return mixed
   *   The value.
   */
  public function getValue() {
    return $this->value;
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
   * Get the email address of the customer.
   *
   * @return mixed
   *   The email.
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Get the IP address of the Customer.
   *
   * @return mixed
   *   The customerIp.
   */
  public function getCustomerIp() {
    return $this->customerIp;
  }

  /**
   * Get a valid charge mode.
   *
   * Options:
   *   1 for No 3D.
   *   2 for 3D.
   *   3 for Local Payment.
   *
   * @return mixed
   *   The chargeMode.
   */
  public function getChargeMode() {
    return $this->chargeMode;
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
   * Get the responseMessage.
   *
   * Shows 'Approved' or 'Declined' based on response code of the transaction.
   *
   * @return mixed
   *   The responseMessage.
   */
  public function getResponseMessage() {
    return $this->responseMessage;
  }

  /**
   * Get the responseAdvancedInfo.
   *
   * Shows 'Approved' or 'Declined' based on response code of the transaction.
   * If risk action is triggered, the reason appears in this field.
   *
   * @return mixed
   *   The responseAdvancedInfo.
   */
  public function getResponseAdvancedInfo() {
    return $this->responseAdvancedInfo;
  }

  /**
   * Get a response code indicating the status of the request.
   *
   * @return mixed
   *   The responseCode.
   */
  public function getResponseCode() {
    return $this->responseCode;
  }

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
  public function getRefundedValue() {
    return $this->refundedValue;
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
   * Get Status of the charge.
   *
   * The '10000' is equivalent to approved.
   *
   * @return mixed
   *   The status.
   */
  public function getStatus() {
    return $this->status;
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
   * Get the auto capture.
   *
   * Accepted values either 'y' or 'n'. Default is is set to 'y'.
   * Defines if the charge will be authorised ('n') or captured ('y').
   * Authorisations will expire in 7 days.
   *
   * @return mixed
   *   The autoCapture.
   */
  public function getAutoCapture() {
    return $this->autoCapture;
  }

  /**
   * Get the delayed capture time.
   *
   * The delayed capture time (1-168 inclusive) expressed in hours.
   * Interpret decimal values as fractions of an hour.
   *
   * @return mixed
   *   The autoCapTime.
   */
  public function getAutoCapTime() {
    return $this->autoCapTime;
  }

  /**
   * Get the paid value.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @return mixed
   *   The value.
   */
  public function getPaid() {
    return $this->paid;
  }

  /**
   * Get the refunded value.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @return mixed
   *   The value.
   */
  public function getRefunded() {
    return $this->refunded;
  }

  /**
   * Get the deferred value.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @return mixed
   *   The value.
   */
  public function getDeferred() {
    return $this->deferred;
  }

  /**
   * Get the expired value.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @return mixed
   *   The value.
   */
  public function getExpired() {
    return $this->expired;
  }

  /**
   * Get the getCaptured value.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @return mixed
   *   The value.
   */
  public function getCaptured() {
    return $this->captured;
  }

  /**
   * Get the cascaded indicator.
   *
   * Indicates whether the transaction has been cascaded to a different
   * acquiring platform, typically to improve approval ratio.
   *
   * @return mixed
   *   The isCascaded.
   */
  public function getIsCascaded() {
    return $this->isCascaded;
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
   * Get the shipping address information.
   *
   * @return mixed
   *   The shippingDetails.
   */
  public function getShippingDetails() {
    return $this->shippingDetails;
  }

  /**
   * Get the array of Product information.
   *
   * @return mixed
   *   The products.
   */
  public function getProducts() {
    return $this->products;
  }

  /**
   * Get the refunds.
   *
   * @return mixed
   *   The refunds.
   */
  public function getRefunds() {
    return $this->refunds;
  }

  /**
   * Get the local Payments.
   *
   * @return mixed
   *   The localPayment.
   */
  public function getLocalPayment() {
    return $this->localPayment;
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
   * Get the descriptor.
   *
   * @return mixed
   *   The descriptor.
   */
  public function getDescriptor() {
    return $this->descriptor;
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
   * Get the Customerpaymentplans.
   *
   * @return mixed
   *   The Customerpaymentplans.
   */
  public function getCustomerpaymentplans() {
    return $this->Customerpaymentplans;
  }

  /**
   * Get the redirectUrl.
   *
   * @return mixed
   *   The redirectUrl.
   */
  public function getRedirectUrl() {
    return $this->redirectUrl;
  }

  /**
   * Get the paymentToken.
   *
   * Your payment token. This is only required when creating an
   * Alternative Payment Charge with Payment Token.
   *
   * Note: The token is prefixed with pay_tok_.
   *
   * @return mixed
   *   The paymentToken.
   */
  public function getPaymenttoken() {
    return $this->paymentToken;
  }

  /**
   * Get the responseType.
   *
   * @return mixed
   *   The responseType.
   */
  public function getResponseType() {
    return $this->responseType;
  }

  /**
   * Set an object.
   *
   * @param int $object
   *   The object.
   */
  protected function setObject($object) {
    $this->object = $object;
  }

  /**
   * Set the string that uniquely identifies the transaction.
   *
   * Note: The card id is prefixed with charge_.
   *
   * @param mixed $id
   *   The chargeId.
   */
  protected function setId($id) {
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
  protected function setLiveMode($liveMode) {
    $this->liveMode = $liveMode;
  }

  /**
   * Set the UTC date and time based on ISO 8601 profile.
   *
   * @param mixed $created
   *   The created date.
   */
  protected function setCreated($created) {
    $this->created = $created;
  }

  /**
   * Set the value of the transaction.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @param mixed $value
   *   The value.
   */
  protected function setValue($value) {
    $this->value = $value;
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
  protected function setCurrency($currency) {
    $this->currency = $currency;
  }

  /**
   * Set the email address of the customer.
   *
   * @param mixed $email
   *   The email.
   */
  protected function setEmail($email) {
    $this->email = $email;
  }

  /**
   * Set the IP address of the Customer.
   *
   * @param mixed $customerIp
   *   The customerIp.
   */
  protected function setCustomerIp($customerIp) {
    $this->customerIp = $customerIp;
  }

  /**
   * Set a valid charge mode.
   *
   * Options:
   *   1 for No 3D.
   *   2 for 3D.
   *   3 for Local Payment.
   *
   * @param mixed $chargeMode
   *   The chargeMode.
   */
  protected function setChargeMode($chargeMode) {
    $this->chargeMode = $chargeMode;
  }

  /**
   * Set a description that can be added to this object.
   *
   * @param mixed $description
   *   The description.
   */
  protected function setDescription($description) {
    $this->description = $description;
  }

  /**
   * Set the responseMessage.
   *
   * Shows 'Approved' or 'Declined' based on response code of the transaction.
   *
   * @param mixed $responseMessage
   *   The responseMessage.
   */
  protected function setResponseMessage($responseMessage) {
    $this->responseMessage = $responseMessage;
  }

  /**
   * Set the responseAdvancedInfo.
   *
   * Shows 'Approved' or 'Declined' based on response code of the transaction.
   * If risk action is triggered, the reason appears in this field.
   *
   * @param mixed $responseAdvancedInfo
   *   The responseAdvancedInfo.
   */
  protected function setResponseAdvancedInfo($responseAdvancedInfo) {
    $this->responseAdvancedInfo = $responseAdvancedInfo;
  }

  /**
   * Set a response code indicating the status of the request.
   *
   * @param mixed $responseCode
   *   The responseCode.
   */
  protected function setResponseCode($responseCode) {
    $this->responseCode = $responseCode;
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
  protected function setRefundedValue($refundedValue) {
    $this->refundedValue = $refundedValue;
  }

  /**
   * Set the balance of the transaction.
   *
   * @param mixed $balanceTransaction
   *   The balanceTransaction.
   */
  protected function setBalanceTransaction($balanceTransaction) {
    $this->balanceTransaction = $balanceTransaction;
  }

  /**
   * Set Status of the charge.
   *
   * The '10000' is equivalent to approved.
   *
   * @param mixed $status
   *   The status.
   */
  protected function setStatus($status) {
    $this->status = $status;
  }

  /**
   * Set the transaction authorisation code.
   *
   * @param mixed $authCode
   *   The Authcode.
   */
  protected function setAuthCode($authCode) {
    $this->authCode = $authCode;
  }

  /**
   * Set the auto capture.
   *
   * Accepted values either 'y' or 'n'. Default is is set to 'y'.
   * Defines if the charge will be authorised ('n') or captured ('y').
   * Authorisations will expire in 7 days.
   *
   * @param mixed $autoCapture
   *   The autoCapture.
   */
  protected function setAutoCapture($autoCapture) {
    $this->autoCapture = $autoCapture;
  }

  /**
   * Set the delayed capture time.
   *
   * The delayed capture time (1-168 inclusive) expressed in hours.
   * Interpret decimal values as fractions of an hour.
   *
   * @param mixed $autoCapTime
   *   The autoCapTime.
   */
  protected function setAutoCapTime($autoCapTime) {
    $this->autoCapTime = $autoCapTime;
  }

  /**
   * Set the paid value.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @param mixed $paid
   *   The value.
   */
  protected function setPaid($paid) {
    $this->paid = $paid;
  }

  /**
   * Set the refunded value.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @param mixed $refunded
   *   The value.
   */
  protected function setRefunded($refunded) {
    $this->refunded = $refunded;
  }

  /**
   * Set the deferred value.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @param mixed $deferred
   *   The value.
   */
  protected function setDeferred($deferred) {
    $this->deferred = $deferred;
  }

  /**
   * Set the expired value.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @param mixed $expired
   *   The value.
   */
  protected function setExpired($expired) {
    $this->expired = $expired;
  }

  /**
   * Set the getCaptured value.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @param mixed $captured
   *   The value.
   */
  protected function setCaptured($captured) {
    $this->captured = $captured;
  }

  /**
   * Set the cascaded indicator.
   *
   * Indicates whether the transaction has been cascaded to a different
   * acquiring platform, typically to improve approval ratio.
   *
   * @param mixed $isCascaded
   *   The isCascaded.
   */
  protected function setIsCascaded($isCascaded) {
    $this->isCascaded = $isCascaded;
  }

  /**
   * Set a card.
   *
   * @param mixed $card
   *   The card.
   */
  protected function setCard($card) {
    $cardObg = new \com\checkout\Apiservices\Cards\Responsemodels\Card($card);
    $this->card = $cardObg;
  }

  /**
   * Set the shipping address information.
   *
   * @param mixed $shippingDetails
   *   The shippingDetails.
   */
  protected function setShippingDetails($shippingDetails) {
    $shippingAddress = new \com\checkout\Apiservices\Sharedmodels\ShippingAddress();
    $phone = new \com\checkout\Apiservices\Sharedmodels\Phone();
    $shippingAddress->setAddressLine1($shippingDetails->getAddressLine1());
    $shippingAddress->setAddressLine2($shippingDetails->getAddressLine2());
    $shippingAddress->setPostcode($shippingDetails->getPostcode());
    $shippingAddress->setCountry($shippingDetails->getCountry());
    $shippingAddress->setCity($shippingDetails->getCity());
    $shippingAddress->setState($shippingDetails->getState());
    $phone->setNumber($shippingDetails->getPhone()->getNumber());
    $shippingAddress->setPhone($phone);
    $shippingAddress->setRecipientName($shippingDetails->getRecipientName());
    $this->shippingDetails = $shippingAddress;
  }

  /**
   * Set the array of Product information.
   *
   * @param mixed $products
   *   The products.
   */
  protected function setProducts($products) {
    $productsArray = $products->toArray();
    $productsToReturn = array();
    if ($productsArray) {
      foreach ($productsArray as $item) {
        $product = new \com\checkout\Apiservices\Sharedmodels\Product();
        $product->setName($item['name']);
        $product->setDescription($item['description']);
        $product->setSku($item['sku']);
        $product->setPrice($item['price']);
        $product->setQuantity($item['quantity']);
        $product->setImage($item['image']);
        $product->setShippingCost($item['shippingCost']);
        $product->setTrackingUrl($item['trackingUrl']);
        $productsToReturn[] = $product;
      }
    }
    $this->products = $productsToReturn;
  }

  /**
   * Set the refunds.
   *
   * @param mixed $refunds
   *   The refunds.
   */
  protected function setRefunds($refunds) {

    $refundObj = new \com\checkout\Apiservices\Charges\Responsemodels\Refund();
    $refundObj->setAmount($refunds->getAmount());
    $refundObj->setCurrency($refunds->getCurrency());
    $refundObj->setCreated($refunds->getCreated());
    $refundObj->setObject($refunds->getObject());
    $refundObj->setBalanceTransaction($refunds->getBalanceTransaction());
    $this->refunds = $refundObj;
  }

  /**
   * Set the local Payments.
   *
   * @param mixed $localPayment
   *   The localPayment.
   */
  protected function setLocalPayment($localPayment) {
    $this->localPayment = $localPayment;
  }

  /**
   * Set the descriptor.
   *
   * @param mixed $descriptor
   *   The descriptor.
   */
  protected function setDescriptor($descriptor) {
    $descriptorObj = new \com\checkout\Apiservices\Sharedmodels\Descriptor();
    $descriptorObj->setName($descriptor->getName());
    $descriptorObj->setCity($descriptor->getCity());
    $this->descriptor = $descriptorObj;
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
  protected function setMetadata($metadata) {
    $this->metadata = $metadata->toArray();
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
  protected function setTransactionIndicator($transactionIndicator) {
    $this->transactionIndicator = $transactionIndicator;
  }

  /**
   * Set the Customerpaymentplans.
   *
   * @param mixed $Customerpaymentplans
   *   The Customerpaymentplans.
   */
  protected function setCustomerpaymentplans($Customerpaymentplans) {
    $paymentPlansArray = $Customerpaymentplans->toArray();
    $paymentPlansToReturn = array();
    if ($paymentPlansArray) {
      foreach ($paymentPlansArray as $item) {
        $paymentPlan = new \com\checkout\Apiservices\Sharedmodels\Customerpaymentplan();
        $paymentPlan->setPlanId($item['planId']);
        $paymentPlan->setName($item['name']);
        $paymentPlan->setPlanTrackId($item['planTrackId']);
        $paymentPlan->setAutoCapTime($item['autoCapTime']);
        $paymentPlan->setCurrency($item['currency']);
        $paymentPlan->setValue($item['value']);
        $paymentPlan->setCycle($item['cycle']);
        $paymentPlan->setRecurringCount($item['recurringCount']);
        $paymentPlan->setStatus($item['status']);
        $paymentPlan->setCustomerPlanId($item['customerPlanId']);
        $paymentPlan->setRecurringCountLeft($item['recurringCountLeft']);
        $paymentPlan->setTotalCollectedValue($item['totalCollectedValue']);
        $paymentPlan->setTotalCollectedCount($item['totalCollectedCount']);
        $paymentPlan->setStartDate($item['startDate']);
        $paymentPlan->setPreviousRecurringDate($item['previousRecurringDate']);
        $paymentPlan->setNextRecurringDate($item['nextRecurringDate']);
        $paymentPlansToReturn[] = $paymentPlan;
      }
    }

    $this->Customerpaymentplans = $paymentPlansToReturn;
  }

  /**
   * Set the redirectUrl.
   *
   * @param mixed $redirectUrl
   *   The redirectUrl.
   */
  protected function setRedirectUrl($redirectUrl) {
    $this->redirectUrl = $redirectUrl;
  }

  /**
   * Set the paymentToken.
   *
   * Your payment token. This is only required when creating an
   * Alternative Payment Charge with Payment Token.
   *
   * Note: The token is prefixed with pay_tok_.
   *
   * @param mixed $paymentToken
   *   The paymentToken.
   */
  protected function setPaymenttoken($paymentToken) {
    $this->paymentToken = $paymentToken;
  }

  /**
   * Set the responseType.
   *
   * @param mixed $redirectUrl
   *   The chargeMode.
   * @param mixed $chargeMode
   *   The chargeMode.
   */
  private function setResponseType($chargeMode, $redirectUrl) {
    if ($redirectUrl && $chargeMode == 2) {
      $this->responseType = "3dCharge";
    }
    elseif ($redirectUrl && $chargeMode == 1) {
      $this->responseType = "attemptN3dCharge";
    }
    else {
      $this->responseType = "normal";
    }
  }
}
