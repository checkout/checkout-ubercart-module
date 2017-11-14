<<?php

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
 * CheckoutapiLibRespondobj.
 *
 * This class is responsible of mapping anytime of respond into an object
 * With attribute and magic getters.
 *
 * @category Lib
 * @version Release: @package_version@
 */
class CheckoutapiLibRespondobj implements ArrayAccess {
  /**
   * Configuration.
   *
   * @var array
   *   Configuration value
   */
  protected $config = array();

  /**
   * Update Config.
   *
   * @var array
   *   UpdateConfig value
   */
  protected $updateConfig = array();

  /**
   * Call method.
   *
   * Method that capures all getter or setters and use them to
   * Either set or get value from attribute config.
   *
   * @param string $method
   *   A var for method.
   * @param array $args
   *   A var for args.
   *
   * @throws Exception
   *   Checkoutapi a php magical method.
   *
   * @example http://php.net/manual/en/language.oop5.overloading.php#object.call
   */
  public function __call($method, array $args) {
    switch (substr($method, 0, 3)) {
      case 'get':
        $key = substr($method, 3);
        $key = lcfirst($key);
        $data = $this->getConfig($key, isset($args[0]) ? $args[0] : NULL);
        return $data;

      case 'set':
        $key = substr($method, 3);
        $key = lcfirst($key);
        $this->updateConfig[$key] = $args[0];
        return $args[0];

      case 'has';
        $key = substr($method, 3);
        $key = lcfirst($key);
        $data = $this->getConfig($key);
        return $data ? TRUE : FALSE;

    }

    throw new Exception(
      "Respond does not support this method " . $method . "(" . print_r(
        $args,
        1
      ) . ")"
    );
  }

  /**
   * This method return value from the attribute config.
   *
   * @param string|null $key
   *   Attribute you want to retrive.
   * @param array|null $args
   *   Attribute you want to retrive.
   *
   * @return array|CheckoutapiLibRespondobj|null
   *   Returns an array or object of the config is set.
   *
   * @throws Exception
   */
  private function getConfig($key = NULL, $args = NULL) {
    if ($key != NULL) {

      $value = NULL;
      if (isset($this->config[$key])) {
        $value = $this->config[$key];
      }
      elseif (isset($this->updateConfig[$key])) {
        $value = $this->updateConfig[$key];
      }

      if (isset($args["returnAsArray"]) && $args["returnAsArray"]) {

        // @return mixed The response as an array.
        if (is_array($value)) {
          return $value;
        }
      }
      elseif (is_array($value)) {
        // @var CheckoutapiLibRespondobj.
        $to_return = CheckoutapiLibFactory::getInstance(
          'CheckoutapiLibRespondobj'
        );
        $to_return->setConfig($value);
        return $to_return;
      }
      return $value;
    }

    if ($key == NULL) {
      return $this->config;
    }
    return NULL;
  }

  /**
   * This method set the config value for an object.
   *
   * @param array $config
   *   Configuration to be set.
   *
   * @throws Exception
   */
  public function setConfig(array $config = array()) {

    if (is_array($config)) {

      if (!empty($config)) {
        foreach ($config as $key => $value) {

          if (!isset($this->config[$key])) {
            $this->config[$key] = $value;
          }
        }
      }

    }
    else {

      throw new Exception(
        "Invalid parameter (" . print_r(
          $config,
          1
        ) . ")"
      );
    }

  }

  /**
   * Check if respond obj is valid.
   *
   * @return bool
   *   True if the object is valid.
   *
   * @throws Exception
   */
  public function isValid() {
    // @var CheckoutapiLibExceptionstate.
    $exceptionState = CheckoutapiLibFactory::getSingletonInstance(
      'CheckoutapiLibExceptionstate'
    );

    return $exceptionState->isValid();

  }

  /**
   * Print error.
   *
   * Print all error log by the CheckoutapiLibExceptionstate
   * object for the current request.
   *
   * @param bool $print
   *   A var for print.
   *
   * @return string
   *   Error an string of errors Checkoutapi print the error.
   *
   * @throws Exception
   */
  public function printError($print = TRUE) {

    // @var CheckoutapiLibExceptionstate.
    $exceptionState = CheckoutapiLibFactory::getSingletonInstance(
      'CheckoutapiLibExceptionstate'
    );
    $error = $exceptionState->debug();
    $exceptionState->flushState();
    if ($print) {
      echo $error;
    }
    return $error;

  }

  /**
   * Return an instance of CheckoutapiLibExceptionstate.
   *
   * @return CheckoutapiLibExceptionstate|null
   *   Return the exception state.
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
   * Return all configuration value for an object.
   *
   * @return array
   *   Config value.
   */
  public function toArray() {
    return $this->getConfig();
  }

  /**
   * OffsetSet.
   *
   * @param mixed $offset
   *   The mixed variable with the offset.
   * @param mixed $value
   *   The mixed variable with the value.
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
   * OffsetExists.
   *
   * @param mixed $offset
   *   The variable with the offset.
   *
   * @return bool
   *   True if offset is set.
   */
  public function offsetExists($offset) {
    return isset($this->config[$offset]);
  }

  /**
   * OffsetUnset.
   *
   * @param mixed $offset
   *   The variable with the offset.
   */
  public function offsetUnset($offset) {
    unset($this->config[$offset]);
  }

  /**
   * OffsetGet.
   *
   * @param mixed $offset
   *   The variable with the offset.
   *
   * @return mixed
   *   Return the offset.
   */
  public function offsetGet($offset) {
    return isset($this->config[$offset]) ? $this->config[$offset] : NULL;
  }

}
