<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 1:54 AM
 * To change this template use File | Settings | File Templates.
 */

interface MajaxEnewsletter_Email_Builder_Interface {
  public function setFormatter(MajaxEnewsletter_Formatter_Interface $formatter);
  public function setEmailClass($email_class);
  /**
   * @abstract
   * @param MajaxEnewsletter_Message_Interface $enewsletter
   * @param MajaxEnewsletter_QueueEntry_Interface $queue_entry
   * @return MajaxEnewsletter_Email_Interface
   */
  public function build(MajaxEnewsletter_Message_Interface $enewsletter, MajaxEnewsletter_QueueEntry_Interface $queue_entry);
}
