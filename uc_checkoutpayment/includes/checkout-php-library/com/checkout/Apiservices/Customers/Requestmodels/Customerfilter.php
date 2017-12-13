<?php

/**
 * Checkout.com Apiservices\Customers\Responsemodels\Customerfilter.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Customers\Requestmodels;

/**
 * Class Customer Filter.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Customerfilter {
  private $count;
  private $offset;
  private $created;

  /**
   * Get the UTC date and time based on ISO 8601 profile.
   *
   * @return mixed
   *   The created date.
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * Set the UTC date and time based on ISO 8601 profile.
   *
   * @param mixed $created
   *   The created date.
   */
  public function setCreated($created) {
    $this->created = $created;
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
   * Set the page offset.
   *
   * @param mixed $offset
   *   The page offset.
   */
  public function setOffset($offset) {
    $this->offset = $offset;
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
   * Set the page count.
   *
   * @param mixed $requestModel
   *   The page count.
   */
  public function setCount($count) {
    $this->count = $count;
  }
}
