<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 3:11 PM
 * To change this template use File | Settings | File Templates.
 */

interface majaxEnewsletterMailerTransportInterface {
  public function send(majaxEnewsletterMessageInterface $message);
}
