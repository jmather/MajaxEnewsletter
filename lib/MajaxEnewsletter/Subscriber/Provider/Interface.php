<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 1:35 AM
 * To change this template use File | Settings | File Templates.
 */

interface MajaxEnewsletter_Subscriber_Provider_Interface {
  /**
   * @abstract
   * @return integer
   */
  public function getCount();

  /**
   * @abstract
   * @return MajaxEnewsletter_Subscriber_Interface[]
   */
  public function getSubscribers();
}
