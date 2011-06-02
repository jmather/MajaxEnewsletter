<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 2:17 AM
 * To change this template use File | Settings | File Templates.
 */

interface MajaxEnewsletter_Email_Interface {
  /**
   * @abstract
   * @param string $subject
   */
  public function setSubject($subject);

  /**
   * @abstract
   * @param string $from_name
   */
  public function setFromName($from_name);

  /**
   * @abstract
   * @param string $from_email
   */
  public function setFromEmail($from_email);

  /**
   * @abstract
   * @param string $to_name
   */
  public function setToName($to_name);

  /**
   * @abstract
   * @param string $to_email
   */
  public function setToEmail($to_email);

  /**
   * @abstract
   * @param string $content
   */
  public function setHtmlContent($content);

  /**
   * @abstract
   * @param string $content
   */
  public function setTextContent($content);

  /**
   * @abstract
   * @param string $body
   */
  public function setHtmlBody($body);

  /**
   * @abstract
   * @param string $body
   */
  public function setTextBody($body);

  /**
   * @abstract
   * @param string $header
   * @param string $content
   */
  public function setHeader($header, $content);

  /**
   * @abstract
   * @return string
   */
  public function getSubject();

  /**
   * @abstract
   * @return string
   */
  public function getFromName();

  /**
   * @abstract
   * @return string
   */
  public function getFromEmail();

  /**
   * @abstract
   * @return string
   */
  public function getToName();

  /**
   * @abstract
   * @return string
   */
  public function getToEmail();

  /**
   * @abstract
   * @return string
   */
  public function getHtmlContent();

  /**
   * @abstract
   * @return string
   */
  public function getTextContent();

  /**
   * @abstract
   * @return string
   */
  public function getHtmlBody();

  /**
   * @abstract
   * @return string
   */
  public function getTextBody();

  /**
   * @abstract
   * @return string[]
   */
  public function getHeaders();
}
