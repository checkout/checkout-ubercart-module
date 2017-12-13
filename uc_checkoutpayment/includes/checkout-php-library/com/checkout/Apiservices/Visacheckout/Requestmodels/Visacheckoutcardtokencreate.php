<?php

/**
 * Checkout.com Apiservices\Visacheckout\Requestmodels\Visacheckoutcardtokencreate.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Visacheckout\Requestmodels;

/**
 * Class Visa Checkout Card Token Create.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Visacheckoutcardtokencreate {
  private $callId = null;
  private $includeBindata = null;

  /**
   * Set the call id.
   *
   * @param mixed $callId
   *   The callId.
   */
  public function setCallId($callId) {
    $this->callId = $callId;
  }

  /**
   * Get the call id.
   *
   * @return mixed
   *   The callId.
   */
  public function getCallId() {
    return $this->callId;
  }

  /**
   * Set the include bin data.
   *
   * @param mixed $includeBindata
   *   The includeBindata.
   */
  public function setIncludeBindata($includeBindata) {
    $this->includeBindata = $includeBindata;
  }

  /**
   * Get the include bin data.
   *
   * @return mixed
   *   The includeBindata.
   */
  public function getIncludeBindata() {
    return $this->includeBindata;
  }
}
