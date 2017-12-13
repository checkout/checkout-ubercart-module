<?php
function autoload($class) {


  $pathBase = __DIR__;

  $pathArray = explode('\\', $class);
  $nameClass = end($pathArray);
  $pathClass = str_replace('\\', DIRECTORY_SEPARATOR, $class);

  $fileName = '';

  $pathInclude = $pathBase . DIRECTORY_SEPARATOR . $pathClass . '.php';

  //error_log("A class path: " . $pathInclude);

  if ($file = stream_resolve_include_path($pathInclude)) {
    //error_log("Stream_resolve_include_path: " . $file);
    if (file_exists($file)) {
      require $file;
    }
  }
  elseif (preg_match('/^\\\?test/', $class)) {
    $fileName = preg_replace('/^\\\?test\\\/', '', $fileName);
    $fileName = 'test' . DIRECTORY_SEPARATOR . $fileName;
    include $fileName;

  }
  else {
    $nameArray = preg_split('/(?=[A-Z])/', $class);
    $includePath = get_include_path();
    set_include_path($includePath);

    if (!empty($nameArray) && sizeof($nameArray) > 1) {
      if (!class_exists('com\checkout\Packages\Autoloader')) {
        include 'com' . DIRECTORY_SEPARATOR . 'checkout' . DIRECTORY_SEPARATOR . 'Packages' . DIRECTORY_SEPARATOR . 'Autoloader.php';
      }
    }
  }
}

spl_autoload_register('autoload');
