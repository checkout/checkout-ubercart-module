<?php

/**
 * Checkout.com Apiservices\Customers\Responsemodels\Customerlist.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Customers\Responsemodels;

/**
 * Class Customer List.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Customerlist extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  private $object;
  private $count;
  private $data;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setCount($response->getCount());
    $this->setData($response->getData());
    $this->setObject($response->getObject());
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
   * Get an object.
   *
   * @return int
   *   The object.
   */
  public function getObject() {
    return $this->object;
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
    foreach ($dataArray as $customer) {
      $this->data[] = $this->getCustomer($customer);
    }
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
   * Get the customer.
   *
   * @return mixed
   *   The customer.
   */
  private function getCustomer($customer) {
    $dummyObjCart = new \Checkoutapi_LibrespondObj();
    $dummyObjCart->setConfig($customer);
    $cardObg = new Customer($dummyObjCart);
    return $cardObg;
  }

}
