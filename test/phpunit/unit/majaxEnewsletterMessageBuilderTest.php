<?php
require_once dirname(__FILE__).'/../../../../../test/phpunit/bootstrap/unit.php';
require_once dirname(__FILE__).'/../lib/majaxEnewsletterTestSubscriberProvider.php';

class unit_majaxEnewsletterMessageBuilderTest extends sfPHPUnitBaseTestCase
{
  /** @var majaxEnewsletterMessageBuilder */
  private $builder;

  public function setUp()
  {
    $this->builder = new majaxEnewsletterMessageBuilder();
  }

  /**
   * @return majaxEnewsletterFormatterInterface
   */
  private function getFormatter()
  {
    return new majaxEnewsletterTwigCompatibleFormatter();
  }

  public function test_BuildingAMessage()
  {
    // this makes us a bunch of fake subscribers to test.
    $subscriber_provider = new majaxEnewsletterTestSubscriberProvider(10);

    $subscribers = $subscriber_provider->getSubscribers();
    $subscriber = $subscribers[0];


    $enewsletter = new majaxEnewsletterContainer();

    $enewsletter->setFromEmail('from@example.com');
    $enewsletter->setFromName('Mr. From');
    $enewsletter->setSubject('Test Email');

    $html_body = '<p>{{ subscriber.name }},</p><p>Hello!</p>';
    $text_body = "{{ subscriber.name }},\r\n\r\nHello!";

    $enewsletter->setHtmlBody($html_body);
    $enewsletter->setTextBody($text_body);

    $html_template = '<p>Enewsletter</p> {{ enewsletter.html }} <p>Footer</p>';
    $text_template = "Enewsletter\r\n\r\n{{ enewsletter.text }}\r\n\r\nFooter";

    $email_template = new majaxEnewsletterTemplateContainer($html_template, $text_template);

    $enewsletter->setTemplate($email_template);

    $this->builder->setEnewsletter($enewsletter);

    $formatter = $this->getFormatter();
    $this->builder->setFormatter($formatter);

    $this->builder->setEmailClass('majaxEnewsletterEmailContainer');


    $message = new majaxEnewsletterMessageContainer($subscriber);

    $email = $this->builder->build($message);
  }
}

