<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 3:11 PM
 * To change this template use File | Settings | File Templates.
 */

interface MajaxEnewsletter_Mailer_Transport_Interface {
  /**
   * @param MajaxEnewsletter_Email_Interface $email
   */
  public function send(MajaxEnewsletter_Email_Interface $email);
}
