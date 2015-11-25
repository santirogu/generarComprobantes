<?php

require 'Randomize.php';
require 'VouchersManager.php';
require 'XMLManager.php';
require 'TimeManager.php';
require 'Voucher.php';
require 'Party.php';
require 'Account.php';
require 'Item.php';
require 'PThread.php';

class Application{

    const msjQuantityErrr = "<div class='alert alert-warning'>Quantity can not be ZERO</div>";

    public static function Execute(){
        $TimeManager = new TimeManager();
        /* Thread Instance */
        $thread = new PThread();
        if($thread->start()){
            $thread->join();
        }
        self::generateAccounts();
        self::generateVouchersTemplate();
        self::generateParties();
        echo $TimeManager->end();
    }

    private static function generateVouchersTemplate(){
        if(isset($_GET['quantity'])){
            if(!is_array($_GET['quantity'])){
                if(is_numeric($_GET['quantity'])){
                    if($_GET['quantity']>=1){
                        $VoucherManager = new VouchersManager($_GET['quantity']);
                        $VoucherManager->listFiles();
                    }else{
                        echo self::msjQuantityErrr;
                    }
                }else{
                    echo self::msjQuantityErrr;
                }
            }
        }
    }

    private static function generateAccounts(){
        if(isset($_GET['show'])){
            if(!is_array($_GET['show'])){
                if($_GET['show']==='accounts'){
                    $account = XMLManager::listAccounts();
                    foreach($account as $val){
                        echo $val->__toString();
                    }
                }
            }
        }
    }

    private static function generateParties(){
        if(isset($_GET['show'])){
            if(!is_array($_GET['show'])){
                if($_GET['show']==='parties'){
                    $parties = XMLManager::listParties();
                    foreach($parties as $val){
                        echo $val->__toString();
                    }
                }
            }
        }
    }
}
