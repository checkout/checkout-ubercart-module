<?php

/**
 * CheckoutapiClientAdapterAbstract.
 *
 * PHP Version 5.6
 *
 * @category Api
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

/**
 * CheckoutapiClientAdapterAbstract.
 *
 * CheckoutapiClientAdapterAbstract.
 * An abstract class for CheckoutapiClient adapters.
 * An adapter can be define a method of transmitting message over http protocol.
 * It encapsulate all basic and core method required by an adpater.
 *
 * @category Client
 * @version Release: @package_version@
 */
abstract class CheckoutapiClientAdapterAbstract extends CheckoutapiLibObject {
  /**
   * The URL.
   *
   * @var string
   */
  protected $uri = NULL;

  /**
   * The resource.
   *
   * @var resource|null
   */
  protected $resource = NULL;

  /**
   * The respond object.
   *
   * @var mixed
   */
  protected $respond = NULL;

  /**
   * Constructor for Adapters.
   *
   * @param array $arguments
   *   Array of configuration for constructor.
   *
   * @throws Exception
   */
  public function __construct(array $arguments = array()) {
    if (isset($arguments['uri']) && $uri = $arguments['uri']) {
      $this->setUri($uri);
    }

    if (isset($arguments['config']) && $config = $arguments['config']) {

      $this->setConfig($config);
    }

  }

  /**
   * Set/Get attribute wrapper.
   *
   * @param string $method
   *   Method being call.
   * @param array $args
   *   Argument being pass.
   *
   * @return mixed
   *   A mixed .
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
        $result = $this->setConfig($key, isset($args[0]) ? $args[0] : NULL);

        return $result;

    }

    $this->exception(
      "Invalid method " . get_class(
        $this
      ) . "::" . $method . "(" . print_r(
        $args,
        1
      ) . ")",
      debug_backtrace()
    );

    return NULL;

  }

  /**
   * Setter for $uri.
   *
   * @param string $uri
   *   Setting the url value.
   */
  public function setUri($uri) {

    $this->uri = $uri;
  }

  /**
   * Getter for $uri.
   *
   * @return string
   *   Return the URL.
   */
  public function getUri() {
    return $this->uri;

  }

  /**
   * Setter for $resource.
   *
   * @param resource $resource
   *   The resource.
   */
  public function setResource($resource) {
    $this->resource = $resource;
  }

  /**
   * Getter for $resource.
   *
   * @return resource
   *   The resource.
   */
  public function getResource() {
    return $this->resource;

  }

  /**
   * Setter for respond.
   *
   * @param mixed $respond
   *   Responds obtained by gateway.
   */
  public function setRespond($respond) {
    $this->respond = $respond;
  }

  /**
   * Getter for respond.
   *
   * @return mixed
   *   The response.
   */
  public function getRespond() {
    return $this->respond;

  }

  /**
   * Create a connection using the adapter.
   *
   * @return object
   *   CheckoutapiClientAdapterAbstract.
   */
  public function connect() {
    return $this;

  }

  /**
   * Close all resource.
   */
  public function close() {
    $this->setResource(NULL);
    $this->setRespond(NULL);
  }

  /**
   * Gey the resource info.
   *
   * @return array
   *   Array with an empty httpStatus attribute.
   */
  public function getResourceInfo() {
    return array('httpStatus' => '');

  }

  /**
   * Return request made by the adapter.
   *
   * @return CheckoutapiLibRespondobj
   *   A CheckoutapiLibRespondobj.
   */
  abstract public function request();

}
