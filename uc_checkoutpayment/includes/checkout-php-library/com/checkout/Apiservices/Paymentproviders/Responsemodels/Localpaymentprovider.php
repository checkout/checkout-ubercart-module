<?php

/**
 * Checkout.com Apiservices\Paymentproviders\Responsemodels\Localpaymentprovider.
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
 * Class Local Payment Provider.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Localpaymentprovider extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  protected $id;
  protected $type;
  protected $name;
  protected $iframe;
  protected $regions;
  protected $countryCodes;
  protected $dimensions;
  protected $customerFields;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setCountryCodes($response->getCountryCodes());
    $this->setCustomerFields($response->getCustomerFields());
    $this->setDimensions($response->getDimensions());
    $this->setId($response->getId());
    $this->setIframe($response->getIframe());
    $this->setName($response->getName());
    $this->setRegions($response->getRegions());
    $this->setType($response->getType());

  }

  /**
   * Set the containing the country of the customer's address.
   *
   * @param mixed $CountryCodes
   *   The CountryCodes.
   */
  protected function setCountryCodes($CountryCodes) {
    $this->countryCodes = $CountryCodes->toArray();
  }

  /**
   * Set the customer fields.
   *
   * @param Responsemodels|Customfields $customerFields
   *   The customerFields.
   */
  protected function setCustomerFields($customerFields) {
    $dataArray = $customerFields->toArray();
    foreach ($dataArray as $customerField) {
      $dummyObjCart = new \Checkoutapi_LibrespondObj();
      $dummyObjCart->setConfig($customerField);
      $customerFieldObj = new \PHPPlugin\Apiservices\Paymentproviders\Responsemodels\Customfields(
        $dummyObjCart
      );
      $this->customerFields[] = $this->getProvider($customerFieldObj);
    }

  }

  /**
   * Set the dimensions.
   *
   * @param mixed $dimensions
   *   The dimensions.
   */
  protected function setDimensions($dimensions) {
    $this->dimensions = $dimensions->toArray();
  }

  /**
   * Set the id.
   *
   * @param mixed $id
   *   The id.
   */
  protected function setId($id) {
    $this->id = $id;
  }

  /**
   * Set the iframe.
   *
   * @param mixed $iframe
   *   The iframe.
   */
  protected function setIframe($iframe) {
    $this->iframe = $iframe;
  }

  /**
   * Set the name.
   *
   * @param mixed $name
   *   The name.
   */
  protected function setName($name) {
    $this->name = $name;
  }

  /**
   * Set the regions.
   *
   * @param mixed $regions
   *   The regions.
   */
  protected function setRegions($regions) {

    $dataArray = $regions->toArray();
    foreach ($dataArray as $region) {
      $dummyObjCart = new \Checkoutapi_LibrespondObj();
      $dummyObjCart->setConfig($region);
      $regionsObj = new \PHPPlugin\Apiservices\Paymentproviders\Responsemodels\Region(
        $dummyObjCart
      );
      $this->regions[] = $this->getProvider($regionsObj);
    }

  }

  /**
   * Set the type.
   *
   * @param mixed $type
   *   The type.
   */
  protected function setType($type) {
    $this->type = $type;
  }

  /**
   * Get the containing the country of the customer's address.
   *
   * @return mixed
   *   The CountryCodes.
   */
  public function getCountryCodes() {
    return $this->countryCodes;
  }

  /**
   * Get the customer fields.
   *
   * @return mixed
   *   The customerFields.
   */
  public function getCustomerFields() {
    return $this->customerFields;
  }

  /**
   * Get the dimensions.
   *
   * @return mixed
   *   The dimensions.
   */
  public function getDimensions() {
    return $this->dimensions;
  }

  /**
   * Get the id.
   *
   * @return mixed
   *   The id.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get the iframe.
   *
   * @return mixed
   *   The iframe.
   */
  public function getIframe() {
    return $this->iframe;
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
   * Get the regions.
   *
   * @return mixed
   *   The regions.
   */
  public function getRegions() {
    return $this->regions;
  }

  /**
   * Get the type.
   *
   * @return mixed
   *   The type.
   */
  public function getType() {
    return $this->type;
  }

}
