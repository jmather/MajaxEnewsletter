<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 2:00 AM
 * To change this template use File | Settings | File Templates.
 */

interface majaxEnewsletterMessageInterface {
  /**
   * @abstract
   * @return majaxEnewsletterSubscriberInterface
   */
  public function getSubscriber();

  /**
   * @abstract
   * @return string
   */
  public function getUniqueId();
}
