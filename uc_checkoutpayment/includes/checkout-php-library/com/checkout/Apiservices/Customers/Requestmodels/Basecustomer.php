<?php

/**
 * Checkout.com Apiservices\Customers\Responsemodels\Basecustomer.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Customers\Requestmodels;

/**
 * Class Base Customer.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Basecustomer {
  protected $name;
  protected $customerName;
  protected $email;
  protected $phoneNumber;
  protected $description;
  protected $metadata = array();

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
   * Set a description that can be added to this object.
   *
   * @param mixed $description
   *   The description.
   */
  public function setDescription($description) {
    $this->description = $description;
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
   * Set the email address of the customer.
   *
   * @param mixed $email
   *   The email.
   */
  public function setEmail($email) {
    $this->email = $email;
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
   * Set a hash of FieldName and value pairs.
   *
   * A hash of FieldName and value pairs e.g. {'keys1': 'Value1'}.
   * Max length of key(s) and value(s) is 100 each. A max. of 10 KVP are allowed.
   *
   * @param mixed $metadata
   *   The metadata.
   */
  public function setMetadata($metadata) {
    if (!empty($metadata) && is_array($metadata)) {
      $this->metadata = array_merge_recursive($this->metadata, $metadata);
    }
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
   * Set the customer name.
   *
   * @param mixed $name
   *   The customerName.
   */
  public function setName($name) {
    $this->name = $name;
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
   * Set the customer name.
   *
   * @param mixed $customerName
   *   The customerName.
   */
  public function setCustomerName($customerName) {
    $this->customerName = $customerName;
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
   * Set the phone number object of the customer/cardholder.
   *
   * It contains:
   *   countryCode: Valid country code for the phone number
   *   number: Phone number.
   *
   * @return mixed $phoneNumber
   *   The phoneNumber.
   */
  public function setPhoneNumber(
    \com\checkout\Apiservices\Sharedmodels\Phone $phoneNumber
  ) {
    $this->phoneNumber = $phoneNumber;
  }

}
