<?php

/**
 * Checkout.com Apiservices\Charges\Responsemodels\Paymenttoken
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
 * Class Payment Token.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Paymenttoken extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  private $id;
  private $liveMode;
  private $responseCode;
  private $chargeMode;
  private $response = null;
  private $redirectUrl;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setChargeMode($response->getChargeMode());
    $this->setId($response->getId());
    $this->setLiveMode($response->getLiveMode());
    $this->setResponseCode($response->getResponseCode());
    $this->setRedirectUrl($response->getRedirecturl());
    $this->setResponse($response);
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
   * Set the response.
   *
   * @param mixed $response
   *   The response.
   */
  private function setResponse($response) {
    $this->response = $response;
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
  private function setChargeMode($chargeMode) {
    $this->chargeMode = $chargeMode;
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
   * Set the string that uniquely identifies the transaction.
   *
   * Note: The card id is prefixed with charge_.
   *
   * @param mixed $id
   *   The chargeId.
   */
  private function setId($id) {
    $this->id = $id;
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
   * Get the redirectUrl.
   *
   * @return mixed
   *   The redirectUrl.
   */
  public function getRedirectUrl() {
    return $this->redirectUrl;
  }

  /**
   * Set the redirectUrl.
   *
   * @param mixed $redirectUrl
   *   The redirectUrl.
   */
  private function setRedirectUrl($redirectUrl) {
    $this->redirectUrl = $redirectUrl;
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
   * Set a response code indicating the status of the request.
   *
   * @param mixed $responseCode
   *   The responseCode.
   */
  private function setResponseCode($responseCode) {
    $this->responseCode = $responseCode;
  }

}
