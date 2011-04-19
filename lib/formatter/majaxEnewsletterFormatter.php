<?php

class majaxEnewsletterFormatter implements majaxEnewsletterFormatterInterface {
  protected $codes;

  public function __construct($codes = array())
  {
    $this->codes = $codes;
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

  public function render($text)
  {
    $replace_keys = array();
    $replace_values = array();
    foreach($this->codes as $name => $val)
    {
      array_push($replace_keys, '{'.$name.'}');
      array_push($replace_values, $val);
    }

    return str_replace($replace_keys, $replace_values, $text);
  }
}
