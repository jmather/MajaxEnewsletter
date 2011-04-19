<?php
require_once dirname(__FILE__).'/../../../../../test/phpunit/bootstrap/unit.php';

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

    $formatter = $this->getFormatter();

    $enewsletter =
  }
}

