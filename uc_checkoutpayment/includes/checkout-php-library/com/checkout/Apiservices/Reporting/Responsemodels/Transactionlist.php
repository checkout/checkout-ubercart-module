<?php

/**
 * Checkout.com Apiservices\Reporting\Responsemodels\Transactionlist.
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
 * Class Transaction List.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Transactionlist extends \com\checkout\Apiservices\Sharedmodels\Basehttp {
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
    $transactionsArray = $data->toArray();
    $transactionsToReturn = array();
    if ($transactionsArray) {
      foreach ($transactionsArray as $item) {
        $transaction = new \com\checkout\Apiservices\Sharedmodels\Transaction();
        $transaction->setId($item['id']);
        $transaction->setDate($item['date']);
        $transaction->setStatus($item['status']);
        $transaction->setType($item['type']);
        $transaction->setAmount($item['amount']);
        $transaction->setScheme($item['scheme']);
        $transaction->setResponsecode($item['responseCode']);
        $transaction->setCurrency($item['currency']);
        $transaction->setLiveMode($item['liveMode']);
        $transaction->setBusinessName($item['businessName']);
        $transaction->setChannelName($item['channelName']);
        $transaction->setTrackId($item['trackId']);
        $transaction->setCustomerId($item['customer']['id']);
        $transaction->setCustomerName($item['customer']['name']);
        $transaction->setCustomerEmail($item['customer']['email']);
        if (array_key_exists('originId', $item)) {
          $transaction->setOriginId($item['originId']);
        }
        $transactionsToReturn[] = $transaction;
      }
    }

    $this->data = $transactionsToReturn;
  }

  /**
   * Get a transaction.
   *
   * @param $transaction
   *   The transaction object.
   *
   * @return mixed
   *   A transaction object.
   */
  private function getTransaction($transaction) {
    return $transaction;
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
