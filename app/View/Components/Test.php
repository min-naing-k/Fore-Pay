<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Test extends Component
{
  public $text;

  public function __construct($text)
  {
    $this->text = $text;
  }

  public function render()
  {
    return view('components.test');
  }
}
