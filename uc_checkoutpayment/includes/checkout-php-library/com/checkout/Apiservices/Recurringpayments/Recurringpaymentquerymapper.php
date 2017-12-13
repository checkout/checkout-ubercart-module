<?php

/**
 * Checkout.com Apiservices\Recurringpayments\Recurringpaymentquerymapper.
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
 * Class Recurring Payment Query Mapper.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Recurringpaymentquerymapper {
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
  public function requestQueryConverter($requestModel = null) {
    $requestQuery = null;
    if (!$requestModel) {
      $requestModel = $this->getRequestModel();
    }

    if ($requestModel) {
      $requestQuery = array();

      if (
        method_exists($requestModel, 'getFromDate') &&
        ($fromDate = $requestModel->getFromDate())
      ) {
        $requestQuery['fromDate'] = $fromDate;
      }

      if (
        method_exists($requestModel, 'getToDate') &&
        ($toDate = $requestModel->getToDate())
      ) {
        $requestQuery['toDate'] = $toDate;
      }

      if (
        method_exists($requestModel, 'getOffset') &&
        ($offset = $requestModel->getOffset())
      ) {
        $requestQuery['offset'] = $offset;
      }

      if (
        method_exists($requestModel, 'getCount') &&
        ($count = $requestModel->getCount())
      ) {
        $requestQuery['count'] = $count;
      }

      if (
        method_exists($requestModel, 'getName') &&
        ($name = $requestModel->getName())
      ) {
        $requestQuery['name'] = $name;
      }

      if (
        method_exists($requestModel, 'getPlanTrackId') &&
        ($planTrackId = $requestModel->getPlanTrackId())
      ) {
        $requestQuery['planTrackId'] = $planTrackId;
      }

      if (
        method_exists($requestModel, 'getAutoCapTime') &&
        ($autoCapTime = $requestModel->getAutoCapTime())
      ) {
        $requestQuery['autoCapTime'] = $autoCapTime;
      }

      if (
        method_exists($requestModel, 'getValue') &&
        ($value = $requestModel->getValue())
      ) {
        $requestQuery['value'] = $value;
      }

      if (
        method_exists($requestModel, 'getStatus') &&
        ($status = $requestModel->getStatus())
      ) {
        $requestQuery['status'] = $status;
      }

      if (
        method_exists($requestModel, 'getPlanId') &&
        ($planId = $requestModel->getPlanId())
      ) {
        $requestQuery['planId'] = $planId;
      }

      if (
        method_exists($requestModel, 'getCardId') &&
        ($cardId = $requestModel->getCardId())
      ) {
        $requestQuery['cardId'] = $cardId;
      }

      if (
        method_exists($requestModel, 'getCustomerId') &&
        ($customerId = $requestModel->getCustomerId())
      ) {
        $requestQuery['customerId'] = $customerId;
      }

      if (
        method_exists($requestModel, 'getCurrency') &&
        ($currency = $requestModel->getCurrency())
      ) {
        $requestQuery['currency'] = $currency;
      }

      if (
        method_exists($requestModel, 'getCycle') &&
        ($cycle = $requestModel->getCycle())
      ) {
        $requestQuery['cycle'] = $cycle;
      }

      if (
        method_exists($requestModel, 'getStartDate') &&
        ($startDate = $requestModel->getStartDate())
      ) {
        $requestQuery['startDate'] = $startDate;
      }

      if (
        method_exists($requestModel, 'getNextRecurringDate') &&
        ($nextRecurringDate = $requestModel->getNextRecurringDate())
      ) {
        $requestQuery['nextRecurringDate'] = $nextRecurringDate;
      }
    }

    return $requestQuery;
  }

}
