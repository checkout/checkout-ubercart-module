<?php

/**
 * Checkout.com Apiservices\Visacheckout\Visacheckoutservice.
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
 * Class Visa Checkout Service.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Visacheckoutservice extends \com\checkout\Apiservices\Baseservices {
  /**
   * Create a VISA checkout card token.
   *
   * @param Requestmodels\Visacheckoutcardtokencreate $requestModel
   *   The request model.
   *
   * @return Responsemodels\Visacheckoutcardtoken
   *   The respons model or the visa checkout card token.
   *
   * @throws \Exception
   */
  public function createVisacheckoutcardtoken(
    Requestmodels\Visacheckoutcardtokencreate $requestModel,
    $publicKey
  ) {
    $visaCheckoutMapper = new Visacheckoutmapper($requestModel);
    $visaCheckoutUri = $this->apiUrl->getVisacheckoutcardtokenApiUri();

    // echo var_dump($visaCheckoutUri);
    $requestVisacheckout = array(
      'authorization' => $publicKey,
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $visaCheckoutMapper->requestPayloadConverter(),
    );

    $processVisacheckout = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $visaCheckoutUri, $publicKey,
      $requestVisacheckout
    );
    $responseModel = new Responsemodels\Visacheckoutcardtoken(
      $processVisacheckout
    );

    return $responseModel;
  }

}
