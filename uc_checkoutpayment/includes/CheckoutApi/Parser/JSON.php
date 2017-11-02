<?php
/**
 * Class CheckoutapiParserJSON
 * a parser to handle JSON
 *
 * @package   Checkoutapi
 * @category  Api
 * @author    Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @copyright 2014 Integration team (http://www.checkout.com)
 */
class CheckoutapiParserJSON extends CheckoutapiParserParser
{
    /**
     * 
     *
     * @var array $_headers  Content negotiation relies on the use of specific headers 
     */
    protected $_headers = array ('Content-Type: application/json;charset=UTF-8','Accept: application/json');

    /**
     * Convert a json to a CheckoutapiLibRespondObj object
     *
     * @param  JSON $parser
     * @return CheckoutapiLibRespondObj|null
     * @throws Exception
     */
    public function parseToObj($parser)
    {
        /**
* 
         *
 * @var CheckoutapiLibRespondObj $respondObj 
*/
        $respondObj = CheckoutapiLibFactory::getInstance('CheckoutapiLibRespondObj');

        if($parser && is_string($parser)) {
            $encoding = mb_detect_encoding($parser);
            
            if($encoding =="ASCII") {
                $parser = iconv('ASCII', 'UTF-8', $parser);
            }else {
                $parser =  mb_convert_encoding($parser, "UTF-8", $encoding);
            }
            
            $jsonObj = json_decode($parser, true);
            $jsonObj['rawOutput'] = $parser;

            $respondObj->setConfig($jsonObj);


        }
        $respondObj->setConfig($this->getResourceInfo());
        return $respondObj;
    }

    /**
     * This method prepare a posted value, so it match the header of the parser
     *
     * @param  mixed $postedparam
     * @return JSON
     */
    public function preparePosted($postedParam)
    {
        return json_encode($postedParam);
    }
    public function setResourceInfo($info)
    {
        $this->_info = $info;
    }
}
