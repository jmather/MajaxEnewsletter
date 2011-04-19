<?php

class majaxEnewsletterTwigCompatibleFormatter extends majaxEnewsletterFormatter {

  public function __construct($codes = array(), $clear_unused_codes = true)
  {
    parent::__construct($codes, $clear_unused_codes);
  }

  protected function getReplacePattern()
  {
    return '/{{ (.*) }}/U';
  }
}
