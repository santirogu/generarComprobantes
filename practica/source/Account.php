<?php

class Account{
    public $id = '';
    public $name = '';

    function  __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }

    private  function  format($n){
        return "<tr><td>{$n}</td></tr>";
    }

    public function __toString(){
        return "<div class='col-md-4'><table class='table table-striped table-hovered table-bordered'>"
                ."<tr><th>Account</th></tr>"
                .$this->format($this->id)
                .$this->format($this->name)
                ."</table></div>";
    }
}

/**
 * Created by Santiago RG.
 * User: Asus X452E A4
 * Date: 17/11/2015
 * Time: 18:01
 */