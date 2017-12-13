<?php

/**
 * Checkout.com Apiservices\Paymentproviders\Responsemodels\Customfields.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Paymentproviders\Responsemodels;

/**
 * Class Custom Fields.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Customfields extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  protected $key;
  protected $dataType;
  protected $label;
  protected $required;
  protected $order;
  protected $minLength;
  protected $maxLength;
  protected $isActive;
  protected $errorCodes;
  protected $lookupValues;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setDataType($response->getDataType());
    $this->setErrorCodes($response->getErrorCodes());
    $this->sethisActive($response->gethisActive());
    $this->setKey($response->getKey());
    $this->setLabel($response->getLabel());
    $this->setLookupValues($response->getLookupValues());
    $this->setMaxLength($response->getMaxLength());
    $this->setMinLength($response->getMinLength());
    $this->setOrder($response->getOrder());
    $this->setRequired($response->getRequired());

  }

  /**
   * Set the dataType of the field.
   *
   * @param mixed $dataType
   *   The dataType.
   */
  protected function setDataType($dataType) {
    $this->dataType = $dataType;
  }

  /**
   * Set the error codes.
   *
   * @param mixed $errorCodes
   *   The errorCodes.
   */
  protected function setErrorCodes($errorCodes) {
    $this->errorCodes = $errorCodes->toArray();
  }

  /**
   * Check if the field is active.
   *
   * @param mixed $isActive
   *   The isActive.
   */
  protected function setIsActive($isActive) {
    $this->isActive = $isActive;
  }

  /**
   * Set the key.
   *
   * @param mixed $key
   *   The key.
   */
  protected function setKey($key) {
    $this->key = $key;
  }

  /**
   * Set the label.
   *
   * @param mixed $label
   *   The label.
   */
  protected function setLabel($label) {
    $this->label = $label;
  }

  /**
   * Set the lookup values.
   *
   * @param mixed $lookupValues
   *   The lookupValues.
   */
  protected function setLookupValues($lookupValues) {
    $this->lookupValues = $lookupValues->toArray();
  }

  /**
   * Set the max length.
   *
   * @param mixed $maxLength
   *   The maxLength.
   */
  protected function setMaxLength($maxLength) {
    $this->maxLength = $maxLength;
  }

  /**
   * Set the min length.
   *
   * @param mixed $minLength
   *   The minLength.
   */
  protected function setMinLength($minLength) {
    $this->minLength = $minLength;
  }

  /**
   * Set the order.
   *
   * @param mixed $order
   *   The order.
   */
  protected function setOrder($order) {
    $this->order = $order;
  }

  /**
   * Set if the field is required.
   *
   * @param mixed $required
   *   The required.
   */
  protected function setRequired($required) {
    $this->required = $required;
  }

  /**
   * Get the dataType of the field.
   *
   * @return mixed
   *   The dataType.
   */
  public function getDataType() {
    return $this->dataType;
  }

  /**
   * Get the error codes.
   *
   * @return mixed
   *   The errorCodes.
   */
  public function getErrorCodes() {
    return $this->errorCodes;
  }

  /**
   * Get the check of field is active.
   *
   * @return mixed
   *   The isActive.
   */
  public function getIsActive() {
    return $this->isActive;
  }

  /**
   * Get the key.
   *
   * @return mixed
   *   The key.
   */
  public function getKey() {
    return $this->key;
  }

  /**
   * Get the label.
   *
   * @return mixed
   *   The label.
   */
  public function getLabel() {
    return $this->label;
  }

  /**
   * Get the lookup values.
   *
   * @return mixed

   *   The lookupValues.
   */
  public function getLookupValues() {
    return $this->lookupValues;
  }

  /**
   * Get the max length.
   *
   * @return mixed
   *   The maxLength.
   */
  public function getMaxLength() {
    return $this->maxLength;
  }

  /**
   * Get the min length.
   *
   * @return mixed
   *   The minLength.
   */
  public function getMinLength() {
    return $this->minLength;
  }

  /**
   * Get the order.
   *
   * @return mixed
   *   The order.
   */
  public function getOrder() {
    return $this->order;
  }

  /**
   * Get if the field is required.
   *
   * @return mixed
   *   The required.
   */
  public function getRequired() {
    return $this->required;
  }

}
