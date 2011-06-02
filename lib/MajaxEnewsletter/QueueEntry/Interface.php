<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 2:00 AM
 * To change this template use File | Settings | File Templates.
 */

interface MajaxEnewsletter_QueueEntry_Interface {
  /**
   * @abstract
   * @return MajaxEnewsletter_Subscriber_Interface
   */
  public function getSubscriber();

  /**
   * @abstract
   * @return string
   */
  public function getUniqueId();
}
