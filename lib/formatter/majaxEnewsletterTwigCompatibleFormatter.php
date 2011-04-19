<?php

class majaxEnewsletterTwigCompatibleFormatter extends majaxEnewsletterFormatter {
  public function render($text)
  {
    $codes = $this->codes;
    $function = function($matches) use ($codes)
    {
      if (isset($codes[$matches[1]]))
        return $codes[$matches[1]];
      return '';
    };
    $content = preg_replace_callback('/{{ (.*) }}/U', $function, $text);
    
    return $content;
  }
}
