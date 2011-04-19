<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 1:46 AM
 * To change this template use File | Settings | File Templates.
 */

interface majaxEnewsletterTemplateInterface {
  /**
   * @abstract
   * @return string
   */
  public function getHtmlTemplate();

  /**
   * @abstract
   * @return string
   */
  public function getTextTemplate();
}
