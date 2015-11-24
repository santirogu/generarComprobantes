<?php


Class Item {

    public $accountCode = "";
    public $accountName = "";
    public $thirdCode = "";
    public $thirdName = "";
    public $debit = "";
    public $credit = "";
    public $libro = "COMUN";

    public function __construct($accountList, $partieList)
    {
        $index = rand(1,count($partieList))-1;
        $ctxAuxParties = $partieList[$index];
        $this->thirdCode = $ctxAuxParties->id;
        $this->thirdName = $ctxAuxParties->name;

        $index = rand(1,count($accountList))-1;
        $ctxAuxAccount = $accountList[$index];
        $this->accountCode = $ctxAuxAccount->id;
        $this->accountName = $ctxAuxAccount->name;

        $this->debit = rand(0,100);
        $this->credit = ($this->debit == 0)?rand(0,100):0;

    }

}