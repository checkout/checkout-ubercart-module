<?php

/**
 * Checkout.com Apiservices\Sharedmodels\Address.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Sharedmodels;

/**
 * Class Address.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Address {
  protected $addressLine1;
  protected $addressLine2;
  protected $postcode;
  protected $country;
  protected $city;
  protected $state;
  protected $phone;

  /**
   * Get the containing the first line of the customer's address.
   *
   * @return mixed
   *   The addressLine1.
   */
  public function getAddressLine1() {
    return $this->addressLine1;
  }

  /**
   * Set the containing the first line of the customer's address.
   *
   * @param mixed $addressLine1
   *   The addressLine1.
   */
  public function setAddressLine1($addressLine1) {
    $this->addressLine1 = $addressLine1;
  }

  /**
   * Get the containing the second line of the customer's address.
   *
   * @return mixed
   *   The addressLine2.
   */
  public function getAddressLine2() {
    return $this->addressLine2;
  }

  /**
   * Set the containing the second line of the customer's address.
   *
   * @param mixed $addressLine2
   *   The addressLine2.
   */
  public function setAddressLine2($addressLine2) {
    $this->addressLine2 = $addressLine2;
  }

  /**
   * Get the containing the postal code of the customer's address.
   *
   * @return mixed
   *   The postcode.
   */
  public function getPostcode() {
    return $this->postcode;
  }

  /**
   * Set the containing the postal code of the customer's address.
   *
   * @param mixed $postcode
   *   The postcode.
   */
  public function setPostcode($postcode) {
    $this->postcode = $postcode;
  }

  /**
   * Get the containing the country of the customer's address.
   *
   * @return mixed
   *   The country.
   */
  public function getCountry() {
    return $this->country;
  }

  /**
   * Set the containing the country of the customer's address.
   *
   * @param mixed $country
   *   The country.
   */
  public function setCountry($country) {
    $this->country = $country;
  }

  /**
   * Get the containing the city of the customer's address.
   *
   * @return mixed
   *   The city.
   */
  public function getCity() {
    return $this->city;
  }

  /**
   * Set the containing the city of the customer's address.
   *
   * @param mixed $city
   *   The city.
   */
  public function setCity($city) {
    $this->city = $city;
  }

  /**
   * Get the containing the state of the customer's address.
   *
   * @return mixed
   *   The state.
   */
  public function getState() {
    return $this->state;
  }

  /**
   * Set the containing the state of the customer's address.
   *
   * @param mixed $state
   *   The state.
   */
  public function setState($state) {
    $this->state = $state;
  }

  /**
   * Get the containing the country code of the customer.
   *
   * @return mixed
   *   The phone.
   */
  public function getPhone() {
    return $this->phone;
  }

  /**
   * Set the containing the country code of the customer.
   *
   * @param Phone $phone
   *   The phone.
   */
  public function setPhone(Phone $phone) {
    $this->phone = $phone;
  }
}
