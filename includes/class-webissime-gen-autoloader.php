<?php defined('ABSPATH') || exit();
/**
 * Project: Webissime Gen plugin
 * File: class-webissime-gen-autoloader.php
 * Author: Mathieu Alboré
 *
 * @Description Class autoloader for Webissime Gen plugin
 * @since        1.0.0
 */

if (!class_exists('Webissime_Gen_autoloader')):
  class Webissime_Gen_autoloader
  {
    /**
     * Singleton
     *
     * @var null Single instance
     */
    private static $_instance = null;

    /**
     * Webissime_Gen_autoloader constructor.
     *
     */
    private function __construct()
    {
      spl_autoload_register([$this, 'load']);
    }

    /**
     * Singleton method
     *
     * If it has not already been done, creates and return an instance of the class
     *
     * @author RR PhF
     * @since  1.0.0
     *
     * @static
     * @return \Webissime_Gen_autoloader
     */
    public static function get_instance()
    {
      if (!self::$_instance) {
        self::$_instance = new self();
      }

      return self::$_instance;
    }

    /**
     * Class loader
     *
     * Converts the name of the class to a file name and includes the class file.
     *
     * @author RR PhF
     * @since  1.0.0
     *
     * @param string $class_name - class to load
     */
    public function load($class_name)
    {
      //Converts the class name to a file name
      $class_file = str_replace('_', '-', strtolower($class_name));
      $class_file = 'class-' . $class_file;
      $class_file = __DIR__ . '/' . $class_file;

      // do the autoloading
      spl_autoload($class_file, '.php');
    }

    /**
     * Make sure an instance can't be cloned
     *
     * @author RR PhF
     * @since  1.0.0
     *
     */
    private function __clone()
    {
      // do nothing
    }
  }

  Webissime_Gen_autoloader::get_instance();
endif;
