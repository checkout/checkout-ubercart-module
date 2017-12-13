<?php

/**
 * Checkout.com Apiservices\Sharedmodels\Deleteresponse.
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
 * Class Delete Response.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Deleteresponse extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  private $delete;
  private $id;

  /**
   * Class constructor.
   *
   * @param null $response
   *   The response model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setDelete($response->getDeleted());
    $this->setId($response->getId());
  }

  /**
   * Get a delete object.
   *
   * @return mixed
   *   The delete.
   */
  public function getDelete() {
    return $this->delete;
  }

  /**
   * Set a delete object.
   *
   * @param mixed $delete
   *   The delete.
   */
  private function setDelete($delete) {
    $this->delete = $delete;
  }

  /**
   * Get the uniquely identifier of the deleted object.
   *
   * @return mixed
   *   The id.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set the uniquely identifier of the deleted object.
   *
   * @param mixed $id
   *   The id.
   */
  private function setId($id) {
    $this->id = $id;
  }
}
