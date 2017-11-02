<?php

/**
 * CheckoutapiClientValidationGw3
 * Checkoutapi validator class for gateway 3.0 base on documentation on http://dev.checkout.com/ref/?shell#cards
 *
 * @package   Checkoutapi
 * @category  Api
 * @author    Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @copyright 2014 Integration team (http://www.checkout.com)
 */
final class CheckoutapiClientValidationGw3 extends CheckoutapiLibObject
{
    /**
     * A helper  method to check if email has been set in the payload and if it's a valid email
     *
     * @param  array $postedParam
     * @return boolean
     * Checkoutapi check if email valid
     * Simple usage:
     *          CheckoutapiClientValidationGw3::isEmailValid($postedParam);
     */

    public static function isEmailValid($postedParam) 
    {
        $isEmailEmpty = true;    
        $isValidEmail  = false;

        if(isset($postedParam['email'])) {

            $isEmailEmpty = CheckoutapiLibValidator::isEmpty($postedParam['email']);

        }

        if(!$isEmailEmpty) {

            $isValidEmail =  CheckoutapiLibValidator::isValidEmail($postedParam['email']);

        }

        return !$isEmailEmpty && $isValidEmail;

    }

    /**
     * A helper method that is use to check if payload has set a customer id.
     *
     * @param  array $postedParam
     * @return boolean
     * check if customer id is valid.
     * Simple usage:
     *          CheckoutapiClientValidationGw3::CustomerIdValid($postedParam);
     */

    public static function isCustomerIdValid($postedParam)
    {
        $isCustomerIdEmpty = true;
        $isValidCustomerId = false;

        if(isset($postedParam['customerId'])) {
            $isCustomerIdEmpty = CheckoutapiLibValidator::isEmpty($postedParam['customerId']);
        }

        if(!$isCustomerIdEmpty) {

            $isValidCustomerId = CheckoutapiLibValidator::isString($postedParam['customerId']);
        }

        return !$isCustomerIdEmpty && $isValidCustomerId;
    }

    /**
     * A helper method that is use to valid if amount is correct in a payload.
     *
     * @param  array $postedParam
     * @return boolean
     * Checkoutapi check if amount is valid.
     * Simple usage:
     *        CheckoutapiClientValidationGw3::isValueValid($postedParam)
     */
    public static function isValueValid($postedParam)
    {
        $isValid = false;

        if(isset($postedParam['value'])) {

            $amount = $postedParam['value'];

            $isAmountEmpty = CheckoutapiLibValidator::isEmpty($amount);

            
            if(!$isAmountEmpty  ) {
                $isValid = true;

            } 
    
        } 

        return $isValid;
    }

    /**
     * A helper method that is use check if payload has a currency set and if length of currency value is 3
     *
     * @param  array $postedParam
     * @return boolean
     * Simple usage:
     *      CheckoutapiClientValidationGw3::isValidCurrency($postedParam);
     */
    public static function isValidCurrency($postedParam) 
    {
        $isValid = false;

        if(isset($postedParam['currency'])) {

            $currency = $postedParam['currency'];
            $currencyEmpty = CheckoutapiLibValidator::isEmpty($currency);

            if(!$currencyEmpty) {
                $isCurrencyLen = CheckoutapiLibValidator::isLength($currency, 3);

                if($isCurrencyLen) {
                    $isValid = true;
                }
            }
        }

        return $isValid;
    }

    /**
     * A helper method that check if a name is set in the payload
     *
     * @param  array $postedParam
     * @return boolean
     * Simple usage:
     *      CheckoutapiClientValidationGw3::isNameValid($postedParam);
     */

    public static function isNameValid($postedParam)
    {
        $isValid = false;

        if(isset($postedParam['name'])) {

            $isNameEmpty = CheckoutapiLibValidator::isEmpty($postedParam['name']);
            if(!$isNameEmpty) {

                $isValid = true;
            }
            
        } 

        return $isValid ;
    }

    /**
     * A helper method that check if card number is set in payload.
     *
     * @param  array $param
     * @return bool
     * Simple usage:
     *      CheckoutapiClientValidationGw3::isCardNumberValid($param)
     */
    public static function isCardNumberValid($param)
    {
        $isValid = false;

        if(isset($param['number'])) {

            $errorIsEmpty = CheckoutapiLibValidator::isEmpty($param['number']);
            
            if(!$errorIsEmpty) {
                //$this->logError(true, "Card number can not be empty.", array('card'=>$param),false);
                $isValid = true;
            }

        } 

        return $isValid;
    }

    /**
     *  A helper method that check if month is properly set in payload card object
     *
     * @param  array $card
     * @return bool
     * Simple usage:
     *          CheckoutapiClientValidationGw3::isMonthValid($card)
     */
    public static function isMonthValid($card)
    {
        $isValid = false;

        if(isset($card['expiryMonth'])) {

            $isExpiryMonthEmpty = CheckoutapiLibValidator::isEmpty($card['expiryMonth'], false);
            
            if(!$isExpiryMonthEmpty && CheckoutapiLibValidator::isInteger($card['expiryMonth']) && ($card['expiryMonth']  > 0 && $card['expiryMonth'] < 13)) {
                $isValid = true;
            } 
        } 

        return $isValid;
    }

    /**
     *  A helper method that check if year is properly set in payload
     *
     * @param  array $card
     * @return bool
     * Simple usage:
     *      CheckoutapiClientValidationGw3::isValidYear($card)
     */
    public static function isValidYear($card)
    {
        $isValid = false;

        if(isset($card['expiryYear'])) {

            $isExpiryYear = CheckoutapiLibValidator::isEmpty($card['expiryYear']);
            
            if(!$isExpiryYear && CheckoutapiLibValidator::isInteger($card['expiryYear']) 
                && ( CheckoutapiLibValidator::isLength($card['expiryYear'], 2) ||  CheckoutapiLibValidator::isLength($card['expiryYear'], 4) ) 
            ) {
            
                $isValid = true;
            
            } 
        }

        return $isValid;
    }

    /**
     *  A helper method that check if cvv is properly set in payload
     *
     * @param  array $card
     * @return bool
     *
     * Simple usage:
     *          CheckoutapiClientValidationGw3::isValidCvv($card)
     */

    public static function isValidCvv($card)
    {
        $isValid = false;

        if(isset($card['cvv'])) {

            $isCvvEmpty = CheckoutapiLibValidator::isEmpty($card['cvv']);
            
            if(!$isCvvEmpty && CheckoutapiLibValidator::isValidCvvLen($card['cvv'])) {
            
                $isValid = true;
            
            }
        }
        return $isValid;
    }

    /**
     *  A helper method that check if card is properly set in payload. It check if expiry date , card number , cvv and name is set
     *
     * @param  $param
     * @return bool
     * Simple usage:
     *          CheckoutapiClientValidationGw3::isCardValid($param)
     */
    public static function isCardValid($param) 
    {
        $isValid = true;

        if(isset($param['card'])) {
            $card = $param['card'];

            $isNameValid = CheckoutapiClientValidationGw3::isNameValid($card);

            if (!$isNameValid) {

                $isValid = false;
            }

            $isCardNumberValid = CheckoutapiClientValidationGw3::isCardNumberValid($card);

            if (!$isCardNumberValid && ! isset($param['card']['number'])) {

                $isValid = false;
            }

            $isValidMonth = CheckoutapiClientValidationGw3::isMonthValid($card);


            if (!$isValidMonth && !isset($param['card']['expiryMonth'])) {
                $isValid = false;
            }

            $isValidYear = CheckoutapiClientValidationGw3::isValidYear($card);

            if (!$isValidYear && !isset($param['card']['expiryYear'])) {
                $isValid = false;
            }

            $isValidCvv = CheckoutapiClientValidationGw3::isValidCvv($card);

            if (!$isValidCvv && !isset($param['card']['cvv'])) {
                $isValid = false;
            }

            return $isValid;
        }
        return true;

    }

    /**
     *  A helper method that check if card id was set in payload
     *
     * @param  $param
     * @return bool
     * Simple usage:
     *      CheckoutapiClientValidationGw3::CardIdValid($param)
     */
    public static function isCardIdValid($param)
    {
        $isValid = false;
        if(isset($param['card'])) {
            $card = $param['card'];

            if(isset($card['id'])) {

                $isCardIdEmpty = CheckoutapiLibValidator::isEmpty($card['id']);

                if(!$isCardIdEmpty && CheckoutapiLibValidator::isString($card['id']) ) {
                    $isValid = true;
                }
            }

            return $isValid;
        }
        return true;

    }

    /**
     *  A helper method that check if card id is set in payload.
     * The difference between isCardIdValid and isGetCardIdValid is, isCardIdValid check if card id is set
     * in postedparam where as isGetCardIdValid check if configuration pass has a card id
     *
     * @param  array $param
     * @return boolean
     * Simple usage:
     *         CheckoutapiClientValidationGw3::isGetCardIdValid($param)
     */
    public static function isGetCardIdValid($param)
    {
        $isValid = false;
        $card = $param['cardId'];

        if(isset($param['cardId'])) {
            $isValid = self::isCardIdValid(array('card'=>$param['cardId']));
        }

        return $isValid;

    }

    /**
     *  A helper method that check in payload if phone number was set
     *
     * @param  array $postedParam
     * @return boolean
     */

    public static function isPhoneNoValid($postedParam)
    {
        $isValid = false;

        if(isset($postedParam['phoneNumber'])) {

            $isPhoneEmpty = CheckoutapiLibValidator::isEmpty($postedParam['phoneNumber']);

            if(!$isPhoneEmpty &&  CheckoutapiLibValidator::isString($postedParam['phoneNumber']) ) {
                $isValid = true;
            }
        }

        return $isValid;

    }

    /**
     *  A helper method that check that check if token is set in payload
     *
     * @param  array $param
     * @return boolean
     * Simple usage:
     *       CheckoutapiClientValidationGw3::isCardToken($param)
     */
    public static function isCardToken($param)
    {
        $isValid = false;

        if(isset($param['cardToken'])) {
            $isTokenEmpty = CheckoutapiLibValidator::isEmpty($param['cardToken']);

            if(!$isTokenEmpty) {
                $isValid = true;
            }
        }

        return $isValid;
    }

    /**
     *  A helper method that check that check if paymentToken is set in payload
     *
     * @param  array $param
     * @return boolean
     * Simple usage:
     *       CheckoutapiClientValidationGw3::isPaymentToken($param)
     */
    public static function isPaymentToken($param)
    {
        $isValid = false;

        if(isset($param['paymentToken'])) {
            $isTokenEmpty = CheckoutapiLibValidator::isEmpty($param['paymentToken']);

            if(!$isTokenEmpty) {
                $isValid = true;
            }
        }

        return $isValid;
    }
    /**
     *  A helper method that check that check if session token is set in payload
     *
     * @param  array $param
     * @return boolean
     * Simple usage:
     *      CheckoutapiClientValidationGw3::isSessionToken($param)
     */

    public static function isSessionToken($param)
    {
        $isValid = false;

        if(isset($param['token'])) {
            $isTokenEmpty = CheckoutapiLibValidator::isEmpty($param['token']);

            if(!$isTokenEmpty) {
                $isValid = true;
            }
        }

        return $isValid;
    }

    /**
     * A helper method that check if localpayment object is valid in payload. It check if lppId is set
     *
     * @param  array $postedParam
     * @return boolean
     * Simple usage:
     *       CheckoutapiClientValidationGw3::isLocalPyamentHashValid($postedParam)
     */

    public static function isLocalPyamentHashValid($postedParam)
    {
        $isValid = false;

        if(isset($postedParam['localPayment']) && !(CheckoutapiLibValidator::isEmpty($postedParam['localPayment']))) {
            if(isset($postedParam['localPayment']['lppId']) && !(CheckoutapiLibValidator::isEmpty($postedParam['localPayment']['lppId']))) {
                $isValid = true;
            }
        }

        return $isValid;
    }

    /**
     * A helper method that check if a charge id was set in the payload
     *
     * @param  array $param
     * @return boolean
     *
     * Simple usage:
     *       CheckoutapiClientValidationGw3::isChargeIdValid($param)
     */
    public static function isChargeIdValid($param)
    {
        $isValid = false;

        if(isset($param['chargeId']) && !(CheckoutapiLibValidator::isEmpty($param['chargeId']))) {
                $isValid = true;
        }
        return $isValid;
    }

    /**
     * A helper method that check provider id is set in payload.
     *
     * @param  $param
     * @return bool
     * Simple usage:
     *      CheckoutapiClientValidationGw3::isProvider($param)
     */
    public static function isProvider($param)
    {
        $isValid = false;

        if(isset($param['providerId']) && !(CheckoutapiLibValidator::isEmpty($param['providerId']))) {
            $isValid = true;
        }
        return $isValid;
    }

    /**
     * A helper method that check plan id is set in payload.
     *
     * @param  $param
     * @return bool
     * Simple usage:
     *      CheckoutapiClientValidationGw3::isPlanIdValid($param)
     */
    public static function isPlanIdValid($postedParam)
    {
        $isPlanIdEmpty = true;
        $isValidPlanId = false;

        if(isset($postedParam['planId'])) {
            $isPlanIdEmpty = CheckoutapiLibValidator::isEmpty($postedParam['planId']);
        }

        if(!$isPlanIdEmpty) {

            $isValidPlanId = CheckoutapiLibValidator::isString($postedParam['planId']);
        }

        return !$isPlanIdEmpty && $isValidPlanId;
    }

    /**
     * A helper method that check customer plan id is set in payload.
     *
     * @param  $param
     * @return bool
     * Simple usage:
     *      CheckoutapiClientValidationGw3::isCustomerPlanIdValid($param)
     */
    public static function isCustomerPlanIdValid($postedParam)
    {
        $isCustomerPlanIdEmpty = true;
        $isValidCustomerPlanId = false;

        if(isset($postedParam['customerPlanIdValid'])) {
            $isCustomerPlanIdEmpty = CheckoutapiLibValidator::isEmpty($postedParam['customerPlanIdValid']);
        }

        if(!$isCustomerPlanIdEmpty) {

            $isValidCustomerPlanId = CheckoutapiLibValidator::isString($postedParam['customerPlanIdValid']);
        }

        return !$isCustomerPlanIdEmpty && $isValidCustomerPlanId;
    }
}
