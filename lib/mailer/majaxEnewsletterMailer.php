<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 2:48 PM
 * To change this template use File | Settings | File Templates.
 */
 
class majaxEnewsletterMailer implements majaxEnewsletterMailerInterface
{
  /**
   * @var majaxEnewsletterInterface
   */
  private $enewsletter;

  /**
   * @var majaxEnewsletterSubscriberProviderInterface
   */
  private $subscriber_publisher;

  /**
   * @var majaxEnewsletterMailerTransportInterface
   */
  private $transport;

  /**
   * @var majaxEnewsletterMessageBuilderInterface
   */
  private $builder;

  private $message_class;

  public function __construct(
    majaxEnewsletterInterface $enewsletter = null,
    majaxEnewsletterSubscriberProviderInterface $subscriber_published = null,
    majaxEnewsletterMailerTransportInterface $transport = null,
    majaxEnewsletterMessageBuilderInterface $builder = null,
    $message_class = 'majaxEnewsletterMessageContainer')
  {
    if ($enewsletter !== null)
      $this->setEnewsletter($enewsletter);

    if ($subscriber_published !== null)
      $this->setSubscriberProvider($subscriber_published);

    if ($transport !== null)
      $this->setTransport($transport);

    if ($builder !== null)
      $this->setMessageBuilder($builder);

    $this->setMessageClass($message_class);
  }

  public function send()
  {
    $subscribers = $this->subscriber_publisher->getSubscribers();
    foreach($subscribers as $subscriber)
    {
      /** @var majaxEnewsletterSubscriberInterface $subscriber */
      $message_class = $this->message_class;
      /** @var majaxEnewsletterMessageInterface $message */
      $message = new $message_class($subscriber);

      $email = $this->builder->build($message);

      $this->transport->send($email);
    }
  }

  /**
   * @param majaxEnewsletterInterface $enewsletter
   */
  public function setEnewsletter(majaxEnewsletterInterface $enewsletter)
  {
    $this->enewsletter = $enewsletter;
  }

  /**
   * @param majaxEnewsletterSubscriberProviderInterface $provider
   */
  public function setSubscriberProvider(majaxEnewsletterSubscriberProviderInterface $provider)
  {
    $this->subscriber_publisher = $provider;
  }

  /**
   * @param majaxEnewsletterMailerTransportInterface $transport
   */
  public function setTransport(majaxEnewsletterMailerTransportInterface $transport)
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
   * @param majaxEnewsletterMessageBuilderInterface $builder
   */
  public function setMessageBuilder(majaxEnewsletterMessageBuilderInterface $builder)
  {
    $this->builder = $builder;
  }
}
