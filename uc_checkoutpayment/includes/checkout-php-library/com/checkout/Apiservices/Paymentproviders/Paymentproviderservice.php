<?php

/**
 * Checkout.com Apiservices\Paymentproviders\Paymentproviderservice.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Paymentproviders;

/**
 * Class Payment Provider Service.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Paymentproviderservice extends \com\checkout\Apiservices\Baseservices {

  /**
   * Get a list of card providers.
   *
   * @return Responsemodels\Cardproviderlist
   *   The response models or a card provider list object.
   */
  public function getCardproviderlist() {
    $requestPayload = array(
      'authorization' => $this->apiSetting->getPublicKey(),
      'mode' => $this->apiSetting->getMode(),

    );

    $processCharge = \com\checkout\Helpers\ApiHttpClient::getRequest(
      $this->apiUrl->getCardprovidersUri(),
      $this->apiSetting->getPublicKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Cardproviderlist($processCharge);

    return $responseModel;
  }

  /**
   * Get a card provider's details.
   *
   * @return Responsemodels\Cardprovider
   *   The response models or a card provider object.
   */
  public function getCardprovider($id) {
    $requestPayload = array(
      'authorization' => $this->apiSetting->getPublicKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $cardProviderByIdUri = $this->apiUrl->getCardprovidersUri() . "/$id";
    $processCharge = \com\checkout\Helpers\ApiHttpClient::getRequest(
      $cardProviderByIdUri,
      $this->apiSetting->getPublicKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Paymentproviders\Responsemodels\Cardprovider($processCharge);

    return $responseModel;
  }
}
