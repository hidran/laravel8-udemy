<?php

namespace App\View\Components;

use Illuminate\View\Component;

class alertInfo extends Component
{
    public $message ;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->message = session()->get('message');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.alert-info');
    }
}
