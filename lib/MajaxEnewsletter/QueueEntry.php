<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 9:57 AM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxEnewsletter_QueueEntry implements MajaxEnewsletter_QueueEntry_Interface {
  private $subscriber;
  private $unique_id;

  public function __construct(MajaxEnewsletter_Subscriber_Interface $subscriber, $unique_id = null)
  {
    $this->subscriber = $subscriber;
    if ($unique_id === null)
    {
      $this->unique_id = md5(microtime().rand());
    } else
      $this->unique_id = $unique_id;
  }

  /**
   * @return MajaxEnewsletter_Subscriber_Interface
   */
  public function getSubscriber()
  {
    return $this->subscriber;
  }

  /**
   * @return string
   */
  public function getUniqueId()
  {
    return $this->unique_id;
  }
}
