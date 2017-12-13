<?php

/**
 * Checkout.com Apiservices\Paymentproviders\Responsemodels\Region.
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
 * Class Region.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Region extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  private $regionId;
  private $name;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setName($response->getName());
    $this->setRegionId($response->getRegionId());
  }

  /**
   * Set the name of the region.
   *
   * @param mixed $name
   *   The region name.
   */
  private function setName($name) {
    $this->name = $name;
  }

  /**
   * Set the id of the region.
   *
   * @param mixed $regionId
   *   The region id.
   */
  private function setRegionId($regionId) {
    $this->regionId = $regionId;
  }
}
