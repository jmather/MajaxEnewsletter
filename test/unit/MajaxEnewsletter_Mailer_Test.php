<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/20/11
 * Time: 8:32 AM
 * To change this template use File | Settings | File Templates.
 */
require_once dirname(__FILE__).'/../bootstrap/unit.php';
require_once __DIR__.'/../lib/MajaxEnewsletter_Subscriber_Provider_Fake.php';

class MajaxEnewsletter_Mailer_Test extends PHPUnit_Framework_TestCase
{
  /**
   * @var MajaxEnewsletter_Mailer
   */
  private $mailer;

  public function setUp()
  {
    $this->mailer = new MajaxEnewsletter_Mailer();
  }

  public function test_MailerSendsToMailerTransport()
  {
    $transport = $this->getMock('MajaxEnewsletter_Mailer_Transport_Interface', array('send'));

    $transport->expects($this->atLeastOnce())
              ->method('send')
              ->with($this->anything());


    $enewsletter = new MajaxEnewsletter_Message();
    $enewsletter->setFromEmail('from@example.com');
    $enewsletter->setFromName('From Name');
    $enewsletter->setSubject('Subject');
    $enewsletter->setHtmlBody('<p>Message</p>');
    $enewsletter->setTextBody('Message');

    $template = new MajaxEnewsletter_Template();
    $template->setHtmlTemplate('<p>Header</p>{{ enewsletter }}<p>Footer</p>');
    $template->setTextTemplate("Header\r\n\r\n{{ enewsletter }}\r\n\r\nFooter");
    $enewsletter->setTemplate($template);


    $provider = new MajaxEnewsletter_Subscriber_Provider_Fake(5);


    $builder = new MajaxEnewsletter_Email_Builder();

    $formatter = new MajaxEnewsletter_Formatter_TwigCompatible();
    $builder->setFormatter($formatter);


    $this->mailer->setEnewsletter($enewsletter);
    $this->mailer->setMessageBuilder($builder);
    $this->mailer->setSubscriberProvider($provider);
    $this->mailer->setTransport($transport);


    $this->mailer->send();
  }
}
