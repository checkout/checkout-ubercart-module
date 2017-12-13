<?php

/**
 * Checkout.com Apiservices\Customers\Customermapper.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Customers;

/**
 * Class Customer.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Customermapper {
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
        method_exists($requestModel, 'getName') &&
        ($name = $requestModel->getName())
      ) {
        $requestPayload['name'] = $name;
      }

      if (
        method_exists($requestModel, 'getEmail') &&
        ($email = $requestModel->getEmail())
      ) {
        $requestPayload['email'] = $email;
      }

      if (
        method_exists($requestModel, 'getCustomerName') &&
        ($customerName = $requestModel->getCustomerName())
      ) {
        $requestPayload['customerName'] = $customerName;
      }

      if (
        method_exists($requestModel, 'getMetadata') &&
        ($metadata = $requestModel->getMetadata())
      ) {
        $requestPayload['metadata'] = $metadata;
      }

      if (
        method_exists($requestModel, 'getPhoneNumber') &&
        ($phoneNumber = $requestModel->getPhoneNumber())
      ) {
        $requestPayload['phoneNumber'] = $phoneNumber;
      }
      if (
        method_exists($requestModel, 'getCustomerId') &&
        ($customerId = $requestModel->getCustomerId())
      ) {
        $requestPayload['customerId'] = $customerId;
      }

      if (
        method_exists($requestModel, 'getDescription') &&
        ($description = $requestModel->getDescription())
      ) {
        $requestPayload['description'] = $description;
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
          $requestPayload['card']['billingDetails'] = $billingAddressConfig;
        }

        if ($name = $cardBase->getName()) {
          $requestPayload['card']['name'] = $name;
        }

        if ($number = $cardBase->getNumber()) {
          $requestPayload['card']['number'] = $number;
        }

        if ($expiryMonth = $cardBase->getExpiryMonth()) {
          $requestPayload['card']['expiryMonth'] = $expiryMonth;
        }

        if ($expiryYear = $cardBase->getExpiryYear()) {
          $requestPayload['card']['expiryYear'] = $expiryYear;
        }

        if ($cvv = $cardBase->getCvv()) {
          $requestPayload['card']['cvv'] = $cvv;
        }
      }

    }

    return $requestPayload;

  }
}
