<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 1:54 AM
 * To change this template use File | Settings | File Templates.
 */

interface majaxEnewsletterMessageBuilderInterface {
  public function setFormatter(majaxEnewsletterFormatterInterface $formatter);
  public function setEnewsletter(majaxEnewsletterInterface $enewsletter);
  public function setEmailClass($email_class);
  public function build(majaxEnewsletterMessageInterface $message);
}
