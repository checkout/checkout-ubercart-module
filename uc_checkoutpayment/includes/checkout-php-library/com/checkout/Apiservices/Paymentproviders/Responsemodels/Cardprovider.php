<?php

/**
 * Checkout.com Apiservices\Paymentproviders\Responsemodels\Cardprovider.
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
 * Class Card Provider.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardprovider extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  private $id;
  private $name;

  /**
   * Class constructor.
   *
   * @param mixed $response
   *   The request model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setId($response->getId());
    $this->setName($response->getName());
  }

  /**
   * Set the provider ID.
   *
   * @param mixed $id
   *   The provider id.
   */
  protected function setId($id) {
    $this->id = $id;
  }

  /**
   * Set the provider name.
   *
   * @param mixed $name
   *   The provider name.
   */
  protected function setName($name) {
    $this->name = $name;
  }

  /**
   * Get the provider ID.
   *
   * @return mixed
   *   The provider id.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get the provider name.
   *
   * @return mixed
   *   The provider name.
   */
  public function getName() {
    return $this->name;
  }

}
