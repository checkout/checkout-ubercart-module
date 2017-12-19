<?php

/**
 * Checkout.com Apiclient.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout;

/**
 * Class Api Client.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Apiclient {
  private $tokenService;
  private $chargeService;
  private $cardService;
  private $customerService;
  private $reportingService;
  private $RecurringPaymentService;
  private $visaCheckoutService;

  /**
   * Get the customer service.
   *
   * @return Apiservices\Customers\Customerservice
   *   The customerService.
   */
  public function customerService() {
    return $this->customerService;
  }

  /**
   * Get the charge service.
   *
   * @return Apiservices\Charges\Chargeservice
   *   The chargeService.
   */
  public function chargeService() {
    return $this->chargeService;
  }

  /**
   * Get the token service.
   *
   * @return Apiservices\Tokens\Tokenservice
   *   The tokenService.
   */
  public function tokenService() {
    return $this->tokenService;
  }

  /**
   * Get the card service.
   *
   * @return Apiservices\Cards\Cardservice
   *   The cardService.
   */
  public function cardService() {
    return $this->Cardservice;
  }

  /**
   * Get the reporting service.
   *
   * @return Apiservices\Reporting\Reportingservice
   *   The reportingservice.
   */
  public function reportingservice() {
    return $this->reportingService;
  }

  /**
   * Get the recurring payment service.
   *
   * @return Apiservices\Recurringpayments\Recurringpaymentservice
   *   The recurringpaymentservice.
   */
  public function recurringpaymentservice() {
    return $this->RecurringPaymentService;
  }

  /**
   * Get the vis checkout service.
   *
   * @return Apiservices\Visacheckout\Visacheckoutservice
   *   The visaCheckoutService.
   */
  public function visaCheckoutService() {
    return $this->visaCheckoutService;
  }

  /**
   * Class constructor.
   *
   * @param mixed $secretKey
   *   The secret key obtained at the Hub.
   * @param mixed $env
   *   The mode of the account.
   * @param mixed $debugMode
   *   The debug mode indicator.
   * @param mixed $connectTimeout
   *   The connect timeout.
   * @param mixed $readTimeout
   *   The reqd timeout.
   *
   */
  public function __construct(
    $secretKey,
    $env = 'sandbox',
    $debugMode = false,
    $connectTimeout = 60,
    $readTimeout = 60
  ) {
    $Appsetting = Helpers\Appsetting::getSingletonInstance();
    $Appsetting->setSecretKey($secretKey);
    $Appsetting->setRequestTimeOut($connectTimeout);
    $Appsetting->setReadTimeout($readTimeout);
    $Appsetting->setDebugMode($debugMode);
    $Appsetting->setMode($env);

    $this->tokenService = new Apiservices\Tokens\Tokenservice($Appsetting);
    $this->chargeService = new Apiservices\Charges\Chargeservice($Appsetting);
    $this->cardService = new Apiservices\Cards\Cardservice($Appsetting);
    $this->customerService = new Apiservices\Customers\Customerservice($Appsetting);
    $this->reportingService = new Apiservices\Reporting\Reportingservice($Appsetting);
    $this->RecurringPaymentService = new Apiservices\Recurringpayments\Recurringpaymentservice($Appsetting);
    $this->visaCheckoutService = new Apiservices\Visacheckout\Visacheckoutservice($Appsetting);
  }
}
