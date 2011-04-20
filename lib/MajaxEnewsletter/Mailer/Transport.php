<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/20/11
 * Time: 1:51 AM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxEnewsletter_Mailer_Transport implements MajaxEnewsletter_Mailer_Transport_Interface
{
  /**
   * @param MajaxEnewsletter_Email_Interface $email
   */
  public function send(MajaxEnewsletter_Email_Interface $email)
  {
    error_log('Sent the following message to: '.$email->getToEmail()."\r\n\r\n".$email->getTextContent());
  }
}
