<?php

/**
 * Checkout.com Apiservices\Customers\Responsemodels\Customercreate.
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
 * Class Customer Create.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Customercreate extends Basecustomer {
  protected $baseCardcreate;

  /**
   * Get the base card create object.
   *
   * @return mixed
   *   The baseCardcreate.
   */
  public function getBasecardcreate() {
    return $this->baseCardcreate;
  }

  /**
   * Set the base card create object.
   *
   * @param mixed $baseCardcreate
   *   The baseCardcreate.
   */
  public function setBasecardcreate(
    \com\checkout\Apiservices\Cards\Requestmodels\Basecardcreate $baseCardcreate
  ) {
    $this->baseCardcreate = $baseCardcreate;
  }
}
