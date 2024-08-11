<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardLive extends Component
{
    public $title;

    public function mount()
    {
        $this->title = __('title.dashboard');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
