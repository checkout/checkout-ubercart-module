<?php

/**
 * Checkout.com Apiservices\Recurringpayments\Requestmodels\Baserecurringpayment.
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
 * Class Recurring payment.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Baserecurringpayment {
  protected $name;
  protected $planTrackId;
  protected $autoCapTime;
  protected $currency;
  protected $value;
  protected $cycle;
  protected $recurringCount;
  protected $startDate;
  protected $status;
  protected $planId;

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
   * Get the unique identifier for the recurring plan set by the Merchant.
   *
   * @return string
   *   The plan track id.
   */
  public function getPlanTrackId() {
    return $this->planTrackId;
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
   * Get the delayed capture time in hours.
   *
   * @return mixed
   *   The auto cap time.
   */
  public function getAutoCapTime() {
    return $this->autoCapTime;
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
   * Get the number of recurring transactions included in the Payment Plan.
   *
   * Note: recurringCount does not include the initial payment.
   *
   * @return mixed
   *   The recurringCount.
   */
  public function getRecurringCount() {
    return $this->recurringCount;
  }

  /**
   * Set the number of recurring transactions included in the Payment Plan.
   *
   * Note: recurringCount does not include the initial payment.
   *
   * @param mixed $recurringCount
   *   The recurringCount.
   */
  public function setRecurringCount($recurringCount) {
    $this->recurringCount = $recurringCount;
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
}
