<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 1:54 AM
 * To change this template use File | Settings | File Templates.
 */

interface MajaxEnewsletter_QueueEntry_Builder_Interface {
  public function setFormatter(MajaxEnewsletter_Formatter_Interface $formatter);
  public function setEnewsletter(MajaxEnewsletter_Message_Interface $enewsletter);
  public function setEmailClass($email_class);
  public function build(MajaxEnewsletter_QueueEntry_Interface $message);
}
