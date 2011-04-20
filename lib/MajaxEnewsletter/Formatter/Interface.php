<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 12:29 AM
 * To change this template use File | Settings | File Templates.
 */

interface MajaxEnewsletter_Formatter_Interface {
  /**
   * @abstract
   * @param array $codes
   */
  public function setCodes($codes);

  /**
   * @abstract
   * @param string $code
   * @param mixed $value
   */
  public function setCode($name, $value);

  /**
   * @abstract
   * @param string $name
   */
  public function unsetCode($name);

  /**
   * @abstract
   */
  public function resetCodes();

  /**
   * @abstract
   * @param string $text
   * @return string
   */
  public function render($text);
}
