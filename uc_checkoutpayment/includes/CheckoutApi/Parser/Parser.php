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
 * The basic functionally all parsers need to inherit.
 *
 * @category Parser
 * @version Release: @package_version@
 */
abstract class CheckoutapiParserParser extends CheckoutapiLibObject {

  /**
   * Headers.
   *
   * @var array
   *   Array to hold value for headers to be send by the transport layer.
   */
  protected $headers = array();

  /**
   * Response object.
   *
   * @var object
   *   Null|CheckoutapiLibRespondobj Checkoutapi.
   */
  protected $respondObj = NULL;
  protected $info = array('httpStatus' => 0);

  /**
   * It takes a string, parse it and then map it to an object.
   *
   * This method need to be implemented by all children.
   *
   * @param mixed $parser
   *   A string to mchange into an object.
   *
   * @return CheckoutapiLibRespondobj
   *   A CheckoutapiLibRespondobj.
   */
  abstract public function parseToObj($parser);

  /**
   * Setter respondObj.
   *
   * @param object $obj
   *   A CheckoutapiLibRespondobj.
   */
  public function setRespondobj($obj) {
    $this->respondObj = $obj;
  }

  /**
   * Getter respondObj.
   *
   * @return CheckoutapiLibRespondobj|null
   *   A CheckoutapiLibRespondobj.
   */
  public function getRespondobj() {
    return $this->respondObj;
  }

  /**
   * Getter headers.
   *
   * @return array
   *   An array with the header information.
   */
  public function getHeaders() {
    return $this->headers;
  }

  /**
   * Format the value base on the parser type.
   *
   * @param mixed $postedParam
   *   The array to prepare for posting.
   *
   * @return mixed
   *   A mixed the prepared array or object.
   */
  abstract public function preparePosted($postedParam);

  /**
   * Set Resource Info.
   *
   * @param mixed $info
   *   The info of the recource.
   *
   * @return mixed
   *   An bool to exert succes.
   */
  abstract public function setResourceInfo($info);

  /**
   * Get Resource Info.
   *
   * @return array
   *   An array with the resource info.
   */
  public function getResourceInfo() {
    return $this->info;
  }

}
