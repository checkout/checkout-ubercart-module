<?php

/**
 * Checkout.com Apiservices\Reporting\Reportingservice.
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
 * Class Reporting Service.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Reportingservice extends \com\checkout\Apiservices\Baseservices {
  /**
   * Request the transactions.
   *
   * @param Requestmodels\Transactionfilter $requestModel
   *   The request model.
   *
   * @return Responsemodels\Transactionlist
   *   Return the server response.
   *
   * @throws Exception
   */
  public function queryTransaction(Requestmodels\Transactionfilter $requestModel) {
    $Reportingmapper = new Reportingmapper($requestModel);
    $reportingUri = $this->apiUrl->getQueryTransactionApiUri();
    $secretKey = $this->apiSetting->getSecretKey();

    $requestReporting = array(
      'authorization' => $secretKey,
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $Reportingmapper->requestReportingConverter(),

    );

    $processReporting = \com\checkout\Helpers\Apihttpclient::postRequest(
      $reportingUri,
      $secretKey,
      $requestReporting
    );
    $responseModel = new Responsemodels\Transactionlist($processReporting);

    return $responseModel;
  }

  /**
   * Request the chargebacks.
   *
   * @param Requestmodels\Transactionfilter $requestModel
   *   The request model.
   *
   * @return Responsemodels\Transactionlist
   *   Return the server response.
   *
   * @throws Exception
   */
  public function queryChargeback(Requestmodels\Transactionfilter $requestModel) {
    $Reportingmapper = new Reportingmapper($requestModel);
    $reportingUri = $this->apiUrl->getQueryChargebackApiUri();
    $secretKey = $this->apiSetting->getSecretKey();

    $requestReporting = array(
      'authorization' => $secretKey,
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $Reportingmapper->requestReportingConverter(),

    );

    $processReporting = \com\checkout\Helpers\Apihttpclient::postRequest(
      $reportingUri,
      $secretKey,
      $requestReporting
    );
    $responseModel = new Responsemodels\Chargebacklist($processReporting);

    return $responseModel;
  }

}
