<?php

class PThread extends Thread{
    public $data;
    public function run(){
        $this->data = 'result';
    }
}
/**
 * Created by Santiago RG.
 * User: Asus X452E A4
 * Date: 24/11/2015
 * Time: 23:20
 */