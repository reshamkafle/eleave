<?php

namespace App\View\Components;

use Illuminate\View\Component;


class searchPanelComponentForCountry extends Component
{
    public $countries;
    public $link;

    public function __construct($countries, $link)
    {
        $this->countries = $countries;
        $this->$link = $link;
    }

    public function render()
    {
        return view('components.search-panel-component-for-country');
    }
}