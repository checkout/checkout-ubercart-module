<?php

/**
 * Checkout.com Apiservices\Charges\Requestmodels\Basecharge.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Charges\Requestmodels;

/**
 * Class Base Charge.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Basecharge extends Basechargeinfo {
  protected $email;
  protected $customerName;
  protected $customerId;
  protected $description;
  protected $autoCapture;
  protected $autoCapTime;
  protected $shippingDetails;
  protected $products = array();
  protected $value;
  protected $currency;
  protected $customerIp;
  protected $chargeMode;
  protected $riskCheck;
  protected $attemptN3D;
  protected $billingDetails;

  /**
   * Get the IP address of the Customer.
   *
   * @return mixed
   *   The customerIp.
   */
  public function getCustomerIp() {
    return $this->customerIp;
  }

  /**
   * Set the IP address of the Customer.
   *
   * @param mixed $customerIp
   *   The customerIp.
   */
  public function setCustomerIp($customerIp) {
    $this->customerIp = $customerIp;
  }

  /**
   * Get the customer name.
   *
   * @return mixed
   *   The customerName.
   */
  public function getCustomerName() {
    return $this->customerName;
  }

  /**
   * Set the customer name.
   *
   * @param mixed $customerName
   *   The customerName.
   */
  public function setCustomerName($customerName) {
    $this->customerName = $customerName;
  }

  /**
   * Get the Three-letter ISO currency code.
   *
   * This code is representing the currency in
   * which the recurring charge will be made.
   *
   * @return mixed
   *   The currency.
   */
  public function getCurrency() {
    return $this->currency;
  }

  /**
   * Set the Three-letter ISO currency code.
   *
   * This code is representing the currency in
   * which the recurring charge will be made.
   *
   * @param mixed $currency
   *   The currency.
   */
  public function setCurrency($currency) {
    $this->currency = $currency;
  }

  /**
   * Get the value of the transaction.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @return mixed
   *   The value.
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Set the value of the transaction.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @param mixed $value
   *   The value.
   */
  public function setValue($value) {
    $this->value = $value;
  }

  /**
   * Get the email address of the customer.
   *
   * @return mixed
   *   The email.
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Set the email address of the customer.
   *
   * @param mixed $email
   *   The email.
   */
  public function setEmail($email) {
    $this->email = $email;
  }

  /**
   * Get the customer ID.
   *
   * Note: The customer id is prefixed with cust_.
   *
   * @return mixed
   *   The CustomerId.
   */
  public function getCustomerId() {
    return $this->customerId;
  }

  /**
   * Set the customer ID.
   *
   * Note: The customer id is prefixed with cust_.
   *
   * @param mixed $customerId
   *   The CustomerId.
   */
  public function setCustomerId($customerId) {
    $this->customerId = $customerId;
  }

  /**
   * Get a description that can be added to this object.
   *
   * @return mixed
   *   The description.
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Set a description that can be added to this object.
   *
   * @param mixed $description
   *   The description.
   */
  public function setDescription($description) {
    $this->description = $description;
  }

  /**
   * Get the auto capture.
   *
   * Accepted values either 'y' or 'n'. Default is is set to 'y'.
   * Defines if the charge will be authorised ('n') or captured ('y').
   * Authorisations will expire in 7 days.
   *
   * @return mixed
   *   The autoCapture.
   */
  public function getAutoCapture() {
    return $this->autoCapture;
  }

  /**
   * Set the auto capture.
   *
   * Accepted values either 'y' or 'n'. Default is is set to 'y'.
   * Defines if the charge will be authorised ('n') or captured ('y').
   * Authorisations will expire in 7 days.
   *
   * @param mixed $autoCapture
   *   The autoCapture.
   */
  public function setAutoCapture($autoCapture) {
    $this->autoCapture = $autoCapture;
  }

  /**
   * Get the delayed capture time.
   *
   * The delayed capture time (1-168 inclusive) expressed in hours.
   * Interpret decimal values as fractions of an hour.
   *
   * @return mixed
   *   The autoCapTime.
   */
  public function getAutoCapTime() {
    return $this->autoCapTime;
  }

  /**
   * Set the delayed capture time.
   *
   * The delayed capture time (1-168 inclusive) expressed in hours.
   * Interpret decimal values as fractions of an hour.
   *
   * @param mixed $autoCapTime
   *   The autoCapTime.
   */
  public function setAutoCapTime($autoCapTime) {
    $this->autoCapTime = $autoCapTime;
  }

  /**
   * Get the shipping address information.
   *
   * @return mixed
   *   The shippingDetails.
   */
  public function getShippingDetails() {
    return $this->shippingDetails;
  }

  /**
   * Set the shipping address information.
   *
   * @param mixed $shippingDetails
   *   The shippingDetails.
   */
  public function setShippingDetails(
    \com\checkout\Apiservices\Sharedmodels\Address $shippingDetails
  ) {
    $this->shippingDetails = $shippingDetails;
  }

  /**
   * Get the array of Product information.
   *
   * @return mixed
   *   The products.
   */
  public function getProducts() {
    return $this->products;
  }

  /**
   * Set the array of Product information.
   *
   * @param mixed $products
   *   The products.
   */
  public function setProducts(
    \com\checkout\Apiservices\Sharedmodels\Product $products
  ) {

    $this->products[] = $products;
  }

  /**
   * Get a valid charge mode.
   *
   * Options:
   *   1 for No 3D.
   *   2 for 3D.
   *   3 for Local Payment.
   *
   * @return mixed
   *   The chargeMode.
   */
  public function getChargeMode() {
    return $this->chargeMode;
  }

  /**
   * Set a valid charge mode.
   *
   * Options:
   *   1 for No 3D.
   *   2 for 3D.
   *   3 for Local Payment.
   *
   * @param mixed $chargeMode
   *   The chargeMode.
   */
  public function setChargeMode($chargeMode) {
    $this->chargeMode = $chargeMode;
  }

  /**
   * Get the indicator to check for risks.
   *
   * If set to 'false', allows the merchant to bypass all risk checks
   * configured on the system (including blacklist).
   *
   * Note: The ability to set riskCheck is not available by default to
   * all merchants. Please contact your relationship manager for more information.
   *
   * @return mixed
   *   The riskCheck.
   */
  public function getRiskCheck() {
    return $this->riskCheck;
  }

  /**
   * Set the indicator to check for risks.
   *
   * If set to 'false', allows the merchant to bypass all risk checks
   * configured on the system (including blacklist).
   *
   * Note: The ability to set riskCheck is not available by default to
   * all merchants. Please contact your relationship manager for more information.
   *
   * @param mixed $riskCheck
   *   The riskCheck.
   */
  public function setRiskCheck($riskCheck) {
    $this->riskCheck = $riskCheck;
  }

  /**
   * Set the indicator to attempt to skip 3D checks.
   *
   * If set to 'false', allows the merchant to bypass the 3D security,
   * if they are set in the risks settings.
   *
   * @param mixed $attemptN3D
   *   The attemptN3D.
   */
  public function setAttemptN3D($attemptN3D) {
    $this->attemptN3D = $attemptN3D;
  }

  /**
   * Get the indicator to attempt to skip 3D checks.
   *
   * If set to 'false', allows the merchant to bypass the 3D security,
   * if they are set in the risks settings.
   *
   * @return mixed
   *   The attemptN3D.
   */
  public function getAttemptN3D() {
    return $this->attemptN3D;
  }

  /**
   * Set the Billing Details object.
   *
   * It contains address details along with an associated phone number (optional).
   *
   * "billingDetails": {
   *   "addressLine1": "333 Cormier Bypass",
   *   "addressLine2": "Rolfson Alley",
   *   "postcode": "ue0 2ou",
   *   "country": "US",
   *   "city": "Schmittchester",
   *   "state": "Jakubowskiton",
   *   "phone": {
   *       "countryCode": "44",
   *       "number": "12345678"
   *     }
   *   }
   *
   * @param mixed $billingDetails
   *   The BillingDetails .
   */
  public function setBillingDetails($billingDetails) {
    $this->billingDetails = $billingDetails;
  }

  /**
   * Get the Billing Details object.
   *
   * It contains address details along with an associated phone number (optional).
   *
   * "billingDetails": {
   *   "addressLine1": "333 Cormier Bypass",
   *   "addressLine2": "Rolfson Alley",
   *   "postcode": "ue0 2ou",
   *   "country": "US",
   *   "city": "Schmittchester",
   *   "state": "Jakubowskiton",
   *   "phone": {
   *       "countryCode": "44",
   *       "number": "12345678"
   *     }
   *   }
   *
   * @return mixed
   *   The BillingDetails .
   */
  public function getBillingDetails() {
    return $this->billingDetails;
  }
}
