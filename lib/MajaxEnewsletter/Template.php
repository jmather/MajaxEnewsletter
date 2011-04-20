<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 9:48 AM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxEnewsletter_Template implements MajaxEnewsletter_Template_Interface {
  private $html_template;
  private $text_template;

  /**
   * @param string $html_template
   * @param string $text_template
   */
  public function __construct($html_template = '', $text_template = '')
  {
    $this->setHtmlTemplate($html_template);
    $this->setTextTemplate($text_template);
  }

  /**
   * @param string $html_template
   */
  public function setHtmlTemplate($html_template)
  {
    $this->html_template = $html_template;
  }

  /**
   * @param string $text_template
Z  */
  public function setTextTemplate($text_template)
  {
    $this->text_template = $text_template;
  }

  /**
   * @return string
   */
  public function getHtmlTemplate()
  {
    return $this->html_template;
  }

  /**
   * @return string
   */
  public function getTextTemplate()
  {
    return $this->text_template;
  }
}
