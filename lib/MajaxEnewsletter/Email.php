<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 2:23 AM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxEnewsletter_Email implements MajaxEnewsletter_Email_Interface
{
  private $headers;
  private $from_email;
  private $from_name;
  private $to_email;
  private $to_name;
  private $subject;
  private $html_content;
  private $text_content;

  public function __construct()
  {
    $this->headers = array();
    $this->from_email = '';
    $this->from_name = '';
    $this->to_email = '';
    $this->to_name = '';
    $this->subject = '';
    $this->html_content = '';
    $this->text_content = '';
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
   * @return string[]
   */
  public function getHeaders()
  {
    return $this->headers;
  }

  /**
   * @return string
   */
  public function getHtmlContent()
  {
    return $this->html_content;
  }

  /**
   * @return string
   */
  public function getSubject()
  {
    return $this->subject;
  }

  /**
   * @return string
   */
  public function getTextContent()
  {
    return $this->text_content;
  }

  /**
   * @return string
   */
  public function getToEmail()
  {
    return $this->to_email;
  }

  /**
   * @return string
   */
  public function getToName()
  {
    return $this->to_name;
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
   * @param string $header
   * @param string $content
   */
  public function setHeader($header, $content)
  {
    if ($content === null && isset($this->headers[$header]))
    {
      unset($this->headers[$header]);
    }
    $this->headers[$header] = $content;
  }

  /**
   * @param string $content
   */
  public function setHtmlContent($content)
  {
    $this->html_content = $content;
  }

  /**
   * @param string $subject
   */
  public function setSubject($subject)
  {
    $this->subject = $subject;
  }

  /**
   * @param string $content
   */
  public function setTextContent($content)
  {
    $this->text_content = $content;
  }

  /**
   * @param string $to_email
   */
  public function setToEmail($to_email)
  {
    $this->to_email = $to_email;
  }

  /**
   * @param string $to_name
   */
  public function setToName($to_name)
  {
    $this->to_name = $to_name;
  }
}
