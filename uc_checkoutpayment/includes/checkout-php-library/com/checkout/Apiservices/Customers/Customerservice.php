<?php

/**
 * Checkout.com Apiservices\Customers\Customerservice.
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
class Customerservice extends \com\checkout\Apiservices\Baseservices {

  /**
   * Creates a new customer.
   *
   * @param Requestmodels\Customercreate $requestModel
   *   The request model.
   *
   * @return Responsemodels\Customer
   *   The response models or Customer.
   */
  public function createCustomer(Requestmodels\Customercreate $requestModel) {
    $customerMapper = new Customermapper($requestModel);
    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $customerMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCustomersApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );
    $responseModel = new Responsemodels\Customer($processCharge);
    return $responseModel;
  }

  /**
   * Update a customer.
   *
   * @param Requestmodels\Customerupdate $requestModel
   *   The request model.
   *
   * @return Responsemodels\Okresponse
   *   The response models or an OK.
   */
  public function updateCustomer(Requestmodels\Customerupdate $requestModel) {

    $customerMapper = new Customermapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $customerMapper->requestPayloadConverter(),

    );
    $updateCustomerUri = $this
      ->apiUrl
      ->getCustomersApiUri() . '/' . $requestModel
      ->getCustomerId();
    $processCharge = \com\checkout\Helpers\ApiHttpClient::putRequest(
      $updateCustomerUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Sharedmodels\Okresponse(
      $processCharge
    );

    return $responseModel;

  }

  /**
   * Delete a customer.
   *
   * @param string $customerId
   *   The customer id.
   *
   * @return Responsemodels\Okresponse
   *   The response models or an OK.
   */
  public function deleteCustomer($customerId) {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $deleteCustomerUri = $this->apiUrl->getCustomersApiUri() . '/' . $customerId;
    $processCharge = \com\checkout\Helpers\ApiHttpClient::deleteRequest(
      $deleteCustomerUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Sharedmodels\Okresponse(
      $processCharge
    );

    return $responseModel;
  }

  /**
   * Get a customer.
   *
   * @param string $customerId
   *   The customer id.
   *
   * @return Responsemodels\Okresponse
   *   The response models or an OK.
   */
  public function getCustomer($customerId) {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $getCustomerUri = $this->apiUrl->getCustomersApiUri() . '/' . $customerId;
    $processCharge = \com\checkout\Helpers\ApiHttpClient::getRequest(
      $getCustomerUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Customer($processCharge);

    return $responseModel;
  }

  /**
   * Search in customer and return a list.
   *
   * @param string|null $count
   *   The count of the list.
   * @param string|null $offset
   *   The page offset of the search.
   * @param string|null $startDate
   *   The start date of the search.
   * @param string|null $endDate
   *   The end date of the search.
   * @param bool $singleDay
   *   False if you want multiple days.
   *
   * @return Responsemodels\Customerlist
   *   The response models or an customer list.
   */
  public function getCustomerlist(
    $count = null,
    $offset = null,
    $startDate = null,
    $endDate = null,
    $singleDay = false
  ) {
    $customerUri = $this->apiUrl->getCustomersApiUri();
    $delimiter = '?';
    $createdAt = 'created=';

    $startDateUnix = ($startDate) ? time($startDate) : null;
    $endDateUnix = ($endDate) ? time($endDate) : null;

    if ($count) {
      $customerUri = "{$customerUri}{$delimiter}count={$count}";
      $delimiter = '&';
    }
    if ($offset) {
      $customerUri = "{$customerUri}{$delimiter}offset={$offset}";
      $delimiter = '&';
    }
    if ($singleDay && $startDateUnix) {
      $customerUri = "{$customerUri}{$delimiter}{$createdAt}{$startDateUnix}|";

    }
    else {
      if ($startDateUnix) {
        $customerUri = "{$customerUri}{$delimiter}{$createdAt}{$startDateUnix}";
        $createdAt = '|';
      }
      if ($endDateUnix) {
        $customerUri = "{$customerUri}{$createdAt}{$endDateUnix}";

      }
    }
    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $processCharge = \com\checkout\Helpers\ApiHttpClient::getRequest(
      $customerUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );
    $responseModel = new Responsemodels\Customerlist($processCharge);
    return $responseModel;
  }

}
