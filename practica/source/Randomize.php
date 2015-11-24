<?php

final class Randomize{

    public static function ID(){
        return rand(100,999)."".rand(100,999)."".rand(100,999)."1";
    }

    public static function number(){
        $n = self::randomString(10);
        return $n;
    }

    public static function NOTE(){
        $number = rand(0,100);
        $string = hash_hmac('sha256',$number,$number);
        return substr($string,0,250);
    }
    public static function ISSUEDATE(){
        $Date = new DateTime('now');
        $randomDate = mt_rand($Date->getTimestamp(),$Date->getTimestamp()+15000000);
        $newRanDate = date("Y-m-d",$randomDate);
        return $newRanDate;
    }

    private static function randomString($len){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private static function RandomPosition($collection){
        $x = count($collection);
        return rand(0,$x-1);
    }

    public static function rndPos($collection){
        $x = self::RandomPosition($collection);
        $y = self::RandomPosition($collection);
        if($x==$y){
            while($x==$y){
                $y = Randomize::RandomPosition($collection);
            }
        }
        return ['Company'=>$x,'Third'=>$y];
    }
}
/**
 * Created by Santiago RG.
 * User: Asus X452E A4
 * Date: 17/11/2015
 * Time: 19:02
 */