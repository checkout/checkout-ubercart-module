<?php

/**
 * Checkout.com Apiservices\Paymentproviders\Responsemodels\Cardproviderlist.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Paymentproviders\Responsemodels;

/**
 * Class Card Provider List.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardproviderlist extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
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
   * Set the list count.
   *
   * @param mixed $count
   *   The list count.
   */
  private function setCount($count) {
    $this->count = $count;
  }

  /**
   * Set an object.
   *
   * @param int $object
   *   The object.
   */
  private function setData($data) {
    $dataArray = $data->toArray();
    foreach ($dataArray as $cardP) {
      $this->data[] = $this->setCardprovider($cardP);
    }
  }

  /**
   * Set the card provider.
   *
   * @param mixed $cardP
   *   The card provider.
   *
   * @return Cardprovider
   *   The return the provider object.
   */
  private function setCardprovider($cardP) {
    $dummyObjCart = new \Checkoutapi_LibrespondObj();
    $dummyObjCart->setConfig($cardP);
    $cardObg = new \PHPPlugin\Apiservices\Paymentproviders\Responsemodels\Cardprovider($dummyObjCart);
    return $cardObg;
  }

  /**
   * Set the list data.
   *
   * @param mixed $data
   *   The list data.
   */
  private function setObject($object) {
    $this->object = $object;
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
   * Set the list data.
   *
   * @param mixed $data
   *   The list data.
   */
  public function getData() {
    return $this->data;
  }

  /**
   * Set an object.
   *
   * @param int $object
   *   The object.
   */
  public function getObject() {
    return $this->object;
  }

}
