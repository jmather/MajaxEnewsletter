<?php
require_once dirname(__FILE__).'/../bootstrap/unit.php';
require_once __DIR__.'/../lib/MajaxEnewsletter_Subscriber_Provider_Fake.php';

class unit_MajaxEnewsletter_Message_Builder_Test extends PHPUnit_Framework_TestCase
{
  /** @var MajaxEnewsletter_Email_Builder */
  private $builder;

  public function setUp()
  {
    $this->builder = new MajaxEnewsletter_Email_Builder();
  }

  /**
   * @return MajaxEnewsletter_Formatter_Interface
   */
  private function getFormatter()
  {
    return new MajaxEnewsletter_Formatter_TwigCompatible();
  }

  public function test_BuildingAMessage()
  {
    $enewsletter = new MajaxEnewsletter_Message();

    $enewsletter->setFromEmail('from@example.com');
    $enewsletter->setFromName('Mr. From');
    $enewsletter->setSubject('Test Email');

    $html_body = '<p>{{ subscriber.name }},</p><p>Hello!</p>';
    $text_body = "{{ subscriber.name }},\r\n\r\nHello!";

    $enewsletter->setHtmlBody($html_body);
    $enewsletter->setTextBody($text_body);

    $html_template = '<p>Enewsletter</p>{{ enewsletter }}<p>Footer</p>';
    $text_template = "Enewsletter\r\n\r\n{{ enewsletter }}\r\n\r\nFooter";

    $email_template = new MajaxEnewsletter_Template($html_template, $text_template);

    $enewsletter->setTemplate($email_template);


    // this makes us a bunch of fake subscribers to test.
    $subscriber_provider = new MajaxEnewsletter_Subscriber_Provider_Fake(10);

    $subscribers = $subscriber_provider->getSubscribers($enewsletter);
    /** @var $subscriber MajaxEnewsletter_Subscriber_Interface */
    $subscriber = $subscribers[0];



    $formatter = $this->getFormatter();
    $this->builder->setFormatter($formatter);

    $this->builder->setEmailClass('MajaxEnewsletter_Email');

    $message = new MajaxEnewsletter_QueueEntry($subscriber);

    $email = $this->builder->build($enewsletter, $message);

    $this->assertEquals('from@example.com', $email->getFromEmail());
    $this->assertEquals('Mr. From', $email->getFromName());
    $this->assertEquals($subscriber->getEmail(), $email->getToEmail());
    $this->assertEquals($subscriber->getName(), $email->getToName());
    $this->assertEquals('Test Email', $email->getSubject());
    $this->assertEquals('<p>'.$subscriber->getName().',</p><p>Hello!</p>', $email->getHtmlBody());
    $this->assertEquals($subscriber->getName().",\r\n\r\nHello!", $email->getTextBody());
    $this->assertEquals('<p>Enewsletter</p><p>'.$subscriber->getName().',</p><p>Hello!</p><p>Footer</p>', $email->getHtmlContent());
    $this->assertEquals("Enewsletter\r\n\r\n".$subscriber->getName().",\r\n\r\nHello!\r\n\r\nFooter", $email->getTextContent());
  }
}

