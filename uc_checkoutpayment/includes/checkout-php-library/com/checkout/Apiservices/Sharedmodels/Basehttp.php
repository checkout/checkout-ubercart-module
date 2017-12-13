<?php

/**
 * Checkout.com Apiservices\Sharedmodels\Basehttp.
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
 * Class Base Http.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Basehttp {
  protected $httpStatus;
  protected $hasError;

  /**
   * Class constructor.
   *
   * @param mixed $requestModel
   *   The request model.
   */
  public function __construct($response = null) {
    if ($response) {
      $this->setHttpStatus($response->getHttpStatus());
      $this->setHasError($response->hasError() ? true : false);
    }
  }

  /**
   * Get the http status.
   *
   * @return mixed
   *   The http status.
   */
  public function getHttpStatus() {
    return $this->httpStatus;
  }

  /**
   * Check if the http request has returned an error.
   *
   * @return mixed
   *   The http error.
   */
  public function hasError() {
    return $this->hasError;
  }

  /**
   * Get a http status.
   *
   * @param mixed $httpStatus
   *   The http status.
   */
  private function setHttpStatus($httpStatus) {
    $this->httpStatus = $httpStatus;
  }

  /**
   * Set a http error.
   *
   * @param mixed $hasError
   *   The http error.
   */
  private function setHasError($hasError) {
    $this->hasError = $hasError;
  }
}
