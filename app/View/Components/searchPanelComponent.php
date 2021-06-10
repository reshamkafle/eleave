<?php

namespace App\View\Components;

use Illuminate\View\Component;
   
class searchPanelComponent extends Component
{

    public $companies;
    public $link;

    public function __construct($companies, $link)
    {
        $this->companies = $companies;
        $this->link = $link;
    }
    public function render()
    {
        return view('components.search-panel-component');
    }
}
