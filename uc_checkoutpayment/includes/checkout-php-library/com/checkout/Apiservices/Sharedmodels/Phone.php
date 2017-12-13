<?php

/**
 * Checkout.com Apiservices\Sharedmodels\Phone.
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
 * Class Phone.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Phone {
  protected $number;
  protected $countryCode;

  /**
   * Get a valid country code for the phone number.
   *
   * Note: If countryCode is included, number cannot be NULL.
   *
   * @return mixed
   *   The countryCode.
   */
  public function getCountryCode() {
    return $this->countryCode;
  }

  /**
   * Get a phone number.
   *
   * Permitted characters include: numbers, +, (,) ,/ and ' '.
   * Must be between 6 and 25 characters.
   *
   * Note: If countryCode is included, number cannot be NULL.
   *
   * Example: "phone": {"countryCode": "44", "number": "12345678"}
   *
   * @return mixed
   *   The number.
   */
  public function getNumber() {
    return $this->number;
  }

  /**
   * Set a valid country code for the phone number.
   *
   * Note: If countryCode is included, number cannot be NULL.
   *
   * @param mixed $countryCode
   *   The countryCode.
   */
  public function setCountryCode($countryCode) {
    $this->countryCode = $countryCode;
  }

  /**
   * Set a phone number.
   *
   * Permitted characters include: numbers, +, (,) ,/ and ' '.
   * Must be between 6 and 25 characters.
   *
   * Note: If countryCode is included, number cannot be NULL.
   *
   * Example: "phone": {"countryCode": "44", "number": "12345678"}
   *
   * @param mixed $number
   *   The number.
   */
  public function setNumber($number) {
    $this->number = $number;
  }

  /**
   * Get the array with phone details.
   *
   * @return array
   *   The array with the phone details.
   */
  public function getPhoneDetails() {
    return array(
      'number' => $this->number,
      'countryCode' => $this->countryCode,
    );
  }
}
