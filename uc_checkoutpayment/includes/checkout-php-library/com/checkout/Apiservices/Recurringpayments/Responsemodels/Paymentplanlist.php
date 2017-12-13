<?php

/**
 * Checkout.com Apiservices\Recurringpayments\Responsemodels\Paymentplanlist.
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
 * Class Customer payment plan list.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Paymentplanlist extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  private $_totalRows;
  private $_offSet;
  private $count;
  private $data;

  /**
   * @param null $response
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setTotalRows($response->getTotalRows());
    $this->setOffset($response->getOffset());
    $this->setCount($response->getCount());
    $this->setData($response->getData());
  }

  /**
   * Get the list count.
   *
   * @return int
   *   The list count.
   */
  public function getCount() {
    return $this->count;
  }

  /**
   * Get the list data.
   *
   * @return mixed
   *   The list data.
   */
  public function getData() {
    return $this->data;
  }

  /**
   * Set the list count.
   *
   * @param mixed $count
   *   The list count.
   */
  private function setCount($count) {
    $this->count = $count;
  }

  /**
   * Set the list data.
   *
   * @param mixed $data
   *   The list data.
   */
  private function setData($data) {
    $dataArray = $data->toArray();
    foreach ($dataArray as $paymentPlan) {
      $this->data[] = $this->getPaymentplan($paymentPlan);
    }
  }

  /**
   * Get a payment plan.
   *
   * @param mixed $paymentPlan
   *   The paymentPlan object.
   *
   * @return mixed
   *   A paymentPlan object.
   */
  private function getPaymentplan($paymentPlan) {
    return $paymentPlan;
  }

  /**
   * Set the total rows.
   *
   * @param mixed $totalRows
   *   The total rows.
   */
  private function setTotalRows($totalRows) {
    $this->_totalRows = $totalRows;
  }

  /**
   * Get the total rows.
   *
   * @return mixed
   *   The total rows.
   */
  public function getTotalRows() {
    return $this->_totalRows;
  }

  /**
   * Set the row offset.
   *
   * @param mixed $offset
   *   The row offset.
   */
  private function setOffset($offset) {
    $this->offset = $offset;
  }

  /**
   * Get the row offset.
   *
   * @return mixed
   *   The row offset.
   */
  public function getOffset() {
    return $this->offset;
  }
}
