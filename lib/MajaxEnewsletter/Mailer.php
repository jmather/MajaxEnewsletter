<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 2:48 PM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxEnewsletter_Mailer implements MajaxEnewsletter_Mailer_Interface
{
  /**
   * @var MajaxEnewsletter_Interface
   */
  private $enewsletter;

  /**
   * @var MajaxEnewsletter_Subscriber_Provider_Interface
   */
  private $subscriber_publisher;

  /**
   * @var MajaxEnewsletter_Mailer_Transport_Interface
   */
  private $transport;

  /**
   * @var MajaxEnewsletter_Email_Builder_Interface
   */
  private $builder;

  private $message_class;

  public function __construct(
    MajaxEnewsletter_Subscriber_Provider_Interface $subscriber_published = null,
    MajaxEnewsletter_Mailer_Transport_Interface $transport = null,
    MajaxEnewsletter_Email_Builder_Interface $builder = null,
    $message_class = 'MajaxEnewsletter_QueueEntry')
  {
    if ($subscriber_published !== null)
      $this->setSubscriberProvider($subscriber_published);

    if ($transport !== null)
      $this->setTransport($transport);

    if ($builder !== null)
      $this->setMessageBuilder($builder);

    $this->setMessageClass($message_class);
  }

  public function send(MajaxEnewsletter_Message_Interface $enewsletter)
  {
    $subscribers = $this->subscriber_publisher->getSubscribers($enewsletter);

    /** @var MajaxEnewsletter_Subscriber_Interface $subscriber */
    foreach($subscribers as $subscriber)
    {
      $message_class = $this->message_class;
      /** @var MajaxEnewsletter_QueueEntry_Interface $message */
      $message = new $message_class($subscriber);

      $email = $this->builder->build($enewsletter, $message);

      $this->transport->send($email);
    }
  }

  /**
   * @param MajaxEnewsletter_Subscriber_Provider_Interface $provider
   */
  public function setSubscriberProvider(MajaxEnewsletter_Subscriber_Provider_Interface $provider)
  {
    $this->subscriber_publisher = $provider;
  }

  /**
   * @param MajaxEnewsletter_Mailer_Transport_Interface $transport
   */
  public function setTransport(MajaxEnewsletter_Mailer_Transport_Interface $transport)
  {
    $this->transport = $transport;
  }

  /**
   * @param string $class_name
   */
  public function setMessageClass($class_name)
  {
    $this->message_class = $class_name;
  }

  /**
   * @param MajaxEnewsletter_Email_Builder_Interface $builder
   */
  public function setMessageBuilder(MajaxEnewsletter_Email_Builder_Interface $builder)
  {
    $this->builder = $builder;
  }
}
