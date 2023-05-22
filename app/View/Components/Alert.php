<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $messages;
    public $type;
    public function __construct($messages)
    {
        $this->messages = $messages;
        $this->type = (gettype($this->messages) == "object") ? 'danger' : 'success';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (gettype($this->messages) == "object" || $this->messages != '') {
            return view('components.alert');
        }
    }
}
