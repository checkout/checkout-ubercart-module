<?php

/**
 * Checkout.com Apiservices\Sharedmodels\Okresponse.
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
 * Class Okresponse.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Okresponse extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  /**
   * Class constructor.
   *
   * @param null $response
   *   The response model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setMessage($response->getMessage());
  }

  protected $message;

  /**
   * Get the message.
   *
   * @return mixed
   *   The message.
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   * Set the message.
   *
   * @param mixed $message
   *   The message.
   */
  public function setMessage($message) {
    $this->message = $message;
  }
}
