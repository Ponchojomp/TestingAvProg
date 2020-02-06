<?php
include_once '../Model/domeneModell.php';
include_once '../DAL/bankDatabaseStub.php';
include_once '../BLL/bankLogikk.php';

class bankLogikkTest extends PHPUnit\Framework\TestCase {
    
    public function testDatoFeilTransaksjoner() 
    {
        // arrange
        $kontoNr = "10502023523";
        $fraDato = '2015-03-27';
        $tilDato = '2015-03-22';
        $bank=new Bank(new BankDBStub());
        // act
        $konto= $bank->hentTransaksjoner($kontoNr, $fraDato, $tilDato);
        // assert
        $this->assertEquals("Fra dato må være større enn tildato",$konto); 
    }
    
    public function testIngenTransaksjoner() 
    {
        // arrange
        $kontoNr = "10502023523";
        $fraDato = '2015-03-20';
        $tilDato = '2015-03-22';
        $bank=new Bank(new BankDBStub());
        // act
        $konto= $bank->hentTransaksjoner($kontoNr, $fraDato, $tilDato);
        // assert
        $this->assertEquals("010101234567",$konto->personnummer); 
        $this->assertEquals($kontoNr,$konto->kontonummer);
        $this->assertEquals("Sparekonto",$konto->type);
        $this->assertEquals(2300.34,$konto->saldo); 
        $this->assertEquals("NOK",$konto->valuta); 
        $tomtArray = array();
        $this->assertEquals($tomtArray,$konto->transaksjoner);
    }
     
    public function testEnTransaksjon() 
    {
        // arrange
        $kontoNr = "10502023523";
        $fraDato = '2015-03-26';
        $tilDato = '2015-03-26';
        $bank=new Bank(new BankDBStub());
        // act
        $konto= $bank->hentTransaksjoner($kontoNr, $fraDato, $tilDato);
        // assert
        $this->assertEquals("010101234567",$konto->personnummer); 
        $this->assertEquals($kontoNr,$konto->kontonummer);
        $this->assertEquals("Sparekonto",$konto->type);
        $this->assertEquals(2300.34,$konto->saldo); 
        $this->assertEquals("NOK",$konto->valuta); 
        $this->assertEquals('2015-03-26',$konto->transaksjoner[0]->dato);
        $this->assertEquals(134.4,$konto->transaksjoner[0]->transaksjonBelop);
        $this->assertEquals("22342344556",$konto->transaksjoner[0]->fraTilKontonummer);
        $this->assertEquals("Meny Holtet",$konto->transaksjoner[0]->melding);
    }
    public function testToTransaksjoner() 
    {
        // arrange
        $kontoNr = "10502023523";
        $fraDato = '2015-03-27';
        $tilDato = '2015-03-30';
        $bank=new Bank(new BankDBStub());
        // act
        $konto= $bank->hentTransaksjoner($kontoNr, $fraDato, $tilDato);
        // assert
        $this->assertEquals("010101234567",$konto->personnummer); 
        $this->assertEquals($kontoNr,$konto->kontonummer);
        $this->assertEquals("Sparekonto",$konto->type);
        $this->assertEquals(2300.34,$konto->saldo); 
        $this->assertEquals("NOK",$konto->valuta); 
        $this->assertEquals('2015-03-27',$konto->transaksjoner[0]->dato);
        $this->assertEquals(-2056.45,$konto->transaksjoner[0]->transaksjonBelop);
        $this->assertEquals("114342344556",$konto->transaksjoner[0]->fraTilKontonummer);
        $this->assertEquals("Husleie",$konto->transaksjoner[0]->melding);
        $this->assertEquals('2015-03-29',$konto->transaksjoner[1]->dato);
        $this->assertEquals(1454.45,$konto->transaksjoner[1]->transaksjonBelop);
        $this->assertEquals("114342344511",$konto->transaksjoner[1]->fraTilKontonummer);
        $this->assertEquals("Lekeland",$konto->transaksjoner[1]->melding);
    }
    public function testAlleTransaksjoner() 
    {
        // arrange
        $kontoNr = "10502023523";
        $fraDato = '2015-03-26';
        $tilDato = '2015-03-30';
        $bank=new Bank(new BankDBStub());
        // act
        $konto= $bank->hentTransaksjoner($kontoNr, $fraDato, $tilDato);
        // assert
        $this->assertEquals("010101234567",$konto->personnummer); 
        $this->assertEquals($kontoNr,$konto->kontonummer);
        $this->assertEquals("Sparekonto",$konto->type);
        $this->assertEquals(2300.34,$konto->saldo); 
        $this->assertEquals("NOK",$konto->valuta);
        $this->assertEquals('2015-03-26',$konto->transaksjoner[0]->dato);
        $this->assertEquals(134.4,$konto->transaksjoner[0]->transaksjonBelop);
        $this->assertEquals("22342344556",$konto->transaksjoner[0]->fraTilKontonummer);
        $this->assertEquals("Meny Holtet",$konto->transaksjoner[0]->melding);
        $this->assertEquals('2015-03-27',$konto->transaksjoner[1]->dato);
        $this->assertEquals(-2056.45,$konto->transaksjoner[1]->transaksjonBelop);
        $this->assertEquals("114342344556",$konto->transaksjoner[1]->fraTilKontonummer);
        $this->assertEquals("Husleie",$konto->transaksjoner[1]->melding);
        $this->assertEquals('2015-03-29',$konto->transaksjoner[2]->dato);
        $this->assertEquals(1454.45,$konto->transaksjoner[2]->transaksjonBelop);
        $this->assertEquals("114342344511",$konto->transaksjoner[2]->fraTilKontonummer);
        $this->assertEquals("Lekeland",$konto->transaksjoner[2]->melding);
    }
    public function testSjekkLoggInn(){
        //arrange
        $personnummer ="01010122344";
        $personnummerFeil ="0101012";
        //$navn = "Per Olsen";
        //$adresse = "Osloveien 82 0270 Oslo";
        //$telefonnr="12345678";
        $passord="123456";
        $passordFeil="123";
        $bank=new Bank(new BankDBStub());
        //assert
        $this->assertEquals("OK",$bank->sjekkLoggInn($personnummer, $passord));
        $this->assertEquals("Feil i personnummer",$bank->sjekkLoggInn($personnummerFeil, $passord));
        $this->assertEquals("Feil i passord",$bank->sjekkLoggInn($personnummer, $passordFeil));
    }
    
    public function testHentKonti(){
        //arrange
        $personnummer ="01010122344";
        //$navn = "Per Olsen";
        //$adresse = "Osloveien 82 0270 Oslo";
        //$telefonnr="12345678";
        $bank=new Bank(new BankDBStub());
        //assert
        $this->assertEquals("OK", $bank->hentKonti($personnummer));
    }
    
    public function testHentAlleKunder(){
        //arrange
        
           $kunde1 = new kunde();
           $kunde1->personnummer ="01010122344";
           $kunde1->navn = "Per Olsen";
           $kunde1->adresse = "Osloveien 82 0270 Oslo";
           $kunde1->telefonnr="12345678";
           $kunde1->passord="123456";
           $kunde2 = new kunde();
           $kunde2->personnummer ="01010122344";
           $kunde2->navn = "Line Jensen";
           $kunde2->adresse = "Askerveien 100, 1379 Asker";
           $kunde2->telefonnr="92876789";
           $kunde3 = new kunde();
           $kunde3->personnummer ="02020233455";
           $kunde3->navn = "Ole Olsen";
           $kunde3->adresse = "Bærumsveien 23, 1234 Bærum";
           $kunde3->telefonnr="99889988";
        $bank=new BankDBStub();
        
        //act
        //$alleKunderTest[] = [$bank->hentAlleKunder()];
        //assert
        $this->assertEquals($kunde1->personnummer, $bank->hentAlleKunder()[0]->personnummer);
        
        
    }
}

