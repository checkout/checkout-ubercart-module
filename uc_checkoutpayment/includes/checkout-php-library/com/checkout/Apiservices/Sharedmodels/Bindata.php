<?php

/**
 * Checkout.com Apiservices\Sharedmodels\Bindata.
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
 * Class Bin Data.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Bindata extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  protected $object;
  protected $bin;
  protected $issuerCountryISO2;
  protected $cardType;

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
   * Get the first 4-6 digits of cardNumber.
   *
   * The exact number of digits required in the
   * request is dependent on the card association.
   *
   * @return mixed
   *   The bin.
   */
  public function getBin() {
    return $this->bin;
  }

  /**
   * Get a ISO2 country code.
   *
   * @return mixed
   *   The issuerCountryISO2.
   */
  public function getIssuerCountryISO2() {
    return $this->issuerCountryISO2;
  }

  /**
   * Get a card type.
   *
   * Either debit or credit.
   *
   * @return mixed
   *   The cardType.
   */
  public function getCardType() {
    return $this->cardType;
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

  /**
   * Set the first 4-6 digits of cardNumber.
   *
   * The exact number of digits required in the
   * request is dependent on the card association.
   *
   * @param mixed $bin
   *   The bin.
   */
  public function setBin($bin) {
    $this->bin = $bin;
  }

  /**
   * Set a ISO2 country code.
   *
   * @param mixed $issuerCountryISO2
   *   The issuerCountryISO2.
   */
  public function setIssuerCountryISO2($issuerCountryISO2) {
    $this->issuerCountryISO2 = $issuerCountryISO2;
  }

  /**
   * Set a card type.
   *
   * Either debit or credit.
   *
   * @param mixed $cardType
   *   The cardType.
   */
  public function setCardType($cardType) {
    $this->cardType = $cardType;
  }

}
