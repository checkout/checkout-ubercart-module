<?php

/**
 * Checkout.com Apiservices\Recurringpayments\Recurringpaymentservice.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */
namespace com\checkout\Apiservices\Recurringpayments;

/**
 * Class Recurring Payment Service.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Recurringpaymentservice extends \com\checkout\Apiservices\Baseservices {

  /**
   * Creates a new payment plan
   *
   * @param Requestmodels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createSinglePlan(Requestmodels\Baserecurringpayment $requestModel) {
    $Recurringpaymentmapper = new \com\checkout\Apiservices\Recurringpayments\Recurringpaymentmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $Recurringpaymentmapper->requestPayloadConverter(),
    );

    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getRecurringpaymentsApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Recurringpayment($processCharge);

    return $responseModel;
  }

  /**
   * Creates multiple payment plans.
   *
   * @param array $plansArray
   *   A array filled with request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createMultiplePlans(array $plansArray) {
    $temporaryArray;

    foreach ($plansArray as $singlePlan) {
      $Recurringpaymentmapper = new \com\checkout\Apiservices\Recurringpayments\Recurringpaymentmapper($singlePlan);
      $_requestPayloadConverter = $Recurringpaymentmapper
        ->requestPayloadConverter();
      $temporaryArray[] = $_requestPayloadConverter['paymentPlans'][0];
    }

    $arrayToSubmit['paymentPlans'] = $temporaryArray;

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $arrayToSubmit,

    );

    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getRecurringpaymentsApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new Responsemodels\Recurringpayment($processCharge);

    return $responseModel;
  }

  /**
   * Update a payment plan.
   *
   * @param Requestmodels\Baserecurringpayment $requestModel
   *   A request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function updatePlan(Requestmodels\Planupdate $requestModel) {
    $Recurringpaymentmapper = new \com\checkout\Apiservices\Recurringpayments\Recurringpaymentmapper($requestModel);

    $_requestPayloadConverter = $Recurringpaymentmapper->requestPayloadConverter();

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $_requestPayloadConverter['paymentPlans'][0],

    );

    $updatePlanUri = $this
      ->apiUrl
      ->getRecurringpaymentsApiUri() . '/' . $requestModel
      ->getPlanId();
    $processCharge = \com\checkout\Helpers\ApiHttpClient::putRequest(
      $updatePlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Sharedmodels\Okresponse(
      $processCharge
    );

    return $responseModel;
  }

  /**
   * Cancel a payment plan.
   *
   * @param mixed $planId
   *   The Payment Plan id prefixed with rp_ .
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function cancelPlan($planId) {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $cancelPlanUri = $this->apiUrl->getRecurringpaymentsApiUri() . '/' . $planId;
    $processCharge = \com\checkout\Helpers\ApiHttpClient::deleteRequest(
      $cancelPlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Sharedmodels\Okresponse(
      $processCharge
    );

    return $responseModel;
  }

  /**
   * Get a payment plan.
   *
   * @param mixed $planId
   *   The Payment Plan id prefixed with rp_ .
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function getPlan($planId) {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $getPlanUri = $this->apiUrl->getRecurringpaymentsApiUri() . '/' . $planId;
    $processCharge = \com\checkout\Helpers\ApiHttpClient::getRequest(
      $getPlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Recurringpayments\Responsemodels\Paymentplan($processCharge);

    return $responseModel;
  }

  /**
   * Create a customer plan with full card details.
   *
   * @param Requestmodels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createPlanWithFullCard(
    Requestmodels\Planwithfullcardcreate $requestModel
  ) {
    $chargesMapper = new \com\checkout\Apiservices\Charges\Chargesmapper(
      $requestModel
    );

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargesMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardChargesApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Charges\Responsemodels\Charge(
      $processCharge
    );

    return $responseModel;
  }

  /**
   * Create a customer plan with a card id.
   *
   * @param Requestmodels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createPlanWithCardId(
    Requestmodels\Planwithcardidcreate $requestModel
  ) {
    $chargesMapper = new \com\checkout\Apiservices\Charges\Chargesmapper(
      $requestModel
    );

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargesMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardChargesApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Charges\Responsemodels\Charge(
      $processCharge
    );

    return $responseModel;
  }

  /**
   * Create a customer plan with a card token.
   *
   * @param Requestmodels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createPlanWithCardtoken(
    Requestmodels\Planwithcardtokencreate $requestModel
  ) {
    $chargesMapper = new \com\checkout\Apiservices\Charges\Chargesmapper(
      $requestModel
    );

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargesMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardtokensApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Charges\Responsemodels\Charge(
      $processCharge
    );

    return $responseModel;
  }

  /**
   * Create a customer plan with a payment id.
   *
   * @param Requestmodels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createPlanWithPaymenttoken(
    Requestmodels\Planwithpaymenttokencreate $requestModel
  ) {
    $chargesMapper = new \com\checkout\Apiservices\Charges\Chargesmapper(
      $requestModel
    );

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargesMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getPaymenttokensApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Tokens\Responsemodels\Paymenttoken($processCharge);

    return $responseModel;
  }

  /**
   * Update a customer plan.
   *
   * @param Requestmodels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function updateCustomerPlan(Requestmodels\Customerplanupdate $requestModel) {
    $chargesMapper = new \com\checkout\Apiservices\Charges\Chargesmapper(
      $requestModel
    );

    $_requestPayloadConverter = $chargesMapper->requestPayloadConverter();

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $_requestPayloadConverter['paymentPlans'][0],

    );

    $updatePlanUri = $this
      ->apiUrl
      ->getRecurringpaymentsCustomersApiUri() . '/' . $requestModel
      ->getCustomerPlanId();
    $processCharge = \com\checkout\Helpers\ApiHttpClient::putRequest(
      $updatePlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Sharedmodels\Okresponse(
      $processCharge
    );

    return $responseModel;
  }

  /**
   * Cancel a customer plan.
   *
   * @param string $customerPlanId
   *   The customer payment plan id prefixed with cp_ .
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function cancelCustomerPlan($customerPlanId) {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $cancelPlanUri = $this
      ->apiUrl
      ->getRecurringpaymentsCustomersApiUri() . '/' . $customerPlanId;
    $processCharge = \com\checkout\Helpers\ApiHttpClient::deleteRequest(
      $cancelPlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\Apiservices\Sharedmodels\Okresponse($processCharge);

    return $responseModel;
  }

  /**
   * Get a customer plan.
   *
   * @param string $customerPlanId
   *   The customer payment plan id prefixed with cp_ .
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function getCustomerPlan($customerPlanId) {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $getPlanUri = $this
      ->apiUrl
      ->getRecurringpaymentsCustomersApiUri() . '/' . $customerPlanId;
    $processCharge = \com\checkout\Helpers\ApiHttpClient::getRequest(
      $getPlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );
    echo $getPlanUri;

    $responseModel = new \com\checkout\Apiservices\Recurringpayments\Responsemodels\Customerpaymentplan($processCharge);

    return $responseModel;
  }

  /**
   * Query payments plans.
   *
   * @param Requestmodels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function queryPlan(Requestmodels\Querypaymentplan $requestModel) {
    $queryMapper = new Recurringpaymentquerymapper($requestModel);
    $queryUri = $this->apiUrl->getRecurringpaymentsQueryApiUri();
    $secretKey = $this->apiSetting->getSecretKey();

    $requestQuery = array(
      'authorization' => $secretKey,
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $queryMapper->requestQueryConverter(),

    );

    $processQuery = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $queryUri,
      $secretKey,
      $requestQuery
    );
    $responseModel = new Responsemodels\Paymentplanlist($processQuery);

    return $responseModel;
  }

  /**
   * Query customer plans.
   *
   * @param Requestmodels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return Responsemodels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function queryCustomerPlan(Requestmodels\Querycustomerplan $requestModel) {
    $queryMapper = new Recurringpaymentquerymapper($requestModel);
    $queryUri = $this->apiUrl->getRecurringpaymentsCustomersQueryApiUri();
    $secretKey = $this->apiSetting->getSecretKey();

    $requestQuery = array(
      'authorization' => $secretKey,
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $queryMapper->requestQueryConverter(),

    );

    $processQuery = \com\checkout\Helpers\ApiHttpClient::postRequest(
      $queryUri,
      $secretKey,
      $requestQuery
    );
    $responseModel = new Responsemodels\Paymentplanlist($processQuery);

    return $responseModel;
  }

}
