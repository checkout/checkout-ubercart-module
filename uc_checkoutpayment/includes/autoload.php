<?php

/**
 * Auto load the included methods.
 */
class UcCheckoutpaymentApiAutoloader
{

    private static $_instance;

    /**
     * Get an instance of a method.
     *
     * @return object
     *   Instance of the requested class.
     */
    public static function instance() 
    {
        if (!self::$_instance) {
            $class = __CLASS__;
            self::$_instance = new $class();
        }
        return self::$_instance;
    }

    /**
     * Get an instance of a class.
     *
     * @param string $class
     *   The name of the class.
     */
    public function autoload($class) 
    {
        // if (strpos($class, "_")) {
        //   $classNameArray = explode('_', $class);
        // }
        // else {
        $classNameArray = preg_split('/(?=[A-Z])/', $class);
        // }

        $includePath = get_include_path();
        set_include_path($includePath);
        $path = '';

        if (!empty($classNameArray)) {
            $path = __DIR__ . implode(DIRECTORY_SEPARATOR, $classNameArray) . '.php';
            error_log($path, 0);
            if (file_exists($path)) {
                include_once $path;
            }
        }
        else {
            throw new Exception("Unable to load $class.");
        }
    }

    /**
     * Register an method to autoload.
     */
    public static function register() 
    {
        spl_autoload_extensions('.php');
        spl_autoload_register(array(self::instance(), 'autoload'));
    }

}

$autoload = new UcCheckoutpaymentApiAutoloader();
UcCheckoutpaymentApiAutoloader::register();
