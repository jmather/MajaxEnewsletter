<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 1:38 AM
 * To change this template use File | Settings | File Templates.
 */
 
interface MajaxEnewsletter_Subscriber_Interface {
  /**
   * @abstract
   * @return string
   */
  public function getEmail();

  /**
   * @abstract
   * @return string
   */
  public function getName();
}
