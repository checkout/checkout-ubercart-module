<?php

/**
 * Checkout.com Apiservices\Charges\Responsemodels\Chargehistory.
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
 * Class Charge History.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Chargehistory extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  protected $object;
  protected $id;
  protected $charges;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    parent::__construct($response);

    $this->setObject($response->getObject());

    if ($response->getCharges()) {
      $this->setCharges($response->getCharges());
    }
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
   * Get charges.
   *
   * @return mixed
   *   The charges.
   */
  public function getCharges() {
    return $this->charges;
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
   * Set charges.
   *
   * @param mixed $charges
   *   The charges.
   */
  protected function setCharges($charges) {
    $chargesArray = $charges->toArray();
    $chargesToReturn = array();
    if ($chargesArray) {
      foreach ($chargesArray as $item) {
        $charge = new \com\checkout\Apiservices\Sharedmodels\Charge();
        $charge->setId($item['id']);
        $charge->setChargeMode($item['chargeMode']);
        $charge->setCreated($item['created']);
        $charge->setEmail($item['email']);
        $charge->setLiveMode($item['liveMode']);
        $charge->setStatus($item['status']);
        $charge->setTrackId($item['trackId']);
        $charge->setValue($item['value']);
        $charge->setStatus($item['status']);
        $charge->setResponseCode($item['responseCode']);
        $chargesToReturn[] = $charge;
      }
    }

    $this->charges = $chargesToReturn;
  }

  /**
   * Set a response code indicating the status of the request.
   *
   * @param mixed $responseCode
   *   The responseCode.
   */
  private function setResponseCode($responseCode) {
    $this->responseCode = $responseCode;
  }

}
