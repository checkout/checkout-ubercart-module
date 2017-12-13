<?php

/**
 * Checkout.com Apiservices\Sharedmodels\Bindata.
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
 * Class Card Mapper.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardmapper {
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
    $requestPayload = null;
    if (!$requestModel) {
      $requestModel = $this->getRequestModel();
    }
    if ($requestModel) {
      $requestPayload = array();

      if (
        method_exists(
          $requestModel,
          'getCustomerId'
        ) && ($customerId = $requestModel
          ->getCustomerId()
        )
      ) {
        $requestPayload['customerId'] = $customerId;
      }

      if (method_exists($requestModel, 'getBasecardcreate')) {
        $cardBase = $requestModel->getBasecardcreate();
        if ($billingAddress = $cardBase->getBillingDetails()) {
          $billingAddressConfig = array(
            'addressLine1' => $billingAddress->getAddressLine1(),
            'addressLine2' => $billingAddress->getAddressLine2(),
            'postcode' => $billingAddress->getPostcode(),
            'country' => $billingAddress->getCountry(),
            'city' => $billingAddress->getCity(),
            'state' => $billingAddress->getState(),
          );

          if ($billingAddress->getPhone() != null) {
            $billingAddressConfig = array_merge_recursive(
              $billingAddressConfig,
              array(
                'phone' => $billingAddress->getPhone()->getPhoneDetails(),
              )
            );
          }
          $requestPayload['billingDetails'] = $billingAddressConfig;
        }

        if (
          method_exists($cardBase, 'getName') &&
          $name = $cardBase->getName()
        ) {
          $requestPayload['name'] = $name;
        }

        if (
          method_exists($cardBase, 'getNumber') &&
          $number = $cardBase->getNumber()
        ) {
          $requestPayload['number'] = $number;
        }

        if (
          method_exists($cardBase, 'getExpiryMonth') &&
          $expiryMonth = $cardBase->getExpiryMonth()
        ) {
          $requestPayload['expiryMonth'] = $expiryMonth;
        }

        if (
          method_exists($cardBase, 'getExpiryYear') &&
          $expiryYear = $cardBase->getExpiryYear()
        ) {
          $requestPayload['expiryYear'] = $expiryYear;
        }

        if (
          method_exists($cardBase, 'getCvv') &&
          $cvv = $cardBase->getCvv()
        ) {
          $requestPayload['cvv'] = $cvv;
        }
      }

    }

    return $requestPayload;

  }

  /**
   * Request a converted request card.
   *
   * @param mixed|null $requestModel
   *   The request model.
   *
   * @return array|null
   *   The reporting array.
   */
  public function requestPayloadConverterCard($requestModel = null) {
    $requestPayload = null;
    if (!$requestModel) {
      $requestModel = $this->getRequestModel();
    }
    if ($requestModel) {
      $requestPayload = array();

      if (method_exists($requestModel, 'getBasecard')) {
        $cardBase = $requestModel->getBasecard();

        if ($billingAddress = $cardBase->getBillingDetails()) {
          $billingAddressConfig = array(
            'addressLine1' => $billingAddress->getAddressLine1(),
            'addressLine2' => $billingAddress->getAddressLine2(),
            'postcode' => $billingAddress->getPostcode(),
            'country' => $billingAddress->getCountry(),
            'city' => $billingAddress->getCity(),
            'state' => $billingAddress->getState(),
          );

          if ($billingAddress->getPhone() != null) {
            $billingAddressConfig = array_merge_recursive(
              $billingAddressConfig,
              array(
                'phone' => $billingAddress->getPhone()->getPhoneDetails(),
              )
            );
          }

          $requestPayload['billingDetails'] = $billingAddressConfig;
        }

        if ($name = $cardBase->getName()) {
          $requestPayload['name'] = $name;
        }
        if (
          method_exists($cardBase, 'getExpiryMonth') &&
          $expiryMonth = $cardBase->getExpiryMonth()
        ) {
          $requestPayload['expiryMonth'] = $expiryMonth;
        }

        if (
          method_exists($cardBase, 'getExpiryYear') &&
          $expiryYear = $cardBase->getExpiryYear()
        ) {
          $requestPayload['expiryYear'] = $expiryYear;
        }

        if (
          method_exists($cardBase, 'getDefaultCard') &&
          $defaultCard = $cardBase->getDefaultCard()
        ) {
          $requestPayload['defaultCard'] = $defaultCard;
        }
      }
    }
    return $requestPayload;

  }

}
