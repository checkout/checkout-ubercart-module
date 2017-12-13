<?php

/**
 * Checkout.com Apiservices\Paymentproviders\Requestmodels\Cardprovidermodel.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Paymentproviders\Requestmodels;

/**
 * Class Card Provider Model.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardprovidermodel {
  protected $id;

  /**
   * Get the id.
   *
   * @return mixed
   *   The id.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set the id.
   *
   * @param mixed $id
   *   The id.
   */
  public function setId($id) {
    $this->id = $id;
  }

}
