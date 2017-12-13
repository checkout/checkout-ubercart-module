<?php

/**
 * Checkout.com Apiservices\Tokens\Responsemodels\Paymenttoken.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Tokens\Responsemodels;

/**
 * Class Payment Token.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Paymenttoken {
  private $id;
  private $liveMode;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    $this->setId($response->getId());
    $this->setLiveMode($response->getLiveMode());
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

}
