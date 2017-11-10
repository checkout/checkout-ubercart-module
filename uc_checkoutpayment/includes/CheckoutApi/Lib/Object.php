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
 * CheckoutapiLibObject.
 *
 * This class is a base class for the other class.
 * It provide common feature that exist between other classes.
 *
 * @category Lib
 * @version Release: @package_version@
 */
class CheckoutapiLibObject implements ArrayAccess {

  /**
   * Config.
   *
   * @var array
   *   An array that containt all configuration for a class.
   */
  protected $config = array();

  /**
   * Method that get the configuration for an object.
   *
   * @param mixed|null $key
   *   Name of configuration you want to retrive.
   *
   * @return array|null
   *   A array with configuration settings.
   */
  public function getConfig($key = NULL) {
    if ($key != NULL && isset($this->config[$key])) {

      return $this->config[$key];

    }
    elseif ($key == NULL) {

      return $this->config;

    }

    return NULL;

  }

  /**
   * Settter it get an array and update or add configuration value to object.
   *
   * @param array $config
   *   Configuration value.
   *
   * @throws Exception
   */
  public function setConfig(array $config = array()) {

    if (is_array($config)) {

      if (!empty($config)) {
        foreach ($config as $key => $value) {

          $this->config[$key] = $value;
        }
      }

    }
    else {

      throw new Exception("Invalid parameter");
    }

  }

  /**
   * Reset config attribute.
   *
   * @return $this
   */
  public function resetConfig() {
    $this->config = array();
    return $this;

  }

  /**
   * Setting and logging error message.
   *
   * @param string $errorMsg
   *   Error message you wan to log.
   * @param array $trace
   *   Stack trace.
   * @param bool $error
   *   State of the error. TRUE for important error.
   *
   * @return mixed
   *   The Response.
   *
   * @throws Exception
   */
  public function exception($errorMsg, array $trace, $error = TRUE) {
    $classException = "CheckoutapiLibExceptionstate";

    if (class_exists($classException)) {

      // @var CheckoutapiLibExceptionstate
      $class = CheckoutapiLibFactory::getSingletonInstance($classException);

    }
    else {

      throw new Exception("Not a valid class ::  CheckoutapiLibExceptionstate");

    }

    $class->setLog($errorMsg, $trace, $error);

    return $class;

  }

  /**
   * Reset the attribute config for an object.
   *
   * @throws Exception
   */
  public function flushState() {
    $classException = "CheckoutapiLibExceptionstate";

    if (class_exists($classException)) {
      // @var CheckoutapiLibExceptionstate
      $class = CheckoutapiLibFactory::getSingletonInstance($classException);
    }
    else {
      throw new Exception("Not a valid class ::  CheckoutapiLibExceptionstate");
    }
    $class->flushState();

  }

  /**
   * Get Singleton Instance of CheckoutapiLibExceptionstate object.
   *
   * @return CheckoutapiLibExceptionstate|null
   *   Returns the exception state of the instance.
   *
   * @throws Exception
   */
  public function getExceptionstate() {
    $classException = "CheckoutapiLibExceptionstate";
    $class = NULL;
    if (class_exists($classException)) {
      // @var CheckoutapiLibExceptionstate
      $class = CheckoutapiLibFactory::getSingletonInstance($classException);

    }

    return $class;

  }

  /**
   * Offset set.
   *
   * @param mixed $offset
   *   Var for offset.
   * @param mixed $value
   *   Var for value.
   */
  public function offsetSet($offset, $value) {
    if (is_null($offset)) {
      $this->config[] = $value;
    }
    else {
      $this->config[$offset] = $value;
    }
  }

  /**
   * Offset exists.
   *
   * @param mixed $offset
   *   Var for offset.
   */
  public function offsetExists($offset) {
    return isset($this->config[$offset]);

  }

  /**
   * OffsetUnset.
   *
   * @param mixed $offset
   *   Var for offset.
   */
  public function offsetUnset($offset) {
    unset($this->config[$offset]);
  }

  /**
   * OffsetGet.
   *
   * @param mixed $offset
   *   Var for offset.
   */
  public function offsetGet($offset) {
    return isset($this->config[$offset]) ? $this->config[$offset] : NULL;
  }

}
