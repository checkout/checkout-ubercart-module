<?php

/**
 * Checkout.com Apiservices\Visacheckout\Responsemodels\Visacheckoutcardtoken.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Visacheckout\Responsemodels;

/**
 * Class Visa Checkout Card Token.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Visacheckoutcardtoken {
  private $object;
  private $id;
  private $liveMode;
  private $created;
  private $used;
  private $card;
  private $binData;

  public function __construct($response) {
    $this->setCard($response->getCard());
    $this->setCreated($response->getCreated());
    $this->setId($response->getId());
    $this->setLiveMode($response->getLiveMode());
    $this->setObject($response->getObject());
    $this->setUsed($response->getUsed());
    if ($response->getBindata() != null) {
      $this->setBindata($response->getBindata());
    }
  }

  /**
   * Set a card.
   *
   * @param mixed $card
   *   The card.
   */
  private function setCard($card) {

    $cardObg = new \com\checkout\Apiservices\Cards\Responsemodels\Card($card);
    $this->card = $cardObg;

  }

  /**
   * Set the bin data.
   *
   * @param mixed $binData
   *   The binData.
   */
  private function setBindata($binData) {
    $binDataObg = new \com\checkout\Apiservices\Sharedmodels\Bindata();

    $binDataObg->setBin($binData->getBin());
    $binDataObg->setObject($binData->getObject());
    $binDataObg->setIssuerCountryISO2($binData->getIssuerCountryISO2());
    $binDataObg->setCardType($binData->getCardType());
    $this->binData = $binDataObg;

  }

  /**
   * Set the UTC date and time based on ISO 8601 profile.
   *
   * @param mixed $created
   *   The created date.
   */
  private function setCreated($created) {
    $this->created = $created;
  }

  /**
   * Set the id.
   *
   * @param mixed $id
   *   The id.
   */
  private function setId($id) {
    $this->id = $id;
  }

  /**
   * Set the live mode.
   *
   * Defined as true if live keys were used in the request.
   * Defined as false if test keys were used in the request.
   *
   * @param mixed $liveMode
   *   The LiveMode.
   */
  private function setLiveMode($liveMode) {
    $this->liveMode = $liveMode;
  }

  /**
   * Set an object.
   *
   * @param int $object
   *   The object.
   */
  private function setObject($object) {
    $this->object = $object;
  }

  /**
   * Set the used variable, whatever this is.
   * 
   * @param mixed $used
   *   The used variable.
   */
  private function setUsed($used) {
    $this->used = $used;
  }

  /**
   * Get a card.
   *
   * @return mixed
   *   The card.
   */
  public function getCard() {
    return $this->card;
  }

  /**
   * Get the UTC date and time based on ISO 8601 profile.
   *
   * @return mixed
   *   The created date.
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * Get the uniquely identifier.
   *
   * @return mixed
   *   The id.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get the live mode.
   *
   * Defined as true if live keys were used in the request.
   * Defined as false if test keys were used in the request.
   *
   * @return mixed
   *   The LiveMode.
   */
  public function getLiveMode() {
    return $this->liveMode;
  }

  /**
   * Get an object.
   *
   * @return mixed
   *   The object.
   */
  public function getObject() {
    return $this->object;
  }

  /**
   * Get the used variable, whatever this is.
   * 
   * @return mixed
   *   The used variable.
   */
  public function getUsed() {
    return $this->used;
  }

  /**
   * Get the bin data.
   *
   * @return mixed
   *   The binData.
   */
  public function getBindata() {
    return $this->binData;
  }

}
