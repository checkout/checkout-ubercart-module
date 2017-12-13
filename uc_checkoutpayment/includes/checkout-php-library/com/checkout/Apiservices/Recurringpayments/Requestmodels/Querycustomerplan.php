<?php

/**
 * Checkout.com Apiservices\Recurringpayments\Requestmodels\Querycustomerplan.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */
namespace com\checkout\Apiservices\Recurringpayments\Requestmodels;

/**
 * Class Query Customer Plan.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Querycustomerplan {
  private $fromDate = null;
  private $toDate = null;
  private $offset = null;
  private $count = null;
  private $planId = null;
  private $cardId = null;
  private $customerId = null;
  private $name = null;
  private $planTrackId = null;
  private $autoCapTime = null;
  private $value = null;
  private $currency = null;
  private $cycle = null;
  private $status = null;
  private $startDate = null;
  private $nextRecurringDate = null;

  /**
   * Set the start date in UTC date and time (based on ISO 8601 profile).
   *
   * Format: yyyy-MM-ddTHH:mm:ssZ (e.g. 2015-11-05T13:00:00Z).
   *
   * @param mixed $fromDate
   *   The fromDate.
   */
  public function setFromDate($fromDate) {
    $this->fromDate = $fromDate;
  }

  /**
   * Get the start date in UTC date and time (based on ISO 8601 profile).
   *
   * Format: yyyy-MM-ddTHH:mm:ssZ (e.g. 2015-11-05T13:00:00Z).
   *
   * @return mixed
   *   The fromDate.
   */
  public function getFromDate() {
    return $this->fromDate;
  }

  /**
   * Set the end date in UTC date and time (based on ISO 8601 profile).
   *
   * Format: yyyy-MM-ddTHH:mm:ssZ (e.g. 2015-11-05T13:00:00Z).
   *
   * @param mixed $toDate
   *   The toDate.
   */
  public function setToDate($toDate) {
    $this->toDate = $toDate;
  }

  /**
   * Get the end date in UTC date and time (based on ISO 8601 profile).
   *
   * Format: yyyy-MM-ddTHH:mm:ssZ (e.g. 2015-11-05T13:00:00Z).
   *
   * @return mixed
   *   The toDate.
   */
  public function getToDate() {
    return $this->toDate;
  }

  /**
   * Set the page offset.
   *
   * @param mixed $offset
   *   The page offset.
   */
  public function setOffset($offset) {
    $this->offset = $offset;
  }

  /**
   * Set the page offset.
   *
   * @param mixed $offset
   *   The page offset.
   */
  public function getOffset() {
    return $this->offset;
  }

  /**
   * Set the page count.
   *
   * @param mixed $requestModel
   *   The page count.
   */
  public function setCount($count) {
    $this->count = $count;
  }

  /**
   * Get the page data.
   *
   * @return mixed
   *   The page data.
   */
  public function getCount() {
    return $this->count;
  }

  /**
   * Set the name of the paymentPlan.
   *
   * The name as displayed in The Hub and attached to the customer.
   *
   * @param string $name
   *   The name.
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Get the name of the paymentPlan.
   *
   * The name as displayed in The Hub and attached to the customer.
   *
   * @return string
   *   The name.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set the unique identifier for the recurring plan set by the Merchant.
   *
   * @param string $planTrackId
   *   The plan track id.
   */
  public function setPlanTrackId($planTrackId) {
    $this->planTrackId = $planTrackId;
  }

  /**
   * Get the unique identifier for the recurring plan set by the Merchant.
   *
   * @return string
   *   The plan track id.
   */
  public function getPlanTrackId() {
    return $this->planTrackId;
  }

  /**
   * Set the delayed capture time in hours.
   *
   * @param mixed $autoCapTime
   *   The auto cap time.
   */
  public function setAutoCapTime($autoCapTime) {
    $this->autoCapTime = $autoCapTime;
  }

  /**
   * Get the delayed capture time in hours.
   *
   * @return mixed
   *   The auto cap time.
   */
  public function getAutoCapTime() {
    return $this->autoCapTime;
  }

  /**
   * Set the value of the transaction.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @param mixed $value
   *   The value.
   */
  public function setValue($value) {
    $this->value = $value;
  }

  /**
   * Get the value of the transaction.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @return mixed
   *   The value.
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Set the status of the recurring payment plan.
   *
   * It is used for the endpoint that will allow to monitor the health
   * of a recurring plan. Possible returned values are:
   *   0, "Failed Initial" : The transaction in the main charge request failed
   *     or was declined.
   *   1, "Active" : Active recurring payment plan, response if
   *     the transaction / payment plan is successful.
   *   2, "Cancelled" : Cancelled
   *   3, "In Arrears" : The recurring transactions failed.
   *   4, "Suspended" : Merchant paused the service. Or If retries also failed.
   *   5, "Completed" : Recurring payment plan completed.
   *
   * @param mixed $status
   *   The status.
   */
  public function setStatus($status) {
    $this->status = $status;
  }

  /**
   * Get the status of the recurring payment plan.
   *
   * It is used for the endpoint that will allow to monitor the health
   * of a recurring plan. Possible returned values are:
   *   0, "Failed Initial" : The transaction in the main charge request failed
   *     or was declined.
   *   1, "Active" : Active recurring payment plan, response if
   *     the transaction / payment plan is successful.
   *   2, "Cancelled" : Cancelled
   *   3, "In Arrears" : The recurring transactions failed.
   *   4, "Suspended" : Merchant paused the service. Or If retries also failed.
   *   5, "Completed" : Recurring payment plan completed.
   *
   * @return mixed
   *   The status.
   */
  public function getStatus() {
    return $this->status;
  }

  /**
   * Set the Payment plan ID.
   *
   * It is generated by Checkout.com and
   * prefixed with rp_ for identical recurring plans.
   *
   * @param string $planId
   *   The plan Id.
   */
  public function setPlanId($planId) {
    $this->planId = $planId;
  }

  /**
   * Get the Payment plan ID.
   *
   * It is generated by Checkout.com and
   * prefixed with rp_ for identical recurring plans.
   *
   * @return string
   *   The plan Id.
   */
  public function getPlanId() {
    return $this->planId;
  }

  /**
   * Set the card id that uniquely identifies the customer's card details.
   *
   * Note: ID prefixed with card_ .
   *
   * @param mixed $cardId
   *   The cardId.
   */
  public function setCardId($cardId) {
    $this->cardId = $cardId;
  }

  /**
   * Get the card id that uniquely identifies the customer's card details.
   *
   * Note: ID prefixed with card_ .
   *
   * @return mixed
   *   The customerPlanId.
   */
  public function getCardId() {
    return $this->cardId;
  }

  /**
   * Set the customer id.
   *
   * Note: ID prefixed with cust_ .
   *
   * @param mixed $customerId
   *   The customerId.
   */
  public function setCustomerId($customerId) {
    $this->customerId = $customerId;
  }

  /**
   * Get the customer id.
   *
   * Note: ID prefixed with cust_ .
   *
   * @return mixed
   *   The customerId.
   */
  public function getCustomerId() {
    return $this->customerId;
  }

  /**
   * Set the Three-letter ISO currency code.
   *
   * This code is representing the currency in
   * which the recurring charge will be made.
   *
   * @param mixed $currency
   *   The currency.
   */
  public function setCurrency($currency) {
    $this->currency = $currency;
  }

  /**
   * Get the Three-letter ISO currency code.
   *
   * This code is representing the currency in
   * which the recurring charge will be made.
   *
   * @return mixed
   *   The currency.
   */
  public function getCurrency() {
    return $this->currency;
  }

  /**
   * Set the elapsed time in between the charge and the first transaction.
   *
   * The time in between the charge and the first transaction of the recurring
   * plan. Maximum of 4 chars.
   *
   * Usage format:
   *   Xd (X: 1 - 730 days) e.g. 7d
   *   Xw (X: 1 - 104 weeks) e.g. 2w
   *   Xm (X: 1 - 24 months) e.g. 1m
   *   Xy (X: 1 - 2 years) e.g. 1y
   *
   * @param mixed $cycle
   *   The value.
   */
  public function setCycle($cycle) {
    $this->cycle = $cycle;
  }

  /**
   * Get the elapsed time in between the charge and the first transaction.
   *
   * The time in between the charge and the first transaction of the recurring
   * plan. Maximum of 4 chars.
   *
   * Usage format:
   *   Xd (X: 1 - 730 days) e.g. 7d
   *   Xw (X: 1 - 104 weeks) e.g. 2w
   *   Xm (X: 1 - 24 months) e.g. 1m
   *   Xy (X: 1 - 2 years) e.g. 1y
   *
   * @return mixed
   *   The value.
   */
  public function getCycle() {
    return $this->cycle;
  }

  /**
   * Set the forecasted timestamp of the first transaction.
   *
   * Forecasted timestamp of the first transaction generated
   * by the recurring plan in "YYYY-MM-DD" format.
   *
   * @param mixed $startDate
   *   The startDate.
   */
  public function setStartDate($startDate) {
    $this->startDate = $startDate;
  }

  /**
   * Get the forecasted timestamp of the first transaction.
   *
   * Forecasted timestamp of the first transaction generated
   * by the recurring plan in "YYYY-MM-DD" format.
   *
   * @return mixed
   *   The startDate.
   */
  public function getStartDate() {
    return $this->startDate;
  }

  /**
   * Set the date of next recurring transaction.
   *
   * Date of next recurring transaction in "YYYY-MM-DD" format. This is
   * especially useful when the merchant has applied a double recurring plan.
   *
   * @param mixed $nextRecurringDate
   *   The nextRecurringDate.
   */
  public function setNextRecurringDate($nextRecurringDate) {
    $this->nextRecurringDate = $nextRecurringDate;
  }

  /**
   * Get the date of next recurring transaction.
   *
   * Date of next recurring transaction in "YYYY-MM-DD" format. This is
   * especially useful when the merchant has applied a double recurring plan.
   *
   * @return mixed
   *   The nextRecurringDate.
   */
  public function getNextRecurringDate() {
    return $this->nextRecurringDate;
  }

}
