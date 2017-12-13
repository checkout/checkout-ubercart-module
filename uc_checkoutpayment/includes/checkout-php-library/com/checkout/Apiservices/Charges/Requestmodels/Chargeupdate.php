<?php

/**
 * Checkout.com Apiservices\Charges\Requestmodels\Chargeupdate.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Charges\Requestmodels;

/**
 * Class Charge Update.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Chargeupdate {
  private $chargeId;
  private $description;
  private $metadata = array();

  /**
   * Get the string that uniquely identifies the transaction.
   *
   * Note: The card id is prefixed with charge_.
   *
   * @return mixed
   *   The chargeId.
   */
  public function getChargeId() {
    return $this->chargeId;
  }

  /**
   * Set the string that uniquely identifies the transaction.
   *
   * Note: The card id is prefixed with charge_.
   *
   * @param mixed $id
   *   The chargeId.
   */
  public function setChargeId($chargeId) {
    $this->chargeId = $chargeId;
  }

  /**
   * Get a description that can be added to this object.
   *
   * @return mixed
   *   The description.
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Set a description that can be added to this object.
   *
   * @param mixed $description
   *   The description.
   */
  public function setDescription($description) {
    $this->description = $description;
  }

  /**
   * Get a hash of FieldName and value pairs.
   *
   * A hash of FieldName and value pairs e.g. {'keys1': 'Value1'}.
   * Max length of key(s) and value(s) is 100 each. A max. of 10 KVP are allowed.
   *
   * @return mixed
   *   The metadata.
   */
  public function getMetadata() {
    return $this->metadata;
  }

  /**
   * Set a hash of FieldName and value pairs.
   *
   * A hash of FieldName and value pairs e.g. {'keys1': 'Value1'}.
   * Max length of key(s) and value(s) is 100 each. A max. of 10 KVP are allowed.
   *
   * @param mixed $metadata
   *   The metadata.
   */
  public function setMetadata($metadata) {
    $this->metadata = $metadata;
  }

}
