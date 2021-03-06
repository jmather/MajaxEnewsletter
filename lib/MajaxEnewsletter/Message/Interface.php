<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 1:55 AM
 * To change this template use File | Settings | File Templates.
 */

interface MajaxEnewsletter_Message_Interface {
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
   * @return MajaxEnewsletter_Template_Interface
   */
  public function getTemplate();
}
