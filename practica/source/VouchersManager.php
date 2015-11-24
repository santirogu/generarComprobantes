<?php

class VouchersManager{
    const path = 'vouchers/';
    const linkPath = '/practica/vouchers/';

    public function __construct($vouchersQuantity = 0){
        $this->removeFiles();
        $this->createFiles($vouchersQuantity);
    }

    public function listFiles(){
        $counter = 1;
        $dir = opendir(self::path);
        while($element = readdir($dir)){
            if($element != "." && $element != ".."){
                if(!is_dir(self::path.$element)){
                    echo $this->format($counter,self::linkPath.$element);
                    $counter++;
                }
            }
        }
    }

    private function removeFiles(){
        $dir = opendir(self::path);
        while($element = readdir($dir)){
            if($element != "." && $element != ".."){
                if(!is_dir(self::path.$element)){
                    unlink(self::path.$element);
                }
            }
        }
        closedir($dir);
    }

    private function format($name, $path){
        return "<div class='col-md-4'>
                    <h2>Vouchers {$name}</h2>
                    <p>Generated Vourchers</p>
                    <p>
                        <a class='btn btn-default' href='{$path}' role='button'>View Details &raquo;</a>
                    </p>
                </div>\n";
    }

    private  function  createFiles($quantity = 0){
        for($i = 1; $i <= $quantity; $i++){
            $Voucher = new Voucher();
            $Voucher->storage();
        }
    }
}

/**
 * Created by Santiago RG.
 * User: Asus X452E A4
 * Date: 17/11/2015
 * Time: 18:31
 */