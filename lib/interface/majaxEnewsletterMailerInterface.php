<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 2:38 PM
 * To change this template use File | Settings | File Templates.
 */

interface majaxEnewsletterMailerInterface {
  /**
   * @abstract
   * @param majaxEnewsletterMailerTransportInterface $transport
   */
  public function setTransport(majaxEnewsletterMailerTransportInterface $transport);

  /**
   * @abstract
   * @param majaxEnewsletterInterface $enewsletter
   */
  public function setEnewsletter(majaxEnewsletterInterface $enewsletter);

  /**
   * @abstract
   * @param majaxEnewsletterSubscriberProviderInterface $provider
   */
  public function setSubscriberProvider(majaxEnewsletterSubscriberProviderInterface $provider);

  /**
   * @abstract
   * @param majaxEnewsletterMessageBuilderInterface $builder
   */
  public function setMessageBuilder(majaxEnewsletterMessageBuilderInterface $builder);

  /**
   * @abstract
   * @param string $class_name
   */
  public function setMessageClass($class_name);
  public function send();
}