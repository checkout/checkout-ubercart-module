<?php

/**
 * Checkout.com Helpers\AppSetting.
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
 * Class App Setting.
 *
 * @category Helpers
 * @version Release: @package_version@
 */
class AppSetting {
  protected static $instance = null;
  private $secretKey = null;
  private $requestTimeOut = 60;
  private $debugMode = false;
  private $clientVersion = 1.0;
  private $defaultContentType = 'JSON';
  private $readTimeout = '60';
  private $mode = 'sandbox';
  private $baseApiUri = "https://sandbox.checkout.com/v2/";

  /**
   * Get the app mode.
   *
   * @return string
   *   The mode.
   */
  public function getMode() {
    return $this->mode;
  }

  /**
   * Set the app mode.
   *
   * @param string $mode
   *   The mode.
   */
  public function setMode($mode) {
    $this->mode = $mode;
  }

  /**
   * Class constructor.
   */
  protected function __construct() {
    if (isset($_SERVER) && isset($_SERVER['HTTP_USER_AGENT'])) {
      $this->setClientUserAgentName($_SERVER['HTTP_USER_AGENT']);
    }
  }

  /**
   * Create/return original instance
   *
   * @return self
   *   The instance.
   */
  public static function getSingletonInstance() {
    if (!isset(static::$instance)) {
      static::$instance = new AppSetting();
    }
    return static::$instance;
  }

  /**
   * Get the instance.
   *
   * @param bool|false $override
   *   The override.
   *
   * @return AppSetting
   *   The instance.
   */
  public static function getInstance($override = false) {
    $instance = new AppSetting();
    if ($override) {
      static::$instance = $instance;
    }
    return $instance;
  }

  /**
   * Get the secret key.
   *
   * @return null
   *   The secretKey.
   */
  public function getSecretKey() {
    return $this->secretKey;
  }

  /**
   * Set the secret key.
   *
   * @param null $secretKey
   *   The secretKey.
   */
  public function setSecretKey($secretKey) {
    $this->secretKey = $secretKey;
  }

  /**
   * Get the public key.
   *
   * @return null
   *   The pucblicKey.
   */
  public function getPublicKey() {
    return $this->publicKey;
  }

  /**
   * Set the public key.
   *
   * @param null $publicKey
   *   The pucblicKey.
   */
  public function setPublicKey($publicKey) {
    $this->publicKey = $publicKey;
  }

  /**
   * Get the request time out.
   *
   * @return null
   *   The requestTimeOut.
   */
  public function getRequestTimeOut() {
    return $this->requestTimeOut;
  }

  /**
   * Set the request time out.
   *
   * @param null $requestTimeOut
   *   The requestTimeOut.
   */
  public function setRequestTimeOut($requestTimeOut) {
    $this->requestTimeOut = $requestTimeOut;
  }

  /**
   * Get the read timeout.
   *
   * @return string
   *   The readTimeout.
   */
  public function getReadTimeout() {
    return $this->readTimeout;
  }

  /**
   * Set the read timeout.
   *
   * @param string $readTimeout
   *   The readTimeout.
   */
  public function setReadTimeout($readTimeout) {
    $this->readTimeout = $readTimeout;
  }

  /**
   * Get the debug mode.
   *
   * @return null
   *   The debugMode.
   */
  public function getDebugMode() {
    return $this->debugMode;
  }

  /**
   * Set the debug mode.
   *
   * @param null $debugMode
   *   The debugMode.
   */
  public function setDebugMode($debugMode) {
    $this->debugMode = $debugMode;
  }

  /**
   * Get the base api uri.
   *
   * @return null
   *   The baseApiUri.
   */
  public function getBaseApiUri() {

    if ($this->mode == 'sandbox') {

      $this->baseApiUri = "https://sandbox.checkout.com/api2/v2";
    }
    else {

      $this->baseApiUri = 'https://api2.checkout.com/v2';
    }

    return $this->baseApiUri;
  }

  /**
   * Set the base api uri.
   *
   * @param null $baseApiUri
   *   The baseApiUri.
   */
  public function setBaseApiUri($baseApiUri) {
    $this->baseApiUri = $baseApiUri;
  }

  /**
   * Get the client version.
   *
   * @return null
   *   The clientVersion.
   */
  public function getClientVersion() {
    return $this->clientVersion;
  }

  /**
   * Set the client version.
   *
   * @param null $clientVersion
   *   The clientVersion.
   */
  public function setClientVersion($clientVersion) {
    $this->clientVersion = $clientVersion;
  }

  /**
   * Get the client user agent name.
   *
   * @return null
   *   The clientUserAgentName.
   */
  public function getClientUserAgentName() {
    return $this->clientUserAgentName;
  }

  /**
   * Set the client user agent name.
   *
   * @param null $clientUserAgentName
   *   The clientUserAgentName.
   */
  public function setClientUserAgentName($clientUserAgentName) {
    $this->clientUserAgentName = $clientUserAgentName;
  }

  /**
   * Get the default content type.
   *
   * @return null
   *   The defaultContentType.
   */
  public function getDefaultContentType() {
    return $this->defaultContentType;
  }

  /**
   * Set the default content type.
   *
   * @param null $defaultContentType
   *   The defaultContentType.
   */
  public function setDefaultContentType($defaultContentType) {
    $this->defaultContentType = $defaultContentType;
  }

}
