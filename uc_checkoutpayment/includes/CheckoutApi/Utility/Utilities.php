<?php 
/**
 * CheckoutapiUtilityUtilities
 * A small utility class to wrap some of php function
 * 
 * @package api
 **/

final class CheckoutapiUtilityUtilities
{
    /**
     * Checkoutapi check if a php extension is loaded
     *
     * @param  $extension
     * @return bool
     */
    public static function checkExtension( $extension)
    {
        
        return extension_loaded($extension); 
    }

    /**
     * Checkoutapi print on screen any value given to it
     *
     * @param $toPrint mixed
     */
    public static function dump($toPrint)
    {
        echo '<pre>';
        print_r($toPrint);
        echo '</pre>';
    }
}
