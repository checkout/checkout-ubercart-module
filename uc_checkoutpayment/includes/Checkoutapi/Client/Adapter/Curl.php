<?php

/**
 * CheckoutapiApi.
 *
 * PHP Version 5.6
 *
 * @category Api
 * @package Checkoutapi
 *
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

/**
 * His class is an adapter that allow to make call over http protocol via curl.
 *
 * @category Client
 * @version Release: @package_version@
 */
class CheckoutapiClientAdapterCurl extends CheckoutapiClientAdapterAbstract implements CheckoutapiClientAdapterInterface {
  /**
   * Timeout time in minutes.
   *
   * @var int
   */
  private $timeout = 60;

  /**
   * Checkoutapi constructor for curl class.
   *
   * @param array $arguments
   *   Configuration for setting the curl connection.
   *
   * @throws Exception
   */
  public function __construct(array $arguments = array()) {

    if (!CheckoutapiUtilityUtilities::checkExtension('curl')) {
      $this->exception(
        "cURL extension has to be loaded to use CheckoutapiClientAdapterCurl",
        debug_backtrace()
      );

    }

    parent::__construct($arguments);
  }

  /**
   * Method that do a request on provide uri and return itsel.
   *
   * Simple usage:
   *   $adapter->request()->getRespond()
   *
   * @return CheckoutapiClientAdapterCurl
   *   Return self.
   */
  public function request() {

    if (!$this->getResource()) {

      $this->exception("No curl resource was found", debug_backtrace());
    }

    $resource = $this->getResource();
    curl_setopt($resource, CURLOPT_URL, $this->getUri());

    $headers = $this->getHeaders();

    if (!empty($headers)) {
      curl_setopt($resource, CURLOPT_HTTPHEADER, $headers);
    }

    $method = $this->getMethod();

    $curlMethod = '';
    switch ($method) {
      case CheckoutapiClientAdapterConstant::API_POST:
        $curlMethod = CheckoutapiClientAdapterConstant::API_POST;
        break;

      case CheckoutapiClientAdapterConstant::API_GET:
        $curlMethod = CheckoutapiClientAdapterConstant::API_GET;
        break;

      case CheckoutapiClientAdapterConstant::API_DELETE:
        $curlMethod = CheckoutapiClientAdapterConstant::API_DELETE;
        break;

      case CheckoutapiClientAdapterConstant::API_PUT:
        $curlMethod = CheckoutapiClientAdapterConstant::API_PUT;
        break;

      default:
        $this->exception("Method currently not supported", debug_backtrace());
        break;
    }

    if ($curlMethod != CheckoutapiClientAdapterConstant::API_GET) {
      curl_setopt($resource, CURLOPT_CUSTOMREQUEST, $curlMethod);
    }

    if (
      $method == CheckoutapiClientAdapterConstant::API_POST ||
      $method == CheckoutapiClientAdapterConstant::API_PUT
    ) {
      curl_setopt($resource, CURLOPT_POSTFIELDS, $this->getPostedParam());
    }

    curl_setopt($resource, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($resource, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($resource);
    $http_status = curl_getinfo($resource, CURLINFO_HTTP_CODE);

    if ($http_status != 200) {
      $this->exception(
        "An error has occurred while processing your transaction",
        array(
          'respond_code' => $http_status,
          'curl_info' => curl_getinfo($resource),
          'respondBody' => $response,
          'postedParam' => $this->getPostedParam(),
          'rawPostedParam' => $this->getRawpostedParam(),
        )
      );

    }
    elseif (curl_errno($resource)) {
      $info = curl_getinfo($resource);
      $this->exception("Curl issues ", $info);
    }

    $this->setResource($resource);
    $this->setRespond($response);

    return $this;

  }

  /**
   * Getter for the resource info.
   *
   * @return array
   *   Array with resource info.
   */
  public function getResourceInfo() {
    $info = curl_getinfo($this->getResource());

    return array('httpStatus' => $info['http_code']);

  }

  /**
   * Close all open connections and release all set variables.
   */
  public function connect() {
    if ($this->getResource()) {
      $this->close();
    }

    $resource = curl_init();

    curl_setopt($resource, CURLOPT_CONNECTTIMEOUT, $this->getTimeout());

    $this->setResource($resource);
    parent::connect();
    return $this;

  }

  /**
   * Close all open connections and release all set variables.
   */
  public function close() {

    if ($this->getResource()) {
      curl_close($this->resource);
    }

    parent::close();
  }

  /**
   * Return a method type POST|GET|PUT|DELETE.
   *
   * @return string
   *   A string for  default CheckoutapiClientAdapterConstant::API_POST.
   */
  public function getMethod() {
    $method = $this->getConfig('method');

    if (!$method) {
      $method = CheckoutapiClientAdapterConstant::API_POST;
    }

    return $method;

  }

  /**
   * Gateway timeout value.
   *
   * @return int
   *   A int for timeout.
   */
  public function getTimeout() {
    $timeout = $this->timeout;
    if ($this->getConfig('timeout')) {
      $timeout = $this->getConfig('timeout');
    }

    return $timeout;
  }

}
