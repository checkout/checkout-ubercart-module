<?php

/**
 * Checkout.com Apiservices\Recurringpayments\Requestmodels\Querypaymentplan.
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
 * Class Query Payment Plan.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Querypaymentplan {
  private $fromDate = null;
  private $toDate = null;
  private $offset = null;
  private $count = null;
  private $name = null;
  private $planTrackId = null;
  private $autoCapTime = null;
  private $value = null;
  private $status = null;

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

}
