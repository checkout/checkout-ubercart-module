<?php

/**
 * CheckoutapiApi
 *
 * PHP Version 5.2
 *
 * @category  Api
 * @author    Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @copyright 2014 Integration team (http://www.checkout.com)
 */

/**
 * Class final  CheckoutapiApi.
 * This class is responsible in creating instance of payment gateway interface(CheckoutapiClientClient).
 *
 * The simplest usage would be:
 *     $Api = CheckoutapiApi::getApi();
 *
 * This will create an instance a singleton instance of CheckoutapiClientClient
 * The default gateway is CheckoutapiClientClientgw3.
 *
 * If you need create instance of other gateways, you can do do those steps:
 *
 *     $Api = CheckoutapiApi::getApi(array(),'CheckoutapiClientClient[GATEWAYNAME]');
 *
 *  If you need initialise some configuration before hand:
 *
 *     $config = array('config1' => 'value1', 'config2' => 'value2');
 *     $Api = CheckoutapiApi::getApi($config);
 */

final class CheckoutapiApi
{
    /**
     * 
     *
     * @var string $_apiClass  The name of the gateway to be used  
     */
    private static $_apiClass = 'CheckoutapiClientClientgw3';


    /**
     * Helper static function to get singleton instance of a gateway interface.
     *
     * @param  array       $arguments A set arguments for initialising class constructor.
     * @param  null|string $_apiClass Gateway class name.
     * @return CheckoutapiClientClient An singleton instance of CheckoutapiClientClient
     * @throws Exception
     */

    public static function getApi(array $arguments = array(),$_apiClass = null)
    {
        if($_apiClass) {
            self::setApiClass($_apiClass);
        }
                
        //Initialise the exception library
        $exceptionState = CheckoutapiLibFactory::getSingletonInstance('CheckoutapiLibExceptionstate');
        $exceptionState->setErrorState(false);
        
        return CheckoutapiLibFactory::getSingletonInstance(self::getApiClass(), $arguments);
    }

    /**
     * Helpper static function for setting  for $_apiClass.
     *
     * @param CheckoutapiClientClient $apiClass gateway interface name
     */

    public static function setApiClass($apiClass)
    {
        self::$_apiClass = $apiClass;
    }

    /**
     * Helper static function  for retriving value of $_apiClass.
     *
     * @return CheckoutapiClientClient  $_apiClass
     */

    public static function getApiClass()
    {
        return self::$_apiClass;
    }
}
