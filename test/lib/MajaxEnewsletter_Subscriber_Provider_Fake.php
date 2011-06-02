<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 8:57 AM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxEnewsletter_Subscriber_Provider_Fake implements MajaxEnewsletter_Subscriber_Provider_Interface {
  /**
   * @var SubscriberInterface[]
   */
  private $subscribers;

  public function __construct($subscriber_count = 0)
  {
    for ($i = 0; $i < $subscriber_count; $i++)
    {
      $sub = new MajaxEnewsletter_Subscriber();
      $fn = $this->generateFirstName();
      $ln = $this->generateLastName();
      $email = strtolower($fn.'.'.$ln.'@example.com');
      $name = $fn.' '.$ln;
      $sub->setName($name);
      $sub->setEmail($email);
      $this->subscribers[] = $sub;
    }
  }

  /**
   * @param \MajaxEnewsletter_Message_Interface $enewsletter
   * @return integer
   */
  public function getCount(MajaxEnewsletter_Message_Interface $enewsletter)
  {
    return count($this->subscribers);
  }

  /**
   * @param \MajaxEnewsletter_Message_Interface $enewsletter
   * @return MajaxEnewsletter_Subscriber_Interface[]
   */
  public function getSubscribers(MajaxEnewsletter_Message_Interface $enewsletter)
  {
    return $this->subscribers;
  }

  private function generateFirstName()
  {
    $names = array('Bob', 'Ted', 'Jane', 'Jack', 'Jill', 'Peter');
    $num = rand() % count($names);
    return $names[$num];
  }

  private function generateLastName()
  {
    $names = array('Smith', 'Jones', 'Wayne', 'Goose', 'Piper');
    $num = rand() % count($names);
    return $names[$num];
  }
}
