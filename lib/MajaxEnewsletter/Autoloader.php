<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 6/2/11
 * Time: 10:24 AM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxEnewsletter_Autoloader {
  public static function register()
  {
    spl_autoload_register(array('MajaxEnewsletter_Autoloader', 'autoload'));
  }
  public static function autoload($class_name)
  {
    $base_path = dirname(__FILE__).'/../';
    $rel_path = str_replace('_', DIRECTORY_SEPARATOR, $class_name).'.php';
    $full_path = $base_path.DIRECTORY_SEPARATOR.$rel_path;
    if (file_exists($full_path))
    {
      require_once $full_path;
    }
  }
}
