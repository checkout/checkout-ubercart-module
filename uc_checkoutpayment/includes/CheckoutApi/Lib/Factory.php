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
 * Class that given a class name, it generate the coresponding object.
 *
 * @category Lib
 * @version Release: @package_version@
 */
final class CheckoutapiLibFactory extends CheckoutapiLibObject {

  /**
   * Registry.
   *
   * @var array
   *   An array holding instance of object.
   */
  private static $registry = array();

  /**
   * Get an instance.
   *
   * Simple usage:
   *   CheckoutapiLibFactory::getInstance('CheckoutapiClientClientgw3');
   *
   * @param string $className
   *   The name of the class which you want to initialise.
   * @param array $arguments
   *   Agruments to initialise the object.
   *
   * @return mixed
   *   Checkoutapi create instance.
   */
  public static function getInstance($className, array $arguments = array()) {
    return new $className($arguments);
  }

  /**
   * This helper method create a singleton object.
   *
   * Given the name of the class.
   * Simple usage:
   *   CheckoutapiLibFactory::getSingletonInstance('CheckoutapiClientClientgw3')
   *
   * @param mixed $className
   *   The classname.
   * @param array $arguments
   *   Argument for class constructor.
   *
   * @return mixed
   *   The return.
   *
   * @throws Exception
   */
  public static function getSingletonInstance(
      $className,
      array $arguments = array()
    ) {
    $registerKey = $className;

    if (!isset(self::$registry[$registerKey])) {
      if (class_exists($className)) {
        self::$registry[$registerKey] = new $className($arguments);
      }
      else {
        error_log($className, 0);
        throw new Exception(
          'Invalid class name:: ' . $className . "(" . print_r(
            $arguments,
            1
          ) . ')'
        );
      }
    }

    return self::$registry[$registerKey];

  }

}
