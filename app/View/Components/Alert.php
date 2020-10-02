<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $info;
    public $message ;
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $name='',$info ='', $message ='')
    {
       $this->info = $info;
       $this->message = $message;
       $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {

        return view('components.alert');
    }
}
