<?php

/**
 * Checkout Apiservices\Paymentproviders\Requestmodels\Localpaymentprovidermodel.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Paymentproviders\Requestmodels;

/**
 * Class Local Payment Provider Model.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Localpaymentprovidermodel {
  private $providerId;
  private $paymentToken;
  private $ip;
  private $countryCode;
  private $limit;
  private $name;
  private $region;

  /**
   * Get the countryCode.
   *
   * @return mixed
   *   The countryCode.
   */
  public function getCountryCode() {
    return $this->countryCode;
  }

  /**
   * Set the country code.
   *
   * @param mixed $countryCode
   *   The countryCode.
   */
  public function setCountryCode($countryCode) {
    $this->countryCode = $countryCode;
  }

  /**
   * Get the ip.
   *
   * @return mixed
   *   The ip.
   */
  public function getIp() {
    return $this->ip;
  }

  /**
   * Set the ip.
   *
   * @param mixed $ip
   *   The ip.
   */
  public function setIp($ip) {
    $this->ip = $ip;
  }

  /**
   * Get the limit.
   *
   * @return mixed
   *   The limit.
   */
  public function getLimit() {
    return $this->limit;
  }

  /**
   * Set the limit.
   *
   * @param mixed $limit
   *   The limit.
   */
  public function setLimit($limit) {
    $this->limit = $limit;
  }

  /**
   * Get the name.
   *
   * @return mixed
   *   The name.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set the name.
   *
   * @param mixed $name
   *   The name.
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Get the paymentToken.
   *
   * @return mixed
   *   The paymentToken.
   */
  public function getPaymenttoken() {
    return $this->paymentToken;
  }

  /**
   * Set the payment token.
   *
   * @param mixed $paymentToken
   *   The paymentToken.
   */
  public function setPaymenttoken($paymentToken) {
    $this->paymentToken = $paymentToken;
  }

  /**
   * Get the provider id.
   *
   * @return mixed
   *   The providerId.
   */
  public function getProviderId() {
    return $this->providerId;
  }

  /**
   * Set the provider id.
   *
   * @param mixed $providerId
   *   The providerId.
   */
  public function setProviderId($providerId) {
    $this->providerId = $providerId;
  }

  /**
   * Get the region.
   *
   * @return mixed
   *   The region.
   */
  public function getRegion() {
    return $this->region;
  }

  /**
   * Set the region.
   *
   * @param mixed $region
   *   The region.
   */
  public function setRegion($region) {
    $this->region = $region;
  }

}
