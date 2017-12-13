<?php

/**
 * Checkout.com Apiservices\Reporting\Requestmodels\Transactionfilter.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */
namespace com\checkout\Apiservices\Reporting\Requestmodels;

/**
 * Class Transaction Filter.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Transactionfilter {
  private $fromDate = null;
  private $toDate = null;
  private $pageSize = null;
  private $pageNumber = null;
  private $sortColumn = null;
  private $sortOrder = null;
  private $search = null;
  private $filters = array();

  /**
   * Set from date.
   *
   * @param mixed $fromDate
   *   A date.
   */
  public function setFromDate($fromDate) {
    $this->fromDate = $fromDate;
  }

  /**
   * Get from date.
   *
   * @return mixed
   *   A date.
   */
  public function getFromDate() {
    return $this->fromDate;
  }

  /**
   * Set to date.
   *
   * @param mixed $toDate
   *   A date.
   */
  public function setToDate($toDate) {
    $this->toDate = $toDate;
  }

  /**
   * Get to date.
   *
   * @return mixed
   *   A date.
   */
  public function getToDate() {
    return $this->toDate;
  }

  /**
   * Set the page size.
   *
   * @param mixed $requestModel
   *   The page size.
   */
  public function setPageSize($pageSize) {
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

  /**
   * Set the page number.
   *
   * @param mixed $requestModel
   *   The page number.
   */
  public function setPageNumber($pageNumber) {
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
   * Set the sort column.
   *
   * @param mixed
   *   The sort column.
   */
  public function setSortColumn($sortColumn) {
    $this->sortColumn = $sortColumn;
  }

  /**
   * Get the sort column.
   *
   * @return mixed
   *   The sort column.
   */
  public function getSortColumn() {
    return $this->sortColumn;
  }

  /**
   * Set the sort order.
   *
   * @param mixed
   *   The sort order.
   */
  public function setSortOrder($sortOrder) {
    $this->sortOrder = $sortOrder;
  }

  /**
   * Get the sort order.
   *
   * @return mixed
   *   The sort order.
   */
  public function getSortOrder() {
    return $this->sortOrder;
  }

  /**
   * Set the search.
   *
   * @param mixed
   *   The search.
   */
  public function setSearch($search) {
    $this->search = $search;
  }

  /**
   * Get the search.
   *
   * @return mixed
   *   The search.
   */
  public function getSearch() {
    return $this->search;
  }

  /**
   * Set the filters.
   *
   * @param mixed $filters
   *   The filters.
   */
  public function setFilters(array $filters) {
    $this->filters = $filters;
  }

  /**
   * Get the filters.
   *
   * @return array
   *   The filters.
   */
  public function getFilters() {
    return $this->filters;
  }
}
