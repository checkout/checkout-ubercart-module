<?php

/**
 * Checkout.com Apiservices\Reporting\Responsemodels\Chargebacklist.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Reporting\Responsemodels;

/**
 * Class Chargeback List.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Chargebacklist extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
  private $count;
  private $pageNumber;
  private $pageSize;
  private $data;

  /**
   * Class constructor.
   *
   * @param null $response
   *   The response model.
   */
  public function __construct($response) {
    parent::__construct($response);
    $this->setCount($response->getTotalRecords());
    $this->setData($response->getData());
    $this->setPageNumber($response->getPageNumber());
    $this->setPageSize($response->getPageSize());
  }

  /**
   * Get the list count.
   *
   * @return int
   *   The list count.
   */
  public function getCount() {
    return $this->count;
  }

  /**
   * Get the list data.
   *
   * @return mixed
   *   The list data.
   */
  public function getData() {
    return $this->data;
  }

  /**
   * Set the list count.
   *
   * @param mixed $requestModel
   *   The list count.
   */
  private function setCount($count) {
    $this->count = $count;
  }

  /**
   * Set the list data.
   *
   * @param mixed $data
   *   The list data.
   */
  private function setData($data) {
    $chargeBacksArray = $data->toArray();
    $chargeBacksToReturn = array();
    if ($chargeBacksArray) {
      foreach ($chargeBacksArray as $item) {
        $chargeBack = new \com\checkout\Apiservices\Sharedmodels\Chargeback();
        $chargeBack->setId($item['id']);
        $chargeBack->setChargeId($item['chargeId']);
        $chargeBack->setScheme($item['scheme']);
        $chargeBack->setValue($item['value']);
        $chargeBack->setCurrency($item['currency']);
        $chargeBack->setTrackId($item['trackId']);
        $chargeBack->setIssueDate($item['issueDate']);
        $chargeBack->setCardNumber($item['cardNumber']);
        $chargeBack->setIndicator($item['indicator']);
        $chargeBack->setReasonCode($item['reasonCode']);
        $chargeBack->setArn($item['arn']);
        $chargeBack->setCustomerName($item['customer']['name']);
        $chargeBack->setCustomerEmail($item['customer']['email']);
        $chargeBack->setResponseCode($item['responseCode']);
        $chargeBacksToReturn[] = $chargeBack;
      }
    }

    $this->data = $chargeBacksToReturn;
  }

  /**
   * Get a chargeback.
   *
   * @param $chargeback
   *   The chargeback object.
   *
   * @return mixed
   *   A chargeback object.
   */
  private function getChargeback($chargeback) {
    return $chargeback;
  }

  /**
   * Set the page number.
   *
   * @param mixed $requestModel
   *   The page number.
   */
  private function setPageNumber($pageNumber) {
    $this->pageNumber = $pageNumber;
  }

  /**
   * Get the page number.
   *
   * @return mixed
   *   The page number.
   */
  public function getPageNumber() {
    return $this->pageNumber;
  }

  /**
   * Set the page size.
   *
   * @param mixed $requestModel
   *   The page size.
   */
  private function setPageSize($pageSize) {
    $this->pageSize = $pageSize;
  }

  /**
   * Get the page size.
   *
   * @return mixed
   *   The page size.
   */
  public function getPageSize() {
    return $this->pageSize;
  }
}
