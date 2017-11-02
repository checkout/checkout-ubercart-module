<?php
/**
 * An abstract class that contain the basic functionally all parser need to inherit

 * @package   Checkoutapi
 * @category  Api
 * @author    Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @copyright 2014 Integration team (http://www.checkout.com)
 */

abstract class CheckoutapiParserParser extends CheckoutapiLibObject
{
    /**
     * @var $_headers  array Checkoutapi hold value for headers to be send by the transport message layer
     */
    protected $_headers = array();

    /**
     * 
     *
     * @var $_respondObj null|CheckoutapiLibRespondobj  * Checkoutapi hold an  value for 
     */
    protected $_respondObj = null;
    protected $_info = array( 'httpStatus'=>0);

    /**
     * This method need to be implimented by all children. It take a string, parse it  and then map it to an object
     *
     * @param  $parser
     * @return CheckoutapiLibRespondobj
     */
    abstract public function parseToObj($parser);

    /**
     * setter $_respondObj
     *
     * @param $obj CheckoutapiLibRespondobj
     */
    public function setRespondobj($obj)
    {
        $this->_respondObj = $obj;
    }

    /**
     * @getter  $_respondObj
     * @return CheckoutapiLibRespondobj|null
     */
    public function getRespondobj()
    {
        return $this->_respondObj ;
    }

    /**
     *  getter $_headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->_headers;
    }

    /**
     *  format the value base on the parser type
     *
     * @param  $postedParam
     * @return mixed
     */
    abstract public function preparePosted($postedParam);
    abstract public function setResourceInfo($info);
    public function getResourceInfo()
    {
        return $this->_info;
    }
}
