<?php 
/**
 * This class is used as signature  for all current and future adapters
 *
 * @package   Checkoutapi
 * @category  Adapter
 * @author    Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @copyright 2014 Integration team (http://www.checkout.com)
 **/
interface CheckoutapiClientAdapterInterface
{
    /**
     * Checkoutapi Read respond on the server
     * 
     * @return object
     **/

    public function request();
    
    /**
     * Checkoutapi Close all open connections and release all set variables
     **/

    public function close();

    /**
     * Checkoutapi Open a connection to server/URI
     *
     * @return resource
     **/

    public function connect();

    /**
     *  Set parameter $_config value
     *
     * @param array $array config array
     *
     * @return mixed
     **/

    public function setConfig($array = array());

    /**
     *  Return parameter value in $_config variable
     *
     * @param  string $key config name to retrive
     * @return mixed
     **/

    public function getConfig($key = null);
}
