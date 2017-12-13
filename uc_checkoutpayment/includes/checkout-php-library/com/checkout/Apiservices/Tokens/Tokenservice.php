<?php

/**
 * Checkout.com Apiservices\Tokens\Tokenservice.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Tokens;

use com\checkout\Apiservices\Baseservices;
use com\checkout\Apiservices\Charges\Chargesmapper;
use com\checkout\Apiservices\Sharedmodels\Okresponse;
use com\checkout\Apiservices\Tokens\Requestmodels\Paymenttokenupdate;
use com\checkout\Helpers\ApiHttpClient;
use com\checkout\Helpers\ApiHttpClientCustomException;

/**
 * Class Token Service.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Tokenservice extends Baseservices {

  /**
   * Create a payment token object.
   *
   * @param Requestmodels\Paymenttokencreate $requestModel
   *   The request model.
   *
   * @return Responsemodels\Paymenttoken
   *   The response model or payment token object.
   *
   * @throws ApiHttpClientCustomException
   */
  public function createPaymenttoken(
    Requestmodels\Paymenttokencreate $requestModel
  ) {
    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),
    );

    $processCharge = ApiHttpClient::postRequest(
      $this->apiUrl->getPaymenttokensApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    return new Responsemodels\Paymenttoken($processCharge);
  }

  /**
   * Update a payment token object.
   *
   * @param Requestmodels\Paymenttokenupdate $requestModel
   *   The request model.
   *
   * @return Responsemodels\Paymenttokenupdate
   *   The response model or payment token object.
   *
   * @throws ApiHttpClientCustomException
   */
  public function updatePaymenttoken(
    Requestmodels\Paymenttokenupdate $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),
    );

    $updateUri = sprintf(
      $this->apiUrl->getPaymenttokenupdateApiUri(),
      $requestModel->getId()
    );

    $processCharge = ApiHttpClient::putRequest(
      $updateUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    return new Okresponse($processCharge);
  }
}
