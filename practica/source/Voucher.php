<?php

class Voucher{

    public $fileName = 'Voucher-?.xml';
    public $fileTemplate = "xml/vouchers.xml";
    public $type = '';
    public $id = '';
    public $date = '';
    public $note = '';
    public $companyCode = '';
    public $companyName = '';
    public $thirdCode = '';
    public $thirdName = '';
    public $total = 0;
    public $items = array();
    /* XML Arrays */
    public $arrayOfParties;
    public $arrayOfAccounts;
    /* XML DOM */
    private $xmlDom = NULL;

    public function __construct(){

        /* Common Voucher info */
        $this->id = Randomize::ID();
        $this->date = Randomize::ISSUEDATE();
        $this->note = Randomize::NOTE();
        $this->type = "Egresos";
        $this->arrayOfAccounts = XMLManager::listAccounts();
        $this->arrayOfParties = XMLManager::listParties();

        $index = rand(1,count($this->arrayOfParties))-1;
        $ctxAuxParties = $this->arrayOfParties[$index];
        $this->companyCode = $ctxAuxParties->id;
        $this->companyName = $ctxAuxParties->name;

        $index = rand(1,count($this->arrayOfParties))-1;
        $ctxAuxParties = $this->arrayOfParties[$index];
        $this->thirdCode = $ctxAuxParties->id;
        $this->thirdName = $ctxAuxParties->name;
        $this->total = rand(10,100)*0.891821*10000;

        $randomItem = rand(1,10);
        for($j=1; $j <= $randomItem; $j++){
            $item = new Item($this->arrayOfAccounts,$this->arrayOfParties);
            array_push($this->items,$item);
        }

        $this->fileName = preg_replace('/\?/',$this->id,$this->fileName);
        $this->storage();
       // die($this->fileName);

        //$this->xmlDom = $vectorXML['XMLDOM'];

        $rnd = Randomize::rndPos($this->arrayOfParties);


    }
    public function storage(){
        $doc = new DOMDocument();
        $doc->load($this->fileTemplate);

        $element = $doc->getElementsByTagName("Tipo");
        $element->item(0)->nodeValue = $this->type;

        $element = $doc->getElementsByTagName("Numero");
        $element->item(0)->nodeValue = $this->id;

        $element = $doc->getElementsByTagName("Fecha");
        $element->item(0)->nodeValue = $this->date;

        $element = $doc->getElementsByTagName("Nota");
        $element->item(0)->nodeValue = $this->note;

        $codes = $doc->getElementsByTagName("Codigo");
        $names = $doc->getElementsByTagName("Nombre");

        $codes->item(0)->nodeValue = $this->companyCode;
        $names->item(0)->nodeValue = $this->companyName;

        $codes->item(1)->nodeValue = $this->thirdCode;
        $names->item(1)->nodeValue = $this->thirdName;

        $element = $doc->getElementsByTagName("Valor");
        $element->item(0)->nodeValue = $this->total;

        $contabilizacion = $doc->getElementsByTagName("Contabilizacion");

        for($x = 0; $x < count($this->items); $x++){
            $item = $this->items[$x];

            $asiento = $doc->createElement("Asiento","");
            $book = $doc->createElement("Libro","COMUN");
            $debit = $doc->createElement("Debito",$item->debit);
            $credit = $doc->createElement("Credito",$item->credit);

            $accountCode = $doc->createElement("Codigo",$item->accountCode);
            $accountName = $doc->createElement("Nombre",$item->accountName);
            $account = $doc->createElement("Cuenta","");
            $account->appendChild($accountCode);
            $account->appendChild($accountName);

            $thirdCode = $doc->createElement("Codigo",$item->thirdCode);
            $thirdName = $doc->createElement("Nombre",$item->thirdName);
            $third = $doc->createElement("Tercero","");
            $third->appendChild($thirdCode);
            $third->appendChild($thirdName);

            $asiento->appendChild($book);
            $asiento->appendChild($account);
            $asiento->appendChild($third);
            $asiento->appendChild($debit);
            $asiento->appendChild($credit);

            $contabilizacion->item(0)->appendChild($asiento);
        }

        $doc->save("vouchers/{$this->id}.xml");
    }
}
/**
 * Created by Santiago RG.
 * User: Asus X452E A4
 * Date: 17/11/2015
 * Time: 18:47
 */