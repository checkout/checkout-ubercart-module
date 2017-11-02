<?php 
/**
 * CheckoutapiClientAdapterAbstract
 *
 * CheckoutapiClientAdapterAbstract An abstract class for CheckoutapiClient adapters.
 * An adapter can be define a method of transmitting message over http protocol
 * It encapsulate all basic and core method required by an adpater
 *
 * @package   Checkoutapi
 * @category  Cleint
 * @author    Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @copyright 2014 Integration team (http://www.checkout.com)
 */
abstract class CheckoutapiClientAdapterAbstract extends CheckoutapiLibObject
{
    /**
     * 
     *
     * @var string$_uri Checkoutapi server identifier 
     */

    protected $_uri = null;
    /**
     * 
     *
     * @var resource|null $_resource  Checkoutapi The server session handler 
     */
    protected $_resource = null;
    /**
     * 
     *
     * @var mixed $_respond  Checkoutapi Respond return by the server 
     */
    protected $_respond = null;


    /**
     * Constructor for Adapters
     *
     * @param  array $arguments Array of configuration for constructor
     * @throws Exception
     */

    public function __construct( array $arguments = array() ) 
    { 
        if(isset($arguments['uri']) && $uri = $arguments['uri'] ) {
            $this->setUri($uri);
        }
        
        if(isset($arguments['config']) && $config = $arguments['config'] ) {

            $this->setConfig($arguments['config']);
        }
   
    }

     /**
      *  Set/Get attribute wrapper
      *
      * @param  string $method Method being call
      * @param  array  $args   Argument being pass
      * @return mixed
      */

    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
        case 'get' :
                
            $key = substr($method, 3);
            $key = lcfirst($key);
            $data = $this->getConfig($key, isset($args[0]) ? $args[0] : null);
                
            return $data;

        case 'set' :
                
            $key =substr($method, 3);
            $key = lcfirst($key);
            $result = $this->setConfig($key, isset($args[0]) ? $args[0] : null);
      
            return $result;

           
        }

        //throw new Exception("Invalid method ".get_class($this)."::".$method."(".print_r($args,1).")");

        $this->exception(
            "Invalid method ".get_class($this)."::".$method."(".print_r($args, 1).")",
            debug_backtrace()
        );

        return null;
    }

    /**
     *  setter for $_uri
     *
     * @param string $uri setting the url value
     **/

    public function setUri($uri)
    { 

        $this->_uri = $uri;
    }

    /**
     *  Getter for $_uri
     *
     * @return string
     **/

    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * Setter for $_resource
     *
     * @var resource $resource
     **/

    public function setResource($resource) 
    {
        $this->_resource = $resource;
    }


    /**
     * Getter for $_resource
     * 
     * @return resource
     **/

    public function getResource()
    {
        return $this->_resource;
    }

    /**
     * Checkoutapi_ Setter for respond
     *
     * @param mixed $respond responnd obtain by gateway
     **/

    public function setRespond($respond)
    {
        $this->_respond = $respond;
    }

    /**
     * Checkoutapi_ Getter for respond
     * 
     * @return mixed
     **/
     
    public function getRespond()
    {
        return $this->_respond;
    }

    /**
     * Create a connection using the adapter
     *
     * @return $this CheckoutapiClientAdapterAbstract
     */
    public function connect() 
    {
        return $this;
    }

    /**
     * Close all resource
     */
    public function close()
    {
        $this->setResource(null);
        $this->setRespond(null);
    }

    public function getResourceInfo() 
    {

        return array('httpStatus'=>'');
    }

    /**
     * Return request made by the adapter
     *
     * @return CheckoutapiLibRespondobj
     */
    abstract function request();


}
