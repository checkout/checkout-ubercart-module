<?php

/**
 * CheckoutapiApi.
 *
 * PHP Version 5.6
 *
 * @category Api
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

/**
 * CheckoutapiClientValidationGw3.
 *
 * Checkoutapi validator class for gateway 3.0 base on documentation
 * On http://dev.checkout.com/ref/?shell#cards.
 *
 * @category Client
 * @version Release: @package_version@
 */
final class CheckoutapiClientValidationGw3 extends CheckoutapiLibObject {

  /**
   * Helper method to check if a valid email has been set in the payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isEmailValid($postedParam);.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   *   Checkoutapi check if email valid.
   */
  public static function isEmailValid(array $postedParam) {
    $isEmailEmpty = TRUE;
    $isValidEmail = FALSE;

    if (isset($postedParam['email'])) {

      $isEmailEmpty = CheckoutapiLibValidator::isEmpty($postedParam['email']);

    }

    if (!$isEmailEmpty) {
      $isValidEmail =
        CheckoutapiLibValidator::isValidEmail($postedParam['email']);
    }

    return !$isEmailEmpty && $isValidEmail;

  }

  /**
   * Helper method that is use to check if payload has set a customer id.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::CustomerIdValid($postedParam);.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   *   Check if customer id is valid.
   */
  public static function isCustomerIdValid(array $postedParam) {
    $isCustomerIdEmpty = TRUE;
    $isValidCustomerId = FALSE;

    if (isset($postedParam['customerId'])) {
      $isCustomerIdEmpty =
        CheckoutapiLibValidator::isEmpty($postedParam['customerId']);
    }

    if (!$isCustomerIdEmpty) {

      $isValidCustomerId =
        CheckoutapiLibValidator::isString($postedParam['customerId']);
    }

    return !$isCustomerIdEmpty && $isValidCustomerId;

  }

  /**
   * Helper method that is use to valid if amount is correct in a payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isValueValid($postedParam).
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   *   Checkoutapi check if amount is valid.
   */
  public static function isValueValid(array $postedParam) {
    $isValid = FALSE;

    if (isset($postedParam['value'])) {

      $amount = $postedParam['value'];

      $isAmountEmpty = CheckoutapiLibValidator::isEmpty($amount);

      if (!$isAmountEmpty) {
        $isValid = TRUE;

      }

    }

    return $isValid;

  }

  /**
   * Helper method.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isValidCurrency($postedParam);.
   *
   * Checks if payload has a currency set and if
   * Length of currency value is 3.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   *   True if currency is valid.
   */
  public static function isValidCurrency(array $postedParam) {
    $isValid = FALSE;

    if (isset($postedParam['currency'])) {

      $currency = $postedParam['currency'];
      $currencyEmpty = CheckoutapiLibValidator::isEmpty($currency);

      if (!$currencyEmpty) {
        $isCurrencyLen = CheckoutapiLibValidator::isLength($currency, 3);

        if ($isCurrencyLen) {
          $isValid = TRUE;
        }
      }
    }

    return $isValid;

  }

  /**
   * Helper method that check if a name is set in the payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isNameValid($postedParam);.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   *   True if name is valid.
   */
  public static function isNameValid(array $postedParam) {
    $isValid = FALSE;

    if (isset($postedParam['name'])) {

      $isNameEmpty = CheckoutapiLibValidator::isEmpty($postedParam['name']);
      if (!$isNameEmpty) {

        $isValid = TRUE;
      }

    }

    return $isValid;

  }

  /**
   * Helper method that check if card number is set in payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isCardNumberValid($param).
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *   True if cardnumber is valid.
   */
  public static function isCardNumberValid(array $param) {
    $isValid = FALSE;

    if (isset($param['number'])) {

      $errorIsEmpty = CheckoutapiLibValidator::isEmpty($param['number']);

      if (!$errorIsEmpty) {
        $isValid = TRUE;
      }
    }

    return $isValid;

  }

  /**
   * Helper method that check if month is properly set in payload card object.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isMonthValid($card).
   *
   * @param array $card
   *   A var for card.
   *
   * @return bool
   *   True if month is valid.
   */
  public static function isMonthValid(array $card) {
    $isValid = FALSE;

    if (isset($card['expiryMonth'])) {

      $isExpiryMonthEmpty = CheckoutapiLibValidator::isEmpty(
        $card['expiryMonth'],
        FALSE
      );

      if (
        !$isExpiryMonthEmpty &&
        CheckoutapiLibValidator::isInteger(
          $card['expiryMonth']
        ) &&
        ($card['expiryMonth'] > 0 &&
        $card['expiryMonth'] < 13)
      ) {
        $isValid = TRUE;
      }
    }

    return $isValid;

  }

  /**
   * Helper method that check if year is properly set in payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isValidYear($card).
   *
   * @param array $card
   *   A var for card.
   *
   * @return bool
   *   True if year is valid.
   */
  public static function isValidYear(array $card) {
    $isValid = FALSE;

    if (isset($card['expiryYear'])) {

      $isExpiryYear = CheckoutapiLibValidator::isEmpty($card['expiryYear']);

      if (
        !$isExpiryYear && CheckoutapiLibValidator::isInteger(
          $card['expiryYear']
        )
        && (
          CheckoutapiLibValidator::isLength(
            $card['expiryYear'],
            2
          ) || CheckoutapiLibValidator::isLength(
            $card['expiryYear'],
            4
          )
        )
      ) {
        $isValid = TRUE;
      }
    }

    return $isValid;

  }

  /**
   * Helper method that check if cvv is properly set in payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isValidCvv($card).
   *
   * @param array $card
   *   A var for card.
   *
   * @return bool
   *   True if CVV is valid.
   */
  public static function isValidCvv(array $card) {
    $isValid = FALSE;

    if (isset($card['cvv'])) {

      $isCvvEmpty = CheckoutapiLibValidator::isEmpty($card['cvv']);

      if (!$isCvvEmpty && CheckoutapiLibValidator::isValidCvvLen(
        $card['cvv']
      )) {

        $isValid = TRUE;

      }
    }
    return $isValid;

  }

  /**
   * A helper method.
   *
   * Helper method that check if card is properly set in payload It check if
   * Expiry date , card number , cvv and name is set.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isCardValid($param).
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *   True if the card is valid.
   */
  public static function isCardValid(array $param) {
    $isValid = TRUE;

    if (isset($param['card'])) {
      $card = $param['card'];

      $isNameValid = CheckoutapiClientValidationGw3::isNameValid($card);

      if (!$isNameValid) {

        $isValid = FALSE;
      }

      $isCardNumberValid = CheckoutapiClientValidationGw3::isCardNumberValid($card);

      if (!$isCardNumberValid && !isset($param['card']['number'])) {

        $isValid = FALSE;
      }

      $isValidMonth = CheckoutapiClientValidationGw3::isMonthValid($card);

      if (!$isValidMonth && !isset($param['card']['expiryMonth'])) {
        $isValid = FALSE;
      }

      $isValidYear = CheckoutapiClientValidationGw3::isValidYear($card);

      if (!$isValidYear && !isset($param['card']['expiryYear'])) {
        $isValid = FALSE;
      }

      $isValidCvv = CheckoutapiClientValidationGw3::isValidCvv($card);

      if (!$isValidCvv && !isset($param['card']['cvv'])) {
        $isValid = FALSE;
      }

      return $isValid;

    }
    return TRUE;

  }

  /**
   * Helper method that check if card id was set in payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::CardIdValid($param).
   *
   * @param mixed $param
   *   A var for param.
   *
   * @return bool
   *   True if the card id is valid.
   */
  public static function isCardIdValid($param) {
    $isValid = FALSE;
    if (isset($param['card'])) {
      $card = $param['card'];

      if (isset($card['id'])) {

        $isCardIdEmpty = CheckoutapiLibValidator::isEmpty($card['id']);

        if (!$isCardIdEmpty && CheckoutapiLibValidator::isString($card['id'])) {
          $isValid = TRUE;
        }
      }

      return $isValid;

    }
    return TRUE;

  }

  /**
   * Helper method that check if card id is set in payload.
   *
   * The difference between isCardIdValid and isGetCardIdValid is, i
   * SCardIdValid check if card id is set in postedparam where as
   * IsGetCardIdValid check if configuration pass has a card id.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isGetCardIdValid($param).
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *   True if a valid card has set.
   */
  public static function isGetCardIdValid(array $param) {
    $isValid = FALSE;
    $card = $param['cardId'];

    if (isset($card)) {
      $isValid = self::isCardIdValid(array('card' => $card));
    }

    return $isValid;

  }

  /**
   * Helper method that check in payload if phone number was set.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   *   True if the phone is valid.
   */
  public static function isPhoneNoValid(array $postedParam) {
    $isValid = FALSE;

    if (isset($postedParam['phoneNumber'])) {

      $isPhoneEmpty = CheckoutapiLibValidator::isEmpty($postedParam['phoneNumber']);

      if (
        !$isPhoneEmpty &&
        CheckoutapiLibValidator::isString($postedParam['phoneNumber'])
      ) {
        $isValid = TRUE;
      }
    }

    return $isValid;

  }

  /**
   * Helper method that check that check if token is set in payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isCardToken($param).
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *   True if the card token is valid.
   */
  public static function isCardToken(array $param) {
    $isValid = FALSE;

    if (isset($param['cardToken'])) {
      $isTokenEmpty = CheckoutapiLibValidator::isEmpty($param['cardToken']);

      if (!$isTokenEmpty) {
        $isValid = TRUE;
      }
    }

    return $isValid;

  }

  /**
   * Helper method that check that check if paymentToken is set in payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isPaymentToken($param).
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *   True if the payment token is valid.
   */
  public static function isPaymentToken(array $param) {
    $isValid = FALSE;

    if (isset($param['paymentToken'])) {
      $isTokenEmpty = CheckoutapiLibValidator::isEmpty($param['paymentToken']);

      if (!$isTokenEmpty) {
        $isValid = TRUE;
      }
    }

    return $isValid;

  }

  /**
   * Helper method that check that check if session token is set in payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isSessionToken($param).
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *   True if the session token is valid.
   */
  public static function isSessionToken(array $param) {
    $isValid = FALSE;

    if (isset($param['token'])) {
      $isTokenEmpty = CheckoutapiLibValidator::isEmpty($param['token']);

      if (!$isTokenEmpty) {
        $isValid = TRUE;
      }
    }

    return $isValid;

  }

  /**
   * Helper method.isCardIdValid.
   *
   * Checks if localpayment object is valid in payload
   * It check if lppId is set.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isLocalPyamentHashValid($postedParam).
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   *   True if the local payment hash is valid.
   */
  public static function isLocalPyamentHashValid(array $postedParam) {
    $isValid = FALSE;

    if (isset($postedParam['localPayment']) && !(CheckoutapiLibValidator::isEmpty($postedParam['localPayment']))) {
      if (isset($postedParam['localPayment']['lppId']) && !(CheckoutapiLibValidator::isEmpty($postedParam['localPayment']['lppId']))) {
        $isValid = TRUE;
      }
    }

    return $isValid;

  }

  /**
   * Helper method that check if a charge id was set in the payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isChargeIdValid($param).
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *   True if the charge id is valid.
   */
  public static function isChargeIdValid(array $param) {
    $isValid = FALSE;

    if (isset($param['chargeId']) && !(CheckoutapiLibValidator::isEmpty($param['chargeId']))) {
      $isValid = TRUE;
    }
    return $isValid;

  }

  /**
   * Helper method that check provider id is set in payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isProvider($param).
   *
   * @param mixed $param
   *   A param var.
   *
   * @return bool
   *   True if the provider is set.
   */
  public static function isProvider($param) {
    $isValid = FALSE;

    if (isset($param['providerId']) && !(CheckoutapiLibValidator::isEmpty($param['providerId']))) {
      $isValid = TRUE;
    }
    return $isValid;

  }

  /**
   * Helper method that check plan id is set in payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isPlanIdValid($param).
   *
   * @param mixed $postedParam
   *   A postedParam var.
   *
   * @return bool
   *   True if the plan id is set.
   */
  public static function isPlanIdValid($postedParam) {
    $isPlanIdEmpty = TRUE;
    $isValidPlanId = FALSE;

    if (isset($postedParam['planId'])) {
      $isPlanIdEmpty = CheckoutapiLibValidator::isEmpty($postedParam['planId']);
    }

    if (!$isPlanIdEmpty) {

      $isValidPlanId = CheckoutapiLibValidator::isString($postedParam['planId']);
    }

    return !$isPlanIdEmpty && $isValidPlanId;

  }

  /**
   * Helper method that check customer plan id is set in payload.
   *
   * Simple usage:
   *   CheckoutapiClientValidationGw3::isCustomerPlanIdValid($param).
   *
   * @param mixed $postedParam
   *   A postedParam var.
   *
   * @return bool
   *   True if the customer plan id is set.
   */
  public static function isCustomerPlanIdValid($postedParam) {
    $isCustomerPlanIdEmpty = TRUE;
    $isValidCustomerPlanId = FALSE;

    if (isset($postedParam['customerPlanIdValid'])) {
      $isCustomerPlanIdEmpty = CheckoutapiLibValidator::isEmpty($postedParam['customerPlanIdValid']);
    }

    if (!$isCustomerPlanIdEmpty) {

      $isValidCustomerPlanId = CheckoutapiLibValidator::isString($postedParam['customerPlanIdValid']);
    }

    return !$isCustomerPlanIdEmpty && $isValidCustomerPlanId;

  }

}
