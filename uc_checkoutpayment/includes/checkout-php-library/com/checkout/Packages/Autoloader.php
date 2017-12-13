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

namespace com\checkout\Packages;

/**
 * Class final  CheckoutapiApi.
 *
 * This class is responsible in creating instance of payment gateway interface.
 * (CheckoutapiClientClient).
 *
 * The simplest usage would be:
 *   $Api = CheckoutapiApi::getApi();
 *
 * This will create an instance a singleton instance of CheckoutapiClientClient
 * the default gateway is CheckoutapiClientClientgw3
 *
 * If you need create instance of other gateways, you can do do those steps:
 *   $Api = CheckoutapiApi::getApi(array(),
 *     'CheckoutapiClientClient[GATEWAYNAME]');
 *
 * If you need initialise some configuration before hand:
 *   $config = array('config1' => 'value1', 'config2' => 'value2');
 *   $Api = CheckoutapiApi::getApi($config);
 *
 * @category Utility
 * @version Release: @package_version@
 */
class Autoloader {
  private static $instance;

  /**
   * Get an instance of a class.
   *
   * @return mixed
   *   The instance.
   */
  public static function instance() {
    if (!self::$instance) {
      $class = __class__;
      self::$instance = new $class();
    }
    return self::$instance;
  }

  /**
   * Autoload the instance.
   *
   * @param mixed $class
   *   The class.
   */
  public function autoload($class) {
    $classNameArray = preg_split('/(?=[A-Z])/', $class);
    $includePath = get_include_path();
    set_include_path($includePath);
    $path = '';
    $baseDir = __DIR__;
    if (!preg_match('/PHPUnit/', $class) && !preg_match('/Composer/', $class)) {
      if (!empty($classNameArray) && sizeof($classNameArray) > 1) {

        $path = $baseDir . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $classNameArray) . '.php';
        $path = str_replace('\PHPPlugin\\', '', $path);
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);

        if ($file = stream_resolve_include_path($path)) {
          if (file_exists($file)) {
            include $file;
          }
        }
      }
    }
  }

  /**
   * Register the instance.
   */
  public static function register() {
    spl_autoload_extensions('.php');
    spl_autoload_register(array(self::instance(), 'autoload'));
  }

}

$autoload = new Autoloader();
Autoloader::register();
