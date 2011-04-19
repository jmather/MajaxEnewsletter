<?php

class majaxEnewsletterFormatter implements majaxEnewsletterFormatterInterface {
  protected $codes;
  protected $clear_unused_codes;

  public function __construct($codes = array(), $clear_unused_codes = false)
  {
    $this->setCodes($codes);
    $this->clearUnusedCodes($clear_unused_codes);
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

  public function clearUnusedCodes($clear_unused_codes)
  {
    $this->clear_unused_codes = $clear_unused_codes;
  }

  protected function getReplacePattern()
  {
    return '/{(.*)}/U';
  }

  public function render($text)
  {
    $pattern = $this->getReplacePattern();
    $function = $this->getCodeExpander();

    $content = preg_replace_callback($pattern, $function, $text);

    return $content;
  }

  /**
   * @throws InvalidArgumentException
   * @return closure
   */
  protected function getCodeExpander()
  {
    $codes = $this->codes;

    $clear_unused_codes = $this->clear_unused_codes;

    $function = function($matches) use ($codes, $clear_unused_codes)
    {
      $raw = $matches[0];
      $name = $matches[1];
      if (isset($codes[$name]))
        return $codes[$name];
      if (strpos($name, '.') !== false)
      {
        $pieces = explode('.', $name);

        if (count($pieces) > 2)
          throw new InvalidArgumentException('Relations more than two deep are not supported by '.get_class($this).'.');

        $main = $pieces[0];
        $child = $pieces[1];

        if (!isset($codes[$main]))
          return ($clear_unused_codes) ? '':$raw;

        $value = $codes[$main];

        if (!is_array($value) && !is_object($value))
        {
          return $value;
        }

        if (is_array($value))
        {
          if (isset($value[$child]))
          {
            return $value[$child];
          } else {
            return ($clear_unused_codes) ? '':$raw;
          }
        }

        if (is_object($value))
        {
          if (is_callable(array($value, $child)))
          {
            return call_user_func(array($value, $child));
          }

          if (isset($value->$child))
          {
            return $value->$child;
          }

          return ($clear_unused_codes) ? '':$raw;
        }
      }
      return ($clear_unused_codes) ? '':$raw;
    };

    return $function;
  }
}
