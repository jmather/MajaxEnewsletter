<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 1:35 AM
 * To change this template use File | Settings | File Templates.
 */

interface majaxEnewsletterSubscriberProviderInterface {
  /**
   * @abstract
   * @return integer
   */
  public function getCount();

  /**
   * @abstract
   * @return majaxEnewsletterSubscriberInterface[]
   */
  public function getSubscribers();
}
