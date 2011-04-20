<?php

class MajaxEnewsletter_Formatter_Twig implements MajaxEnewsletter_Formatter_Interface {
  private $codes;
  private $cache_location;

  public function __construct($codes = array(), $cache_location = false)
  {
    $this->codes = $codes;
    $this->cache_location = $cache_location;
  }

  public function setCodes($codes)
  {
    $this->codes = $codes;
  }

  public function setCode($code, $value)
  {
    $this->codes[$code] = $value;
  }

  public function unsetCode($code)
  {
    if (isset($this->codes[$code]))
    {
      unset($this->codes[$code]);
    }
  }

  public function resetCodes()
  {
    $this->codes = array();
  }

  /**
   * @param string $string
   * @return Twig_TemplateInterface
   */
  private function getTwigTemplate($string)
  {
    $loader = new Twig_Loader_String();
    $twig = new Twig_Environment($loader, array(
      'cache' => $this->cache_location,
      )
    );

    $template = $twig->loadTemplate($string);
    return $template;
  }

  public function render($text)
  {
    $twig = $this->getTwigTemplate($text);

    $content = $twig->render($this->codes);

    return $content;
  }
}
