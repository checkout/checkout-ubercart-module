<?php

/**
 * Checkout.com Helpers\ApiHttpClientCustomException.
 *
 * PHP Version 5.6
 *
 * @category Helpers
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Helpers;

/**
 * Final class Api Http Client Custom Exception.
 *
 * @category Helpers
 * @version Release: @package_version@
 */
final class Apihttpclientcustomexception extends \Exception {
  private $errorMessage = '';
  private $errorCode = '';
  private $eventId = '';

  /**
   * Class constructor.
   *
   * @param mixed $requestModel
   *   The request model.
   */
  public function __construct($errorMessage, $errorCode, $eventId) {

    $this->errorMessage = $errorMessage;
    $this->errorCode = $errorCode;
    $this->eventId = $eventId;
  }

  /**
   * Get the error message.
   *
   * @return mixed
   *   The errorMessage.
   */
  public function getErrorMessage() {
    return $this->errorMessage;
  }

  /**
   * Get the error code.
   *
   * @return mixed
   *   The errorCode.
   */
  public function getErrorCode() {
    return $this->errorCode;
  }

  /**
   * Get the event id.
   *
   * @return mixed
   *   The eventId.
   */
  public function getEventId() {
    return $this->eventId;
  }

}
