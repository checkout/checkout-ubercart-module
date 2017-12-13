<?php

/**
 * Checkout.com Helpers\ApiUrls.
 *
 * PHP Version 5.6
 *
 * @category Helpers
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Helpers;

/**
 * Class Api Urls.
 *
 * @category Helpers
 * @version Release: @package_version@
 */
class ApiUrls {
  private $baseApiUri = null;
  private $cardTokensApiUri = null;
  private $paymentTokensApiUri = null;
  private $paymentTokenUpdateApiUri = null;
  private $cardProvidersUri = null;
  private $localPaymentprovidersUri = null;
  private $customersApiUri = null;
  private $cardsApiUri = null;
  private $cardChargesApiUri = null;
  private $cardTokenChargesApiUri = null;
  private $defaultCardChargesApiUri = null;
  private $chargeRefundsApiUri = null;
  private $captureChargesApiUri = null;
  private $updateChargesApiUri = null;
  private $retrieveChargesApiUri = null;
  private $retrieveChargehistoryApiUri = null;
  private $verifyChargesApiUri = null;
  private $chargeWithPaymenttokenUri = null;
  private $voidChargesApiUri = null;
  private $queryTransactionApiUri = null;
  private $queryChargebackApiUri = null;
  private $recurringPaymentsApiUri = null;
  private $recurringPaymentsQueryApiUri = null;
  private $recurringPaymentsCustomersApiUri = null;
  private $recurringPaymentsCustomersQueryApiUri = null;
  private $visaCheckoutCardtokenApiUri = null;

  /**
   * Class constructor.
   *
   * @param mixed $requestModel
   *   The request model.
   */
  public function __construct() {
    $this->setBaseApiUri(AppSetting::getSingletonInstance()->getBaseApiUri());
  }

  /**
   * Get the base api url.
   *
   * @return string
   *   The baseApiUri.
   */
  public function getBaseApiUri() {
    return $this->baseApiUri;
  }

  /**
   * Set the base api url.
   *
   * @param string $baseApiUri
   *   The baseApiUri.
   */
  public function setBaseApiUri($baseApiUri) {
    $this->baseApiUri = $baseApiUri;
  }

  /**
   * return url to verify a charge.
   *
   * @return string
   *   The verifyChargesApiUri.
   */
  public function getVerifyChargesApiUri() {
    if (!$this->verifyChargesApiUri) {
      $this->setVerifyChargesApiUri($this->getBaseApiUri() . "/charges/%s");
    }

    return $this->verifyChargesApiUri;
  }

  /**
   * Set the url for verify a charge.
   *
   * @param string $verifyChargesApiUri
   *   The verifyChargesApiUri.
   */
  public function setVerifyChargesApiUri($verifyChargesApiUri) {
    $this->verifyChargesApiUri = $verifyChargesApiUri;
  }

  /**
   * Return card token url.
   *
   * @return string
   *   The cardTokensApiUri.
   */
  public function getCardtokensApiUri() {
    if (!$this->cardTokensApiUri) {
      $this->setCardtokensApiUri($this->getBaseApiUri() . "/charges/token");
    }
    return $this->cardTokensApiUri;
  }

  /**
   * Set card token url.
   *
   * @param string $cardTokensApiUri
   *   The cardTokensApiUri.
   */
  public function setCardtokensApiUri($cardTokensApiUri) {
    $this->cardTokensApiUri = $cardTokensApiUri;
  }

  /**
   * Set payment token url.
   *
   * @return string
   *   The cardTokensApiUri.
   */
  public function getPaymenttokensApiUri() {
    if (!$this->paymentTokensApiUri) {
      $this->setPaymenttokensApiUri($this->getBaseApiUri() . "/tokens/payment");
    }
    return $this->paymentTokensApiUri;
  }

  /**
   * Set payment token url.
   *
   * @param string $paymentTokensApiUri
   *   The paymentTokensApiUri.
   */
  public function setPaymenttokensApiUri($paymentTokensApiUri) {
    $this->paymentTokensApiUri = $paymentTokensApiUri;
  }

  /**
   * Set payment token update url.
   *
   * @return string
   *   The paymentTokenUpdateApiUri.
   */
  public function getPaymenttokenupdateApiUri() {
    if (!$this->paymentTokenUpdateApiUri) {
      $this->setPaymenttokenupdateApiUri(
        $this->getBaseApiUri() . "/tokens/payment/%s"
      );
    }
    return $this->paymentTokenUpdateApiUri;
  }

  /**
   * Set payment token update url.
   *
   * @param string $paymentTokenUpdateApiUri
   *   The paymentTokenUpdateApiUri.
   */
  public function setPaymenttokenupdateApiUri($paymentTokenUpdateApiUri) {
    $this->paymentTokenUpdateApiUri = $paymentTokenUpdateApiUri;
  }

  /**
   * Return payment token url.
   *
   * @return string
   *   The cardProvidersUri.
   */
  public function getCardprovidersUri() {
    if (!$this->cardProvidersUri) {
      $this->setCardprovidersUri($this->getBaseApiUri() . "/providers/cards");
    }
    return $this->cardProvidersUri;
  }

  /**
   * Set payment token url.
   *
   * @param string $cardProvidersUri
   *   The cardProvidersUri.
   */
  public function setCardprovidersUri($cardProvidersUri) {
    $this->cardProvidersUri = $cardProvidersUri;
  }

  /**
   * Set local payment url.
   *
   * @return string
   *   The localPaymentprovidersUri.
   */
  public function getLocalpaymentprovidersUri() {
    if (!$this->localPaymentprovidersUri) {
      $this->setLocalpaymentprovidersUri(
        $this->getBaseApiUri() . "/providers/localpayments"
      );
    }

    return $this->localPaymentprovidersUri;
  }

  /**
   * Set local payment url.
   *
   * @param string $localPaymentprovidersUri
   *   The localPaymentprovidersUri.
   */
  public function setLocalpaymentprovidersUri($localPaymentprovidersUri) {
    $this->localPaymentprovidersUri = $localPaymentprovidersUri;
  }

  /**
   * Return customer url.
   *
   * @return string
   *   The customersApiUri.
   */
  public function getCustomersApiUri() {
    if (!$this->customersApiUri) {
      $this->setCustomersApiUri($this->getBaseApiUri() . "/customers");
    }

    return $this->customersApiUri;
  }

  /**
   * Set customer url.
   *
   * @param string $customersApiUri
   *   The customersApiUri.
   */
  public function setCustomersApiUri($customersApiUri) {
    $this->customersApiUri = $customersApiUri;
  }

  /**
   * Get card url.
   *
   * @return string
   *   The cardsApiUri.
   */
  public function getCardsApiUri() {
    if (!$this->cardsApiUri) {
      $this->setCardsApiUri($this->getBaseApiUri() . "/customers/%s/cards");
    }
    return $this->cardsApiUri;
  }

  /**
   * Set card url.
   *
   * @param string $cardsApiUri
   *   The cardsApiUri.
   */
  public function setCardsApiUri($cardsApiUri) {
    $this->cardsApiUri = $cardsApiUri;
  }

  /**
   * Get card charge url.
   *
   * @return string
   *   The cardChargesApiUri.
   */
  public function getCardChargesApiUri() {
    if (!$this->cardChargesApiUri) {
      $this->setCardChargesApiUri($this->getBaseApiUri() . "/charges/card");
    }
    return $this->cardChargesApiUri;
  }

  /**
   * Set cart charge url.
   *
   * @param string $cardChargesApiUri
   *   The cardChargesApiUri.
   */
  public function setCardChargesApiUri($cardChargesApiUri) {
    $this->cardChargesApiUri = $cardChargesApiUri;
  }

  /**
   * Get card token charge url.
   *
   * @return string
   *   The cardTokenChargesApiUri.
   */
  public function getCardtokenChargesApiUri() {
    if (!$this->cardTokenChargesApiUri) {
      $this->setCardtokenChargesApiUri($this->getBaseApiUri() . "/charges/token");
    }
    return $this->cardTokenChargesApiUri;
  }

  /**
   * Set card token charge url.
   *
   * @param string $cardTokenChargesApiUri
   *   The cardTokenChargesApiUri.
   */
  public function setCardtokenChargesApiUri($cardTokenChargesApiUri) {
    $this->cardTokenChargesApiUri = $cardTokenChargesApiUri;
  }

  /**
   * Get the charge payment token url.
   *
   * @return string
   *   The chargeWithPaymenttokenUri.
   */
  public function getChargeWithPaymenttokenUri() {
    if (!$this->chargeWithPaymenttokenUri) {
      $this->setChargeWithPaymenttokenUri(
        $this->getBaseApiUri() . "/charges/js/card"
      );
    }

    return $this->chargeWithPaymenttokenUri;
  }

  /**
   * Set the charge payment token url.
   *
   * @param string $chargeWithPaymenttokenUri
   *   The chargeWithPaymenttokenUri.
   */
  public function setChargeWithPaymenttokenUri($chargeWithPaymenttokenUri) {
    $this->chargeWithPaymenttokenUri = $chargeWithPaymenttokenUri;
  }

  /**
   * Get the Default Card Charges Api Uri.
   *
   * @return string
   *   The defaultCardChargesApiUri.
   */
  public function getDefaultCardChargesApiUri() {
    if (!$this->defaultCardChargesApiUri) {
      $this->setDefaultCardChargesApiUri(
        $this->getBaseApiUri() . "/charges/customer"
      );
    }
    return $this->defaultCardChargesApiUri;
  }

  /**
   * Set the Default Card Charges Api Uri.
   *
   * @param string $defaultCardChargesApiUri
   *   The defaultCardChargesApiUri.
   */
  public function setDefaultCardChargesApiUri($defaultCardChargesApiUri) {
    $this->defaultCardChargesApiUri = $defaultCardChargesApiUri;
  }

  /**
   * Get charge Refunds Api Uri.
   *
   * @return string
   *   The chargeRefundsApiUri.
   */
  public function getChargerefundsApiUri() {
    if (!$this->chargeRefundsApiUri) {
      $this->setChargerefundsApiUri(
        $this->getBaseApiUri() . "/charges/%s/refund"
      );
    }
    return $this->chargeRefundsApiUri;
  }

  /**
   * Set the charge Refunds Api Uri.
   *
   * @param string $chargeRefundsApiUri
   *   The chargeRefundsApiUri.
   */
  public function setChargerefundsApiUri($chargeRefundsApiUri) {
    $this->chargeRefundsApiUri = $chargeRefundsApiUri;
  }

  /**
   * Get the capture Charges Api Uri.
   *
   * @return string
   *   The captureChargesApiUri.
   */
  public function getCaptureChargesApiUri() {
    if (!$this->captureChargesApiUri) {
      $this->setCaptureChargesApiUri(
        $this->getBaseApiUri() . "/charges/%s/capture"
      );
    }
    return $this->captureChargesApiUri;
  }

  /**
   * Set the capture Charges Api Uri.
   *
   * @param string $captureChargesApiUri
   *   The captureChargesApiUri.
   */
  public function setCaptureChargesApiUri($captureChargesApiUri) {
    $this->captureChargesApiUri = $captureChargesApiUri;
  }

  /**
   * Get the update Charges Api Uri.
   *
   * @return string
   *   The updateChargesApiUri.
   */
  public function getUpdateChargesApiUri() {
    if (!$this->updateChargesApiUri) {
      $this->setUpdateChargesApiUri(
        $this->getBaseApiUri() . "/charges/%s"
      );
    }
    return $this->updateChargesApiUri;
  }

  /**
   * Get the void Charges Api Uri.
   *
   * @return null
   *   The voidChargesApiUri.
   */
  public function getVoidChargesApiUri() {
    if (!$this->voidChargesApiUri) {
      $this->setVoidChargesApiUri($this->getBaseApiUri() . "/charges/%s/void");
    }
    return $this->voidChargesApiUri;
  }

  /**
   * Get query Transaction Api Uri.
   *
   * @return null
   *   The queryTransactionApiUri.
   */
  public function getQueryTransactionApiUri() {
    if (!$this->queryTransactionApiUri) {
      $this->setQueryTransactionApiUri(
        $this->getBaseApiUri() . "/reporting/transactions"
      );
    }

    return $this->queryTransactionApiUri;
  }

  /**
   * Set the query Transaction Api Uri.
   *
   * @param mixed $queryTransactionApiUri
   *   The queryTransactionApiUri.
   */
  public function setQueryTransactionApiUri($queryTransactionApiUri) {
    $this->queryTransactionApiUri = $queryTransactionApiUri;
  }

  /**
   * Get the query Chargeback Api Uri.
   *
   * @return null
   *   The queryChargebackApiUri.
   */
  public function getQueryChargebackApiUri() {
    if (!$this->queryChargebackApiUri) {
      $this->setQueryChargebackApiUri(
        $this->getBaseApiUri() . "/reporting/chargebacks"
      );
    }

    return $this->queryChargebackApiUri;
  }

  /**
   * Set the query Chargeback Api Uri.
   *
   * @param mixed $queryChargebackApiUri
   *   The queryChargebackApiUri.
   */
  public function setQueryChargebackApiUri($queryChargebackApiUri) {
    $this->queryChargebackApiUri = $queryChargebackApiUri;
  }

  /**
   * Set the void Charges Api Uri.
   *
   * @param null $voidChargesApiUri
   *   The voidChargesApiUri.
   */
  public function setVoidChargesApiUri($voidChargesApiUri) {
    $this->voidChargesApiUri = $voidChargesApiUri;
  }

  /**
   * Get the retrieve Charges Api Uri.
   *
   * @return string
   *   The retrieveChargesApiUri.
   */
  public function getRetrieveChargesApiUri() {

    if (!$this->retrieveChargesApiUri) {
      $this->setRetrieveChargesApiUri($this->getBaseApiUri() . "/charges/%s");
    }

    return $this->retrieveChargesApiUri;
  }

  /**
   * Set the retrieve Charges Api Uri.
   *
   * @param string $retrieveChargesApiUri
   *   The retrieveChargesApiUri.
   */
  public function setRetrieveChargesApiUri($retrieveChargesApiUri) {
    $this->retrieveChargesApiUri = $retrieveChargesApiUri;
  }

  /**
   * Get the retrieve Charge history Api Uri.
   *
   * @return string
   *   The retrieveChargehistoryApiUri.
   */
  public function getRetrieveChargehistoryApiUri() {

    if (!$this->retrieveChargehistoryApiUri) {
      $this->setRetrieveChargehistoryApiUri(
        $this->getBaseApiUri() . "/charges/%s/history"
      );
    }

    return $this->retrieveChargehistoryApiUri;
  }

  /**
   * Set the retrieve Charge history Api Uri.
   *
   * @param string $retrieveChargehistoryApiUri
   *   The retrieveChargehistoryApiUri.
   */
  public function setRetrieveChargehistoryApiUri($retrieveChargehistoryApiUri) {
    $this->retrieveChargehistoryApiUri = $retrieveChargehistoryApiUri;
  }

  /**
   * Set the update Charges Api Uri.
   *
   * @param string $updateChargesApiUri
   *   The updateChargesApiUri.
   */
  public function setUpdateChargesApiUri($updateChargesApiUri) {
    $this->updateChargesApiUri = $updateChargesApiUri;
  }

  /**
   * Get the recurring Payments Api Uri.
   *
   * @return string
   *   The recurringPaymentsApiUri.
   */
  public function getRecurringpaymentsApiUri() {

    if (!$this->recurringPaymentsApiUri) {
      $this->setRecurringpaymentsApiUri(
        $this->getBaseApiUri() . "/recurringPayments/plans"
      );
    }

    return $this->recurringPaymentsApiUri;
  }

  /**
   * Set the recurring Payments Api Uri.
   *
   * @param string $recurringPaymentsApiUri
   *   The recurringPaymentsApiUri.
   */
  public function setRecurringpaymentsApiUri($recurringPaymentsApiUri) {
    $this->recurringPaymentsApiUri = $recurringPaymentsApiUri;
  }

  /**
   * Get the recurring Payments Query Api Uri.
   *
   * @return string
   *   The recurringPaymentsQueryApiUri.
   */
  public function getRecurringpaymentsQueryApiUri() {

    if (!$this->recurringPaymentsQueryApiUri) {
      $this->setRecurringpaymentsQueryApiUri(
        $this->getBaseApiUri() . "/recurringPayments/plans/search"
      );
    }

    return $this->recurringPaymentsQueryApiUri;
  }

  /**
   * Set the recurring Payments Query Api Uri.
   *
   * @param string $recurringPaymentsQueryApiUri
   *   The recurringPaymentsQueryApiUri.
   */
  public function setRecurringpaymentsQueryApiUri($recurringPaymentsQueryApiUri) {
    $this->recurringPaymentsQueryApiUri = $recurringPaymentsQueryApiUri;
  }

  /**
   * Get the recurring Payments Customers Api Uri.
   *
   * @return string
   *   The recurringPaymentsCustomersApiUri.
   */
  public function getRecurringpaymentsCustomersApiUri() {
    if (!$this->recurringPaymentsCustomersApiUri) {
      $this->setRecurringpaymentsCustomersApiUri(
        $this->getBaseApiUri() . "/recurringPayments/customers"
      );
    }

    return $this->recurringPaymentsCustomersApiUri;
  }

  /**
   * Set the recurring Payments Customers Api Uri.
   *
   * @param string $recurringPaymentsCustomersApiUri
   *   The recurringPaymentsCustomersApiUri.
   */
  public function setRecurringpaymentsCustomersApiUri(
    $recurringPaymentsCustomersApiUri
  ) {
    $this->recurringPaymentsCustomersApiUri = $recurringPaymentsCustomersApiUri;
  }

  /**
   * Get tthe recurring Payments Customers Query Api Uri.
   *
   * @return string
   *   The recurringPaymentsCustomersQueryApiUri.
   */
  public function getRecurringpaymentsCustomersQueryApiUri() {
    if (!$this->recurringPaymentsCustomersQueryApiUri) {
      $this->setRecurringpaymentsCustomersQueryApiUri(
        $this->getBaseApiUri() . "/recurringPayments/customers/search"
      );
    }

    return $this->recurringPaymentsCustomersQueryApiUri;
  }

  /**
   * Set the recurring Payments Customers Query Api Uri.
   *
   * @param string $recurringPaymentsCustomersQueryApiUri
   *   The recurringPaymentsCustomersQueryApiUri.
   */
  public function setRecurringpaymentsCustomersQueryApiUri(
    $recurringPaymentsCustomersQueryApiUri
  ) {
    $this->recurringPaymentsCustomersQueryApiUri =
      $recurringPaymentsCustomersQueryApiUri;
  }

  /**
   * Get the visa Checkout Card token Api Uri.
   *
   * @return string
   *   The visaCheckoutCardtokenApiUri.
   */
  public function getVisacheckoutcardtokenApiUri() {
    if (!$this->visaCheckoutCardtokenApiUri) {
      $this->setVisacheckoutcardtokenApiUri(
        $this->getBaseApiUri() . "/tokens/card/visa-checkout"
      );
    }

    return $this->visaCheckoutCardtokenApiUri;
  }

  /**
   * Set the visa Checkout Card token Api Uri.
   *
   * @param string $visaCheckoutCardtokenApiUri
   *   The visaCheckoutCardtokenApiUri.
   */
  public function setVisacheckoutcardtokenApiUri($visaCheckoutCardtokenApiUri) {
    $this->visaCheckoutCardtokenApiUri = $visaCheckoutCardtokenApiUri;
  }
}
