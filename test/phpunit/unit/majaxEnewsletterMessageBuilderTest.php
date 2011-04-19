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
  public function test_BuildingAMessage()
  {
    
  }
}

class majaxEnewsletterSubscriber