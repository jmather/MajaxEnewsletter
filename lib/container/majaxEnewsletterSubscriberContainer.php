<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 8:51 AM
 * To change this template use File | Settings | File Templates.
 */
 
class majaxEnewsletterSubscriberContainer implements majaxEnewsletterSubscriberInterface
{
  private $email;
  private $name;

  /**
   * @param string $email
   */
  public function setEmail($email)
  {
    $this->email = $email;
  }

  /**
   * @param string $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
}
