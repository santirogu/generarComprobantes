<?php

class TimeManager{
    public $INIT_TIME = NULL;
    public $FINAL_TIME = NULL;

    public function __construct(){
        date_default_timezone_set('America/Bogota');
        $this->INIT_TIME = new DateTime('now');
    }

    public function end(){
        $this->FINAL_TIME = new DateTime('now');
        return $this->toString();
    }

    private function interval(){
        $interval = $this->INIT_TIME->diff($this->FINAL_TIME);
        return $interval->format('%i Minutes %s Seconds ');
    }

    public function toString(){
        return '</div><div class="row"><div class="alert alert-default"> <b>Start time:</b> '.$this->INIT_TIME->format('h : i : s').'<br/>'.
        '<b>End time:</b>  '.$this->FINAL_TIME->format('h : i : s').'<br/>'.
        '<b>Total time:</b> '.$this->interval().'</div>';
    }
}
/**
 * Created by Santiago RG.
 * User: Asus X452E A4
 * Date: 17/11/2015
 * Time: 18:56
 */