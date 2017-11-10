<?php

/**
 * CheckoutapiApi.
 *
 * PHP Version 5.6
 *
 * @category Api
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

/**
 * CheckoutapiLibValidator.
 *
 * Class for validation.
 *
 * @category Lib
 * @version Release: @package_version@
 */
class CheckoutapiLibValidator extends CheckoutapilibObject {

  /**
   * Helper method that check if variable is empty.
   *
   * Simple usage:
   *   CheckoutapiLibValidator::isEmpty($var)
   *
   * @param mixed $var
   *   A var for var.
   *
   * @return bool
   *   Tryue if the var is empty.
   */
  public static function isEmpty($var) {
    $toReturn = FALSE;

    if (is_array($var) && empty($var)) {
      $toReturn = TRUE;
    }

    if (is_string($var) && ($var == '' || is_null($var))) {
      $toReturn = TRUE;
    }

    if (is_int($var) && ($var == '' || is_null($var))) {
      $toReturn = TRUE;
    }

    if (is_float($var) && ($var == '' || is_null($var))) {
      $toReturn = TRUE;
    }

    return $toReturn;

  }

  /**
   * Helper method that check if $int integer.
   *
   * Simple usage:
   *   CheckoutapiLibValidator::isInteger($int)
   *
   * @param mixed $int
   *   A var for int.
   *
   * @return bool
   *   True if var is integer.
   */
  public static function isInteger($int) {
    return is_int($int);

  }

  /**
   * Helper method that check if $string is a string.
   *
   * Simple usage:
   *   CheckoutapiLibValidator::isString($var).
   *
   * @param mixed $string
   *   A variable which could be a string.
   *
   * @return bool
   *   True if var is a string.
   */
  public static function isString($string) {
    return is_string($string);

  }

  /**
   * Helper method that check if $string is a float.
   *
   * Simple usage:
   *   CheckoutapiLibValidator::isFloat($string).
   *
   * @param mixed $string
   *   A var for string.
   *
   * @return bool
   *   True if var is a float.
   */
  public static function isFloat($string) {
    return is_float($string);

  }

  /**
   * Helper method that check if $email is a valid email.
   *
   * @param mixed $email
   *   A var for email.
   *
   * @return int
   *   Checkoutapi validate email.
   *
   * @todo Find a better regex or build one for validate email.
   */
  public static function isValidEmail($email) {
    $emailReg = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/";
    $email = strtolower($email);
    return preg_match($emailReg, $email);

  }

  /**
   * Helper method that check if string match length.
   *
   * @param string $var
   *   A variable which has a certain length.
   * @param int $length
   *   The length you want to be checked.
   *
   * @return bool
   *   True if var is the same length as length.
   */
  public static function isLength($var, $length) {

    if (is_array($var)) {
      return count($var) == $length;

    }
    else {
      return strlen($var) == $length;

    }

  }

  /**
   * Helper method that check if ccv is in correct format.
   *
   * @param string $cvv
   *   A var for cvv.
   *
   * @return bool
   *   True if var is a formatted CVV.
   */
  public static function isValidCvvLen($cvv) {
    $pattern = '/^[0-9]{3,4}$/';
    return preg_match($pattern, $cvv) ? TRUE : FALSE;
  }

}
