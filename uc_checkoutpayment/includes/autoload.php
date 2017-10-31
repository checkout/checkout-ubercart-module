<?php

/**
 * Auto load the included methods.
 */
class Api_Autoloader {

  private static $_instance;

  /**
   * Get an instance of a method.
   *
   * @return object instance of the requested class
   */
  public static function instance() {
    if (!self::$_instance) {
        $class = __CLASS__;
        self::$_instance = new $class();
    }
    return self::$_instance;
  }

  /**
   * Get an instance of a class.
   * 
   * @param string $class the name of the class
   * 
   * @return object instance of the requested class
   */
  public function autoload($class) {
      $classNameArray = explode('_',$class);
      $includePath = get_include_path();
      set_include_path($includePath);
      $path = '';

      if(!empty($classNameArray)) {
          $path = __DIR__.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $classNameArray). '.php';
          if(file_exists($path)) {
              require_once $path;
          }
      } else {
         throw new Exception("Unable to load $class.");
      }
  }

  /**
   * Register an method to autoload
   * 
   * @return void
   */
  public static function register() {
    spl_autoload_extensions('.php');
    spl_autoload_register(array(self::instance(), 'autoload'));
  }

}

$autoload = new Api_Autoloader();
Api_Autoloader::register();
