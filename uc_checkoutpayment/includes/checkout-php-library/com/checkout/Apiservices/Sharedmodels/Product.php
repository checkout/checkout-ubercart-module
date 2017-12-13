<?php

/**
 * Checkout.com Apiservices\Sharedmodels\Product.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Sharedmodels;

/**
 * Class Product.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Product {
  protected $name = '';
  protected $productId = '';
  protected $description = '';
  protected $sku = '';
  protected $price = '';
  protected $quantity = '';
  protected $image = '';
  protected $shippingCost = '';
  protected $trackingUrl = '';

  /**
   * Get a product name.
   *
   * @return mixed
   *   The name.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set a product name.
   *
   * @param mixed $name
   *   The name.
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Get a product id.
   *
   * @return mixed
   *   The productId.
   */
  public function getProductId() {
    return $this->productId;
  }

  /**
   * Set a product id.
   *
   * @param mixed $productId
   *   The productId.
   */
  public function setProductId($productId) {
    $this->productId = $productId;
  }

  /**
   * Get a product description.
   *
   * @return mixed
   *   The description.
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Set a product description.
   *
   * @param mixed $description
   *   The description.
   */
  public function setDescription($description) {
    $this->description = $description;
  }

  /**
   * Get a product stock keeping unit.
   *
   * @return mixed
   *   The sku.
   */
  public function getSku() {
    return $this->sku;
  }

  /**
   * Set a product stock keeping unit.
   *
   * @param mixed $sku
   *   The sku.
   */
  public function setSku($sku) {
    $this->sku = $sku;
  }

  /**
   * Get a product price.
   *
   * @return mixed
   *   The price.
   */
  public function getPrice() {
    return $this->price;
  }

  /**
   * Set a product price.
   *
   * @param mixed $price
   *   The price.
   */
  public function setPrice($price) {
    $this->price = $price;
  }

  /**
   * Get a product quantity.
   *
   * @return mixed
   *   The quantity.
   */
  public function getQuantity() {
    return $this->quantity;
  }

  /**
   * Set a product quantity.
   *
   * @param mixed $quantity
   *   The quantity.
   */
  public function setQuantity($quantity) {
    $this->quantity = $quantity;
  }

  /**
   * Get a product's image.
   *
   * @return mixed
   *   The image.
   */
  public function getImage() {
    return $this->image;
  }

  /**
   * Set a product's image.
   *
   * @param mixed $image
   *   The image.
   */
  public function setImage($image) {
    $this->image = $image;
  }

  /**
   * Get a product's shipping cost.
   *
   * @return mixed
   *   The shippingCost.
   */
  public function getShippingCost() {
    return $this->shippingCost;
  }

  /**
   * Set a product's shipping cost.
   *
   * @param mixed $shippingCost
   *   The shippingCost.
   */
  public function setShippingCost($shippingCost) {
    $this->shippingCost = $shippingCost;
  }

  /**
   * Get a product's tracking url.
   *
   * @return mixed
   *   The trackingUrl.
   */
  public function getTrackingUrl() {
    return $this->trackingUrl;
  }

  /**
   * Set a product's tracking url.
   *
   * @param mixed $trackingUrl
   *   The trackingUrl.
   */
  public function setTrackingUrl($trackingUrl) {
    $this->trackingUrl = $trackingUrl;
  }
}
