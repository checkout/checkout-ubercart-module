<?php

/**
 * Checkout.com Apiservices\Recurringpayments\Recurringpaymentmapper.
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
 * Class Recurring Payment Mapper.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Recurringpaymentmapper {
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

      $requestSinglePaymentplan = array();

      if (
        method_exists($requestModel, 'getName') &&
        ($name = $requestModel->getName())
      ) {
        $requestSinglePaymentplan['name'] = $name;
      }

      if (
        method_exists($requestModel, 'getPlanTrackId') &&
        ($planTrackId = $requestModel->getPlanTrackId())
      ) {
        $requestSinglePaymentplan['planTrackId'] = $planTrackId;
      }

      if (
        method_exists($requestModel, 'getAutoCapTime') &&
        ($autoCapTime = $requestModel->getAutoCapTime())
      ) {
        $requestSinglePaymentplan['autoCapTime'] = $autoCapTime;
      }

      if (
        method_exists($requestModel, 'getCurrency') &&
        ($currency = $requestModel->getCurrency())
      ) {
        $requestSinglePaymentplan['currency'] = $currency;
      }

      if (
        method_exists($requestModel, 'getValue') &&
        ($value = $requestModel->getValue())
      ) {
        $requestSinglePaymentplan['value'] = $value;
      }
      if (
        method_exists($requestModel, 'getCycle') &&
        ($cycle = $requestModel->getCycle())
      ) {
        $requestSinglePaymentplan['cycle'] = $cycle;
      }

      if (
        method_exists($requestModel, 'getRecurringCount') &&
        ($recurringCount = $requestModel->getRecurringCount())
      ) {
        $requestSinglePaymentplan['recurringCount'] = $recurringCount;
      }

      if (
        method_exists($requestModel, 'getPlanId') &&
        ($planId = $requestModel->getPlanId())
      ) {
        $requestSinglePaymentplan['planId'] = $planId;
      }

      if (
        method_exists($requestModel, 'getStartDate') &&
        ($startDate = $requestModel->getStartDate())
      ) {
        $requestSinglePaymentplan['startDate'] = $startDate;
      }

      $requestPayload['paymentPlans'][] = $requestSinglePaymentplan;
    }

    return $requestPayload;

  }

}
