<?php

/**
 * Checkout.com Apiservices\Visacheckout\Visacheckoutmapper.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Visacheckout;

/**
 * Class Visa Checkout Mapper.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Visacheckoutmapper {
  private $requestModel;

  /**
   * Class constructor.
   *
   * @param mixed $requestModel
   *   The request model.
   */
  public function __construct($requestModel) {
    $this->setRequestModel($requestModel);
  }

  /**
   * Get a request model.
   *
   * @return mixed
   *   The request model.
   */
  public function getRequestModel() {
    return $this->requestModel;
  }

  /**
   * Set a request model.
   *
   * @param mixed $requestModel
   *   The request model.
   */
  public function setRequestModel($requestModel) {
    $this->requestModel = $requestModel;
  }

  /**
   * Request a converted request model.
   *
   * @param mixed|null $requestModel
   *   The request model.
   *
   * @return array|null
   *   The reporting array.
   */
  public function requestPayloadConverter($requestModel = null) {
    $requestVisacheckout = null;
    if (!$requestModel) {
      $requestModel = $this->getRequestModel();
    }

    if ($requestModel) {
      $requestVisacheckout = array();

      if (
        method_exists(
          $requestModel,
          'getCallId'
        ) && ($callId = $requestModel
          ->getCallId()
        )) {
        $requestVisacheckout['callId'] = $callId;
      }

      if (
        method_exists(
          $requestModel,
          'getIncludeBindata') && ($includeBindata = $requestModel
          ->getIncludeBindata())
      ) {
        $requestVisacheckout['includeBindata'] = $includeBindata;
      }
    }

    return $requestVisacheckout;
  }

}
