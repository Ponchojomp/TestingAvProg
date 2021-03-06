<?php
// Jeg jobber med denne nå - Mathias
// Jeg også - Leo
include_once '../Model/domeneModell.php';
    class AdminDBStub
    {
        function hentAlleKunder()
    {
           $alleKunder = array();
           $kunde1 = new kunde();
           $kunde1->personnummer ="01010122344";
           $kunde1->fornavn = "Per";
           $kunde1->etternavn = "Olsen";
           $kunde1->adresse = "Osloveien 82 0270 Oslo";
           $kunde1->telefonnr="12345678";
           $kunde1->passord="123456";
           $alleKunder[]=$kunde1;
           $kunde2 = new kunde();
           $kunde2->personnummer ="01010122344";
           $kunde2->fornavn = "Line";
           $kunde2->etternavn = "Jensen";
           $kunde2->adresse = "Askerveien 100, 1379 Asker";
           $kunde2->telefonnr="92876789";
           $alleKunder[]=$kunde2;
           $kunde3 = new kunde();
           $kunde3->personnummer ="02020233455";
           $kunde3->fornavn = "Ole";
           $kunde3->etternavn = "Olsen"; 
           $kunde3->adresse = "Bærumsveien 23, 1234 Bærum";
           $kunde3->telefonnr="99889988";
           $alleKunder[]=$kunde3;
           return $alleKunder;
    }
    
        function hentTransaksjoner($kontoNr,$fraDato,$tilDato)
        {
            date_default_timezone_set("Europe/Oslo");
            $fraDato = strtotime($fraDato);
            $tilDato = strtotime($tilDato);
            if($fraDato>$tilDato)
            {
                return "Fra dato må være større enn tildato";
            }
            $konto = new konto();
            $konto->personnummer="010101234567";
            $konto->kontonummer=$kontoNr;
            $konto->type="Sparekonto";
            $konto->saldo =2300.34;
            $konto->valuta="NOK";
            if($tilDato < strtotime('2015-03-26'))
            {
                return $konto;
            }
            $dato = $fraDato;
            while ($dato<=$tilDato)
            {
                switch($dato)
                {
                    case strtotime('2015-03-26') :
                        $transaksjon1 = new transaksjon();
                        $transaksjon1->dato='2015-03-26';
                        $transaksjon1->transaksjonBelop=134.4;
                        $transaksjon1->fraTilKontonummer="22342344556";
                        $transaksjon1->melding="Meny Holtet";
                        $konto->transaksjoner[]=$transaksjon1;
                        break;
                    case strtotime('2015-03-27') :
                        $transaksjon2 = new transaksjon();
                        $transaksjon2->dato='2015-03-27';
                        $transaksjon2->transaksjonBelop=-2056.45;
                        $transaksjon2->fraTilKontonummer="114342344556";
                        $transaksjon2->melding="Husleie";
                        $konto->transaksjoner[]=$transaksjon2; 
                        break;
                    case strtotime('2015-03-29') :
                        $transaksjon3 = new transaksjon();
                        $transaksjon3->dato = '2015-03-29';
                        $transaksjon3->transaksjonBelop=1454.45;
                        $transaksjon3->fraTilKontonummer="114342344511";
                        $transaksjon3->melding="Lekeland";
                        $konto->transaksjoner[]=$transaksjon3;
                        break;
                }
                $dato +=(60*60*24); // en dag i tillegg i sekunder
            }
            return $konto;
        }
        
        function endreKundeInfo($kunde){
            If($kunde->P==-1){
                return "Feil";
            }
            return "OK";
        }
        
        function registrerKunde($kunde){
            If($kunde->ID ==-1){
                return "Feil";
            }
            return "OK";
        }
        
        
        function slettKunde($personnummer){
            If($personnummer->ID ==-1){
                return "Feil";
            }
            return "OK";
        }
        
        function registrerKonto($konto){
            If($konto->ID ==-1){
                return "Feil";
            }
            return "OK";
        }
        function endreKonto($konto){
            If($konto->ID ==-1){
                return "Feil";
            }
            return "OK";
        }
        
        function hentAlleKonti(){
            $konti = new konto();
            $konti->personnummer = "12345678901";
            $konti->kontonummer = "1234567890";
            $konti->saldo = "100";
            $konti->type = "testkonto";
            $konti->valuta = "nok";
            return $konti;
        }
       
        function slettKonto($kontonummer){
            If($kontonummer->ID ==-1){
                return "Feil";
            }
            return "OK";
        }
    }
    
