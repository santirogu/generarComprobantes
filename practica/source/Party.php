<?php

class Party{
    public $code = '';
    public $name = '';

    public function __construct($code, $name) {
        $this->name = $name;
        $this->code = $code;
    }

    private function format($name){
        return "<tr><td>{$name}</td></tr>";
    }

    public function __toString() {
        return  "<div class='col-md-4'><table class='table table-striped table-hovered table-bordered'>"
        . "<tr><th>Party</th></tr>"
        . $this->code($this->code)
        . $this->format($this->name)
        . "</table></div>";
    }

}

/**
 * Created by Santiago RG.
 * User: Asus X452E A4
 * Date: 17/11/2015
 * Time: 18:18
 */