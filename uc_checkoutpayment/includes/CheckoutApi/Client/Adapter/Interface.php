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
 * This class is used as signature for all current and future adapters.
 *
 * @category Client
 * @version Release: @package_version@
 */
interface CheckoutapiClientAdapterInterface {

  /**
   * Checkoutapi Read respond on the server.
   *
   * @return object
   *   Return confirmation.
   */
  public function request();

  /**
   * Checkoutapi Close all open connections and release all set variables.
   */
  public function close();

  /**
   * Checkoutapi Open a connection to server/URI.
   *
   * @return resource
   *   Return the recources.
   */
  public function connect();

  /**
   * Get parameter $config value.
   *
   * @param array $array
   *   Config array.
   *
   * @return mixed
   *   Return confirmation.
   */
  public function setConfig(array $array = array());

  /**
   * Return parameter value in $config variable.
   *
   * @param string $key
   *   Config name to retrive.
   *
   * @return mixed
   *   Return confirmation.
   */
  public function getConfig($key = NULL);

}
