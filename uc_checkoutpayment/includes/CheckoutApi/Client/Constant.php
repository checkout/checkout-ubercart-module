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
 * CheckoutapiClientConstant.
 *
 * A final class that manage constant value for
 * All CheckoutapiClientClient instances.
 *
 * @category Client
 * @version Release: @package_version@
 */
final class CheckoutapiClientConstant {
  const APIGW3_URI_PREFIX_PREPOD = 'http://preprod.checkout.com/api2/';
  const APIGW3_URI_PREFIX_DEV = 'http://dev.checkout.com/api2/';
  const APIGW3_URI_PREFIX_SANDBOX = 'https://sandbox.checkout.com/api2/';
  const APIGW3_URI_PREFIX_LIVE = 'https://api2.checkout.com/';
  const ADAPTER_CLASS_GROUP = 'CheckoutapiClientAdapter';
  const PARSER_CLASS_GROUP = 'CheckoutapiParser';
  const CHARGE_TYPE = 'card';
  const LOCALPAYMENT_CHARGE_TYPE = 'localPayment';
  const TOKEN_CARD_TYPE = 'cardToken';
  const TOKEN_SESSION_TYPE = 'sessionToken';
  const AUTOCAPUTURE_CAPTURE = 'y';
  const AUTOCAPUTURE_AUTH = 'n';
  const VERSION = 'v2';
  const STATUS_CAPTURE = 'Captured';
  const STATUS_REFUND = 'Refunded';
  const LIB_VERSION = 'v1.2.12';

}
