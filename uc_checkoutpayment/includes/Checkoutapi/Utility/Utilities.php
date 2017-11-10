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
 * CheckoutapiUtilityUtilities.
 *
 * A small utility class to wrap some of php function.
 *
 * @category Utility
 * @version Release: @package_version@
 */
final class CheckoutapiUtilityUtilities {

  /**
   * Checkoutapi check if a php extension is loaded.
   *
   * @param mixed $extension
   *   The extension name.
   *
   * @return bool
   *   The extension.
   */
  public static function checkExtension($extension) {
    return extension_loaded($extension);

  }

  /**
   * Checkoutapi print on screen any value given to it.
   *
   * @param mixed $toPrint
   *   Object or array to print.
   */
  public static function dump($toPrint) {
    echo '<pre>';
    print_r($toPrint);
    echo '</pre>';
  }

}
