<?php

/**
 * Checkout.com Apiservices\Reporting\Reportingmapper.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Reporting;

/**
 * Class Reporting Mapper.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Reportingmapper {
  private $requestModel;

  /**
   * Class constructor.
   *
   * @param mixed $requestModel
   *   The request model.
   */
  public function __construct($requestModel) {
    $this->setRequestModel($requestModel);
  }

  /**
   * Get a request model.
   *
   * @return mixed
   *   The request model.
   */
  public function getRequestModel() {
    return $this->requestModel;
  }

  /**
   * Set a request model.
   *
   * @param mixed $requestModel
   *   The request model.
   */
  public function setRequestModel($requestModel) {
    $this->requestModel = $requestModel;
  }

  /**
   * Set a request model.
   *
   * @param mixed|null $requestModel
   *   The request model.
   *
   * @return array|null
   *   The reporting array.
   */
  public function requestReportingConverter($requestModel = null) {
    $requestReporting = null;
    if (!$requestModel) {
      $requestModel = $this->getRequestModel();
    }

    if ($requestModel) {
      $requestReporting = array();

      if (
        method_exists($requestModel, 'getFromDate') &&
        ($fromDate = $requestModel->getFromDate())
      ) {
        $requestReporting['fromDate'] = $fromDate;
      }

      if (
        method_exists($requestModel, 'getToDate') &&
        ($toDate = $requestModel->getToDate())
      ) {
        $requestReporting['toDate'] = $toDate;
      }

      if (
        method_exists($requestModel, 'getPageSize') &&
        ($pageSize = $requestModel->getPageSize())
      ) {
        $requestReporting['pageSize'] = $pageSize;
      }

      if (
        method_exists($requestModel, 'getPageNumber') &&
        ($pageNumber = $requestModel->getPageNumber())
      ) {
        $requestReporting['pageNumber'] = $pageNumber;
      }

      if (
        method_exists($requestModel, 'getSortColumn') &&
        ($sortColumn = $requestModel->getSortColumn())
      ) {
        $requestReporting['sortColumn'] = $sortColumn;
      }

      if (
        method_exists($requestModel, 'getSortOrder') &&
        ($sortOrder = $requestModel->getSortOrder())
      ) {
        $requestReporting['sortOrder'] = $sortOrder;
      }

      if (
        method_exists($requestModel, 'getSearch') &&
        ($search = $requestModel->getSearch())
      ) {
        $requestReporting['search'] = $search;
      }

      if (
        method_exists($requestModel, 'getFilters') &&
        ($filters = $requestModel->getFilters())
      ) {
        $requestReporting['filters'] = $filters;
      }
    }

    return $requestReporting;
  }

}
