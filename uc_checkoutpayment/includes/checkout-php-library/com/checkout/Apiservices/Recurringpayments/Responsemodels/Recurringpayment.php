<?php

/**
 * Checkout.com Apiservices\Recurringpayments\Responsemodels\Recurringpayment.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Recurringpayments\Responsemodels;

/**
 * Class Recurring payment.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Recurringpayment extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  protected $object;
  protected $id;
  protected $paymentPlans;
  protected $totalCollectionCount;
  protected $totalCollectionValue;

  public function __construct($response) {
    parent::__construct($response);

    $this->setObject($response->getObject());
    $this->setTotalCollectionCount($response->getTotalCollectionCount());
    $this->setTotalCollectionValue($response->getTotalCollectionValue());

    if ($response->getPaymentplans()) {
      $this->setPaymentplans($response->getPaymentplans());
    }
  }

  /**
   * Get an object.
   *
   * @return int
   *   The object.
   */
  public function getObject() {
    return $this->object;
  }

  /**
   * Get the total number of transactions that will be applied against the card.
   *
   * @return mixed
   *   The totalCollectedCount.
   */
  public function getTotalCollectionCount() {
    return $this->totalCollectionCount;
  }

  /**
   * Get the total value of transactions that will be applied against the card.
   *
   * @return mixed
   *   The totalCollectionValue.
   */
  public function getTotalCollectionValue() {
    return $this->totalCollectionValue;
  }

  /**
   * Get an array of payment plans.
   *
   * Payment Plans store all the necessary information in support of implementing
   * subscription services, membership services, and other popular recurring
   * payment models. The fields within the Payment Plan object allow you to
   * customise several important details, including the amount charged to the
   * customer, currency, recurring billing cycle, and the number of recurring
   * transactions in the plan.
   *
   * @return mixed
   *   The paymentPlans.
   */
  public function getPaymentplans() {
    return $this->paymentPlans;
  }

  /**
   * Set an object.
   *
   * @param int $object
   *   The object.
   */
  private function setObject($object) {
    $this->object = $object;
  }

  /**
   * Set an array of payment plans.
   *
   * Payment Plans store all the necessary information in support of implementing
   * subscription services, membership services, and other popular recurring
   * payment models. The fields within the Payment Plan object allow you to
   * customise several important details, including the amount charged to the
   * customer, currency, recurring billing cycle, and the number of recurring
   * transactions in the plan.
   *
   * @param mixed $paymentPlans
   *   The paymentPlans.
   */
  protected function setPaymentplans($paymentPlans) {
    $paymentPlansArray = $paymentPlans->toArray();
    $paymentPlansToReturn = array();
    if ($paymentPlansArray) {
      foreach ($paymentPlansArray as $item) {
        $paymentPlan = new \com\checkout\Apiservices\Sharedmodels\Paymentplan();
        $paymentPlan->setPlanId($item['planId']);
        $paymentPlan->setName($item['name']);
        $paymentPlan->setPlanTrackId($item['planTrackId']);
        $paymentPlan->setAutoCapTime($item['autoCapTime']);
        $paymentPlan->setCurrency($item['currency']);
        $paymentPlan->setValue($item['value']);
        $paymentPlan->setRecurringCount($item['recurringCount']);
        $paymentPlan->setStatus($item['status']);
        $paymentPlansToReturn[] = $paymentPlan;
      }
    }

    $this->paymentPlans = $paymentPlansToReturn;
  }

  /**
   * Set the total number of transactions that will be applied against the card.
   *
   * @param mixed $totalCollectionCount
   *   The totalCollectionCount.
   */
  public function setTotalCollectionCount($totalCollectionCount) {
    $this->totalCollectionCount = $totalCollectionCount;
  }

  /**
   * Set the total value of transactions that will be applied against the card.
   *
   * @param mixed $totalCollectionValue
   *   The totalCollectionValue.
   */
  public function setTotalCollectionValue($totalCollectionValue) {
    $this->totalCollectionValue = $totalCollectionValue;
  }

  /**
   * Set the response code.
   *
   * A responseCode is a five-digit numeric code that indicates the status
   * of the request. Additional information on the request status may be
   * found in the responseMessage, responseAdvancedInfo and status fields.
   *
   * @param mixed $responseCode
   *   The responseCode.
   */
  private function setResponseCode($responseCode) {
    $this->responseCode = $responseCode;
  }

}
