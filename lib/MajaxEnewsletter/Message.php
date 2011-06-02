<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 9:10 AM
 * To change this template use File | Settings | File Templates.
 */

class MajaxEnewsletter_Message implements MajaxEnewsletter_Message_Interface {
  /**
   * @var string
   */
  private $from_email;

  /**
   * @var string
   */
  private $from_name;

  /**
   * @var string
   */
  private $subject;

  /**
   * @var string
   */
  private $html_body;

  /**
   * @var string
   */
  private $text_body;

  /**
   * @var MajaxEnewsletter_Template_Interface
   */
  private $template;

  public function __construct()
  {
    $this->from_email = '';
    $this->from_name = '';
    $this->subject = '';
    $this->html_body = '';
    $this->text_body = '';
    $this->template = null;
  }

  /**
   * @param string $from_email
   */
  public function setFromEmail($from_email)
  {
    $this->from_email = $from_email;
  }

  /**
   * @param string $from_name
   */
  public function setFromName($from_name)
  {
    $this->from_name = $from_name;
  }

  /**
   * @param string $subject
   */
  public function setSubject($subject)
  {
    $this->subject = $subject;
  }

  /**
   * @param string $html_body
   */
  public function setHtmlBody($html_body)
  {
    $this->html_body = $html_body;
  }

  /**
   * @param string $text_body
   */
  public function setTextBody($text_body)
  {
    $this->text_body = $text_body;
  }

  /**
   * @param MajaxEnewsletter_Template_Interface $template
   */
  public function setTemplate(MajaxEnewsletter_Template_Interface $template)
  {
    $this->template = $template;
  }

  /**
   * @return string
   */
  public function getFromEmail()
  {
    return $this->from_email;
  }

  /**
   * @return string
   */
  public function getFromName()
  {
    return $this->from_name;
  }

  /**
   * @return string
   */
  public function getHtmlBody()
  {
    return $this->html_body;
  }

  /**
   * @return string
   */
  public function getSubject()
  {
    return $this->subject;
  }

  /**
   * @return MajaxEnewsletter_Template_Interface
   */
  public function getTemplate()
  {
    return $this->template;
  }

  /**
   * @return string
   */
  public function getTextBody()
  {
    return $this->text_body;
  }
}
