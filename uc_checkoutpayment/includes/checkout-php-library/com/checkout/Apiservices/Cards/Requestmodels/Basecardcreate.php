<?php

/**
 * Checkout.com Apiservices\Cards\Requestmodels\BaseCardCreate.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Cards\Requestmodels;

/**
 * Class Base Card Creates.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Basecardcreate extends Basecard {
  protected $number;
  protected $cvv;

  /**
   * Get a card number.
   *
   * @return mixed
   *   The number.
   */
  public function getNumber() {
    return $this->number;
  }

  /**
   * Set a card number.
   *
   * @param mixed $number
   *   The number.
   */
  public function setNumber($number) {
    $this->number = $number;
  }

  /**
   * Get a Card security code.
   *
   * Four-digits for Amex, three-digits for all other cards.
   *
   * @return mixed
   *   The cvv.
   */
  public function getCvv() {
    return $this->cvv;
  }

  /**
   * Set a Card security code.
   *
   * Four-digits for Amex, three-digits for all other cards.
   *
   * @param mixed $cvv
   *   The cvv.
   */
  public function setCvv($cvv) {
    $this->cvv = $cvv;
  }
}
