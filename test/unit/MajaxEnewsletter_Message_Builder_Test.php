<?php
require_once dirname(__FILE__).'/../bootstrap/unit.php';
require_once dirname(__FILE__).'/../lib/MajaxEnewsletter_Subscriber_Provider_Test.php';

class unit_MajaxEnewsletter_Message_Builder_Test extends PHPUnit_Framework_TestCase
{
  /** @var MajaxEnewsletter_Message_Builder */
  private $builder;

  public function setUp()
  {
    $this->builder = new MajaxEnewsletter_Message_Builder();
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
    // this makes us a bunch of fake subscribers to test.
    $subscriber_provider = new MajaxEnewsletter_Subscriber_Provider_Test(10);

    $subscribers = $subscriber_provider->getSubscribers();
    $subscriber = $subscribers[0];


    $enewsletter = new MajaxEnewsletter();

    $enewsletter->setFromEmail('from@example.com');
    $enewsletter->setFromName('Mr. From');
    $enewsletter->setSubject('Test Email');

    $html_body = '<p>{{ subscriber.name }},</p><p>Hello!</p>';
    $text_body = "{{ subscriber.name }},\r\n\r\nHello!";

    $enewsletter->setHtmlBody($html_body);
    $enewsletter->setTextBody($text_body);

    $html_template = '<p>Enewsletter</p> {{ enewsletter.html }} <p>Footer</p>';
    $text_template = "Enewsletter\r\n\r\n{{ enewsletter.text }}\r\n\r\nFooter";

    $email_template = new MajaxEnewsletter_Template($html_template, $text_template);

    $enewsletter->setTemplate($email_template);

    $this->builder->setEnewsletter($enewsletter);

    $formatter = $this->getFormatter();
    $this->builder->setFormatter($formatter);

    $this->builder->setEmailClass('MajaxEnewsletter_Email');


    $message = new MajaxEnewsletter_Message($subscriber);

    $email = $this->builder->build($message);
  }
}

