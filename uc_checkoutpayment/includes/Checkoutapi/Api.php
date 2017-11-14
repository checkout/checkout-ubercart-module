<?php

/**
 * CheckoutapiApi.
 *
 * PHP Version 5.6
 *
 * @category Checkoutapi
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

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
 * @category Checkoutapi
 * @version Release: @package_version@
 */
final class CheckoutapiApi {

  /**
   * Private Static API Class.
   *
   * @var string
   *   The name of the gateway to be used.
   */
  private static $apiClass = 'CheckoutapiClientClientgw3';

  /**
   * Helper static function to get singleton instance of a gateway interface.
   *
   * @param array $arguments
   *   A set arguments for initialising class constructor.
   * @param null|string $apiClass
   *   Gateway class name.
   *
   * @return CheckoutapiClientClient
   *   An singleton instance of CheckoutapiClientClient
   *
   * @throws Exception
   */
  public static function getApi(array $arguments = array(), $apiClass = NULL) {
    if ($apiClass) {
      self::setApiClass($apiClass);
    }

    // Initialise the exception library.
    $exceptionState = CheckoutapiLibFactory::getSingletonInstance(
      'CheckoutapiLibExceptionstate'
    );
    $exceptionState->setErrorState(FALSE);

    return CheckoutapiLibFactory::getSingletonInstance(
      self::getApiClass(),
      $arguments
    );

  }

  /**
   * Helper static function for setting for $apiClass.
   *
   * @param mixed $apiClass
   *   Gateway interface name.
   */
  public static function setApiClass($apiClass) {
    self::$apiClass = $apiClass;
  }

  /**
   * Helper static function for retriving value of $apiClass.
   *
   * @return CheckoutapiClientClient
   *   A CheckoutapiClientClient for apiClass.
   */
  public static function getApiClass() {
    return self::$apiClass;

  }

}
