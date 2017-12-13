<?php

/**
 * Checkout.com Apiservices\Charges\Chargeservice.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Charges;

/**
 * Class Charges Service.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Chargeservice extends \com\checkout\Apiservices\Baseservices {

  /**
   * Verify the charge by its token
   *
   * @param String $paymentToken
   *   The payment token.
   *
   * @return Responsemodels\Charge
   *   The response model.
   */
  public function verifyCharge($paymentToken) {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'method' => 'GET',

    );

    $retrieveChargeWithChargeUri = sprintf(
      $this->apiUrl->getRetrieveChargesApiUri(),
      $paymentToken
    );

    $processCharge = \com\checkout\Helpers\ApiHttpClient::getRequest(
      $retrieveChargeWithChargeUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Charge($processCharge);
    return $responseModel;
  }

  /**
   * Creates a charge with full card details.
   *
   * @param Requestmodels\CardChargeCreate $requestModel
   *   The request model.
   *
   * @return Responsemodels\Charge
   *   The response models or charge objects.
   */
  public function chargeWithCard(Requestmodels\CardChargeCreate $requestModel) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardChargesApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Creates a charge with full card id.
   *
   * @param Requestmodels\Cardidchargecreate $requestModel
   *   The request model.
   *
   * @return Responsemodels\Charge
   *   The response models or charge objects.
   */

  public function chargeWithCardId(Requestmodels\Cardidchargecreate $requestModel) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardChargesApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Creates a charge with cardToken.
   *
   * @param Requestmodels\Cardtokenchargecreate $requestModel
   *   The request model.
   *
   * @return Responsemodels\Charge
   *   The response models or charge objects.
   */
  public function chargeWithCardtoken(
    Requestmodels\Cardtokenchargecreate $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );

    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardtokensApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Creates a charge with Default Customer Card.
   *
   * @param Requestmodels\Basecharge $requestModel
   *   The request model.
   *
   * @return Responsemodels\Charge
   *   The response models or charge objects.
   */
  public function chargeWithDefaultCustomerCard(Requestmodels\Basecharge
     $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getDefaultCardChargesApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Refund a charge.
   *
   * @param Requestmodels\Chargerefund $requestModel
   *   The request model.
   *
   * @return Responsemodels\Charge
   *   The response models or charge objects.
   */
  public function refundCardChargeRequest(Requestmodels\Chargerefund
     $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $refundUri = sprintf(
      $this
        ->apiUrl
        ->getChargerefundsApiUri(),
      $requestModel
        ->getChargeId()
    );

    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $refundUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Void a charge.
   *
   * @param Requestmodels\Chargevoid $requestModel
   *   The request model.
   *
   * @return Responsemodels\Charge
   *   The response models or charge objects.
   */
  public function voidCharge($chargeId, Requestmodels\Chargevoid
     $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $refundUri = sprintf($this->apiUrl->getVoidChargesApiUri(), $chargeId);

    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $refundUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Capture a charge.
   *
   * @param Requestmodels\Chargecapture $requestModel
   *   The request model.
   *
   * @return Responsemodels\Charge
   *   The response models or charge objects.
   */
  public function CaptureCardCharge(Requestmodels\Chargecapture
     $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $refundUri = sprintf(
      $this
        ->apiUrl
        ->getCaptureChargesApiUri(),
      $requestModel
        ->getChargeId()
    );

    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $refundUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Update a charge.
   *
   * @param Requestmodels\Chargeupdate $requestModel
   *   The request model.
   *
   * @return Responsemodels\Charge
   *   The response models or charge objects.
   */
  public function UpdateCardCharge(Requestmodels\Chargeupdate
     $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $updateUri = sprintf(
      $this
        ->apiUrl
        ->getUpdateChargesApiUri(),
      $requestModel
        ->getChargeId()
    );

    $processCharge = \com\checkout\Helpers\ApiHttpClient::putRequest(
      $updateUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Sharedmodels\Okresponse(
      $processCharge
    );

    return $responseModel;
  }

  /**
   * Get a Charge With a ChargeId.
   *
   * @param Requestmodels\ChargeRetrieve $chargeId
   *   The request model.
   *
   * @return Responsemodels\Charge
   *   The response models or charge objects.
   */
  public function getCharge($chargeId) {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'method' => 'GET',
    );

    $retrieveChargeWithChargeUri = sprintf(
      $this
        ->apiUrl
        ->getRetrieveChargesApiUri(),
      $chargeId
    );

    $processCharge = \com\checkout\Helpers\ApiHttpClient::getRequest(
      $retrieveChargeWithChargeUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Charge($processCharge);
    return $responseModel;
  }

  /**
   * Retrieve a Charge History With a ChargeId.
   *
   * @param Requestmodels\ChargeRetrieve $requestModel
   *   The request model.
   *
   * @return Responsemodels\Charge
   *   The response models or charge objects.
   */
  public function getChargehistory($chargeId) {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'method' => 'GET',
    );

    $retrieveChargehistoryWithChargeUri = sprintf(
      $this
        ->apiUrl
        ->getRetrieveChargehistoryApiUri(),
      $chargeId
    );

    $processCharge = \com\checkout\Helpers\ApiHttpClient::getRequest(
      $retrieveChargehistoryWithChargeUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Chargehistory($processCharge);
    return $responseModel;
  }

}
