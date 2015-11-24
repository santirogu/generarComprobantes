<?php

class XMLManager{

    const accounts = 'xml/accounts.xml';
    const parties = 'xml/parties.xml';
    const vouchers = 'xml/vouchers.xml';

    public static function listAccounts(){
        $doc = new DOMDocument();
        $doc->load(self::accounts);
        $codes = $doc->getElementsByTagName("Codigo");
        $names = $doc->getElementsByTagName("Nombre");
        //return value structure
        $listAccounts = array();
        $codeArray = array();
        $nameArray = array();
        //main information array
        foreach($codes as $node) {
            array_push($codeArray,$node->nodeValue);
        }
        foreach($names as $node) {
            array_push($nameArray,$node->nodeValue);
        }
        for($i = 0; $i < count($codeArray); $i++){
            $code = $codeArray[$i];
            $name = $nameArray[$i];
            $account = new Account($code, $name);
            array_push($listAccounts,$account);
        }
        return $listAccounts;
    }

    public static function listParties(){
        $doc = new DOMDocument();
        $doc->load(self::parties);
        $codes = $doc->getElementsByTagName("Codigo");
        $names = $doc->getElementsByTagName("Nombre");
        //return value structure
        $listParties = array();
        $codeArray = array();
        $nameArray = array();
        //main information array
        foreach($codes as $node) {
            array_push($codeArray,$node->nodeValue);
        }
        foreach($names as $node) {
            array_push($nameArray,$node->nodeValue);
        }
        for($i = 0; $i < count($codeArray); $i++){
            $code = $codeArray[$i];
            $name = $nameArray[$i];
            $account = new Account($code, $name);
            array_push($listParties,$account);
        }
        return $listParties;
    }

    public static function vouchersTemplate(){
        $DOM = new DOMDocument();
        $DOM->load(self::vouchers);
        return $DOM;
    }

    public static function accountsToSave($quantityAcconts){
        /* DOM variable */
        $dom = self::vouchersTemplate();

        /* Collection Accounts */
        $XMLAccountArray = [];
        $accountArray = self::listAccounts();

        for ($i = 1; $i <= $quantityAcconts ; $i++){
            /* Rnd collection position */
            $pos = rand(0,count($accountArray));

            /* Account values */
            $bookValue = $accountArray[$pos]->book;
            $accountCode = $accountArray[$pos]->accountCode;
            $accountName = $accountArray[$pos]->accountName;
            $thirdCode = $accountArray[$pos]->thirdCode;
            $thirdName = $accountArray[$pos]->thirdName;
            $debits = $accountArray[$pos]->debits;
            $credits = $accountArray[$pos]->credits;

            /* value to DOM value */
            $bookDOM = $dom->createTextNode($bookValue);
            $accountCodeDOM = $dom->createTextNode($accountCode);
            $accountNameDOM = $dom->createTextNode($accountName);
            $thirdCodeDOM = $dom->createTextNode($thirdCode);
            $thirdNameDOM = $dom->createTextNode($thirdName);
            $debitsDOM = $dom->createTextNode($debits);
            $creditsDOM = $dom->createTextNode($credits);

            /* define XML Tags */
            $asientoTag = $dom->createElement('ns1:Asiento');
            $bookTag = $dom->createElement('Libro');
            $accountTag = $dom->createElement('Cuenta');
            $accountCodeTag = $dom->createElement('Codigo');
            $accountNameTag = $dom->createElement('Nombre');
            $thirdTag = $dom->createElement('Tercero');
            $thirdCodeTag = $dom->createElement('Codigo');
            $thirdNameTag = $dom->createElement('Nombre');
            $debitsTag = $dom->createElement('Debitos');
            $creditsTag = $dom->createElement('Creditos');

            /* add DOM values to Tags */
            $bookTag->appendChild($bookDOM);
            $accountCodeTag->appendChild($accountCodeDOM);
            $accountNameTag->appendChild($accountNameDOM);
            $thirdCodeTag->appendChild($thirdCodeDOM);
            $thirdNameTag->appendChild($thirdNameDOM);
            $debitsTag->appendChild($debitsDOM);
            $creditsTag->appendChild($creditsDOM);

            /* Mix internal Hierarchies */
            $accountTag->appendChild($accountCodeTag);
            $accountTag->appendChild($accountNameTag);
            $thirdTag->appendChild($thirdCodeTag);
            $thirdTag->appendChild($thirdNameTag);

            /* Mix external Hierarchies */
            $asientoTag->appendChild($bookTag);
            $asientoTag->appendChild($accountTag);
            $asientoTag->appendChild($thirdTag);
            $asientoTag->appendChild($debitsTag);
            $asientoTag->appendChild($creditsTag);

            /* Add XMLaccount to XMLaccountArray */
            array_push($XMLAccountArray,$asientoTag);
        }

        /* return XMLaccountArray with quantity length */
        return ['XMLAccountArray'=>$XMLAccountArray,'XMLDOM'=>$dom];
    }
}

/**
 * Created by Santiago RG.
 * User: Asus X452E A4
 * Date: 13/11/2015
 * Time: 11:31
 */