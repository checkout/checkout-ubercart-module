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
 * Parser to handle JSON.
 *
 * @category Parser
 * @version Release: @package_version@
 */
class CheckoutapiParserJSON extends CheckoutapiParserParser {

  /**
   * Prefilled header array.
   *
   * @var array
   */
  protected $headers = array(
    'Content-Type: application/json;charset=UTF-8',
    'Accept: application/json',
  );

  /**
   * Convert a json to a CheckoutapiLibRespondobj object.
   *
   * @param JSON $parser
   *   A JSON string.
   *
   * @return CheckoutapiLibRespondobj|null
   *   A an object converted from the JSON string.
   *
   * @throws Exception
   */
  public function parseToObj($parser) {

    // @var CheckoutapiLibRespondobj $respondObj
    $respondObj = CheckoutapiLibFactory::getInstance(
      'CheckoutapiLibRespondobj'
    );

    if ($parser && is_string($parser)) {
      $encoding = mb_detect_encoding($parser);

      if ($encoding == "ASCII") {
        $parser = iconv('ASCII', 'UTF-8', $parser);
      }
      else {
        $parser = mb_convert_encoding($parser, "UTF-8", $encoding);
      }

      $jsonObj = json_decode($parser, TRUE);
      $jsonObj['rawOutput'] = $parser;

      $respondObj->setConfig($jsonObj);

    }
    $respondObj->setConfig($this->getResourceInfo());
    return $respondObj;

  }

  /**
   * Prepares posted values, so they match the header of the parser.
   *
   * @param mixed $postedParam
   *   The array or object.
   *
   * @return JSON
   *   A JSON encoded array.
   */
  public function preparePosted($postedParam) {
    return json_encode($postedParam);
  }

  /**
   * Set the resource info.
   *
   * @param mixed $info
   *   The info array.
   */
  public function setResourceInfo($info) {
    $this->info = $info;
  }

}
