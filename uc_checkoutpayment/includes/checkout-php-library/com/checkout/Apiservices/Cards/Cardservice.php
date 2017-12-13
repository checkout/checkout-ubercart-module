<?php

/**
 * Checkout.com Apiservices\Cards\CardService.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Cards;

/**
 * Class Card Service.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardservice extends \com\checkout\Apiservices\Baseservices {

  /**
   * Create a new card.
   *
   * @param Requestmodels\Cardcreate $requestModel
   *   The request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createCard(Requestmodels\Cardcreate $requestModel) {
    $cardMapper = new Cardmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $cardMapper->requestPayloadConverter(),

    );

    $createCardUri = sprintf(
      $this->apiUrl->getCardsApiUri(),
      $requestModel->getCustomerId()
    );
    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $createCardUri,
      $this->apiSetting->getSecretKey(),
      $requestPayload
    );

    $responseModel = new Responsemodels\Card($processCharge);
    return $responseModel;
  }

  /**
   * Get a card.
   *
   * @param mixed $customerId
   *   The customer id prefixed with cust_ .
   * @param mixed $cardId
   *   The card id prefixed with card_ .
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function getCard($customerId, $cardId) {
    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );

    $getCardUri = sprintf(
      $this->apiUrl->getCardsApiUri(),
      $customerId
    ) . '/' . $cardId;

    $processCharge = \com\checkout\Helpers\ApiHttpClient::getRequest(
      $getCardUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Card($processCharge);
    return $responseModel;
  }

  /**
   * Update a card.
   *
   * @param Requestmodels\Baserecurringpayment $requestModel
   *   A request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function updateCard(
    \com\checkout\Apiservices\Cards\Requestmodels\Cardupdate $requestModel
  ) {
    $cardMapper = new Cardmapper($requestModel);
    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $cardMapper->requestPayloadConverterCard(),

    );

    $getCardUri = sprintf(
      $this->apiUrl->getCardsApiUri(),
      $requestModel->getCustomerId()
    ) . '/' . $requestModel->getCardId();

    $processCharge = \com\checkout\Helpers\ApiHttpClient::putRequest(
      $getCardUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );
    $responseModel = new \com\checkout\Apiservices\Sharedmodels\Okresponse($processCharge);
    return $responseModel;
  }

  /**
   * Delete a card.
   *
   * @param mixed $customerId
   *   The customer id prefixed with cust_ .
   * @param mixed $cardId
   *   The card id prefixed with card_ .
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function deleteCard($customerId, $cardId) {
    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
    );

    $getCardUri = sprintf(
      $this->apiUrl->getCardsApiUri(),
      $customerId
    ) . '/' . $cardId;

    $processCharge = \com\checkout\Helpers\ApiHttpClient::deleteRequest(
      $getCardUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Sharedmodels\Okresponse(
      $processCharge
    );
    return $responseModel;
  }

  /**
   * Get a list of cards.
   *
   * @param mixed $customerId
   *   The customer id prefixed with cust_ .
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function getCartList($customerId) {
    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );

    $getCardUri = sprintf($this->apiUrl->getCardsApiUri(), $customerId);

    $processCharge = \com\checkout\Helpers\ApiHttpClient::getRequest(
      $getCardUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Cardlist($processCharge);
    return $responseModel;
  }
}
