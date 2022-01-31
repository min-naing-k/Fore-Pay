<?php

namespace App\View\Components\Backend;

use Illuminate\View\Component;

class App extends Component
{
  public $title;

  public function __construct($title = 'Fore Pay')
  {
    $this->title = $title;
  }
  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('backend.layouts.app');
  }
}
