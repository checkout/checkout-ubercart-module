<?php

/**
 * Checkout.com Apiservices\Cards\Responsemodels\CardList.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Cards\Responsemodels;

/**
 * Class Card List.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardlist extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
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
  private function setData($data) {
    $arrayData = $data->toArray();
    foreach ($arrayData as $card) {
      $this->data[] = $this->getCard($card);
    }
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
   * Set an object.
   *
   * @param int $object
   *   The object.
   */
  private function setObject($object) {
    $this->object = $object;
  }

  /**
   * Get a card.
   *
   * @param mixed $card
   *   The card object.
   *
   * @return mixed
   *   A card object.
   */
  private function getCard($card) {
    $dummyObjCart = new \Checkoutapi_LibrespondObj();
    $dummyObjCart->setConfig($card);
    $cardObg = new \com\checkout\Apiservices\Cards\Responsemodels\Card(
      $dummyObjCart
    );
    return $cardObg;
  }
}
