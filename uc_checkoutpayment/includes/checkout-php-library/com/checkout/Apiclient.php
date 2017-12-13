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
    $appSetting = Helpers\Appsetting::getSingletonInstance();
    $appSetting->setSecretKey($secretKey);
    $appSetting->setRequestTimeOut($connectTimeout);
    $appSetting->setReadTimeout($readTimeout);
    $appSetting->setDebugMode($debugMode);
    $appSetting->setMode($env);

    $this->tokenService = new Apiservices\Tokens\Tokenservice($appSetting);
    $this->chargeService = new Apiservices\Charges\Chargeservice($appSetting);
    $this->cardService = new Apiservices\Cards\Cardservice($appSetting);
    $this->customerService = new Apiservices\Customers\Customerservice($appSetting);
    $this->reportingService = new Apiservices\Reporting\Reportingservice($appSetting);
    $this->RecurringPaymentService = new Apiservices\Recurringpayments\Recurringpaymentservice($appSetting);
    $this->visaCheckoutService = new Apiservices\Visacheckout\Visacheckoutservice($appSetting);
  }
}
