<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 2:38 PM
 * To change this template use File | Settings | File Templates.
 */

interface MajaxEnewsletter_Mailer_Interface {
  /**
   * @abstract
   * @param MajaxEnewsletter_Mailer_Transport_Interface $transport
   */
  public function setTransport(MajaxEnewsletter_Mailer_Transport_Interface $transport);

  /**
   * @abstract
   * @param MajaxEnewsletter_Subscriber_Provider_Interface $provider
   */
  public function setSubscriberProvider(MajaxEnewsletter_Subscriber_Provider_Interface $provider);

  /**
   * @abstract
   * @param MajaxEnewsletter_Email_Builder_Interface $builder
   */
  public function setMessageBuilder(MajaxEnewsletter_Email_Builder_Interface $builder);

  /**
   * @abstract
   * @param string $class_name
   */
  public function setMessageClass($class_name);

  public function send(MajaxEnewsletter_Message_Interface $enewsletter);
}