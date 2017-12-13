<?php

/**
 * Checkout.com Apiservices\Tokens\Requestmodels\Cardtokencreate.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Tokens\Requestmodels;

/**
 * Class Card Token Create.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardtokencreate extends Basecharge {
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
  public function setBasecardcreate(Basecardcreate $baseCardcreate) {
    $this->baseCardcreate = $baseCardcreate;
  }
}
