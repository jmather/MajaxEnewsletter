<?php
require_once dirname(__FILE__).'/../bootstrap/unit.php';

class unit_MajaxEnewsletter_Formatter_Test extends PHPUnit_Framework_TestCase
{
  /**
   * @var MajaxEnewsletter_Formatter
   */
  private $formatter;

  public function setUp()
  {
    $this->formatter = new MajaxEnewsletter_Formatter();
  }

  /**
   * @dataProvider FormatterReplacesTextProperlyProvider
   */
  public function test_FormatterReplacesTextProperly($original, $codes, $expected)
  {
    $this->formatter->setCodes($codes);

    $actual = $this->formatter->render($original);

    $this->assertEquals($expected, $actual);
  }

  public function FormatterReplacesTextProperlyProvider()
  {
    return array(
      array('{message}', array('message' => 'hello'), 'hello'),
      array('{m1} {m2}', array('m1' => 'msg1', 'm2' => 'msg2'), 'msg1 msg2'),
      array('{user.name}', array('user' => array('name' => 'hello')), 'hello'),
    );
  }

  public function test_FormatterAcceptsCodesFromConstructor()
  {
    $codes = array('a' => 'a', 'b' => 'b', 'c' => 'c');
    $formatter = new MajaxEnewsletter_Formatter($codes);
    $actual = $formatter->render('{a} {b} {c}');
    $this->assertEquals('a b c', $actual);
  }

  public function test_FormatterAcceptsCodesFromSetCode()
  {
    $this->formatter->resetCodes();

    $text = '{a} {b} {c}';

    $this->formatter->setCode('a', 'a');
    $actual = $this->formatter->render($text);
    $this->assertEquals($actual, 'a {b} {c}');

    $this->formatter->setCode('b', 'b');
    $actual = $this->formatter->render($text);
    $this->assertEquals($actual, 'a b {c}');

    $this->formatter->setCode('c', 'c');
    $actual = $this->formatter->render($text);
    $this->assertEquals($actual, 'a b c');
  }

  public function test_FormatterUnsetsCodes()
  {
    $this->formatter->setCodes(array('a'=>'a', 'b' => 'b', 'c'=>'c'));

    $text = '{a} {b} {c}';

    $this->formatter->unsetCode('a');
    $actual = $this->formatter->render($text);
    $this->assertEquals($actual, '{a} b c');

    $this->formatter->unsetCode('b');
    $actual = $this->formatter->render($text);
    $this->assertEquals($actual, '{a} {b} c');

    $this->formatter->unsetCode('c');
    $actual = $this->formatter->render($text);
    $this->assertEquals($actual, $text);
  }
}
