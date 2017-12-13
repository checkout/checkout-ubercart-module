<?php

/**
 * Checkout.com Apiservices\Sharedmodels\Descriptor.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Sharedmodels;

/**
 * Class Descriptor.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Descriptor {
  protected $name;
  protected $city;

  /**
   * Get the descriptor name.
   *
   * @return mixed
   *   The name.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set the descriptor name.
   *
   * @param mixed $name
   *   The name.
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Get the descriptor city.
   *
   * @return mixed
   *   The city.
   */
  public function getCity() {
    return $this->city;
  }

  /**
   * Set the descriptor city.
   *
   * @param mixed $city
   *   The city.
   */
  public function setCity($city) {
    $this->city = $city;
  }
}
