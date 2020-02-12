<?php
//Arthur jobber her
include_once '../BLL/adminLogikk.php';
include_once '../DAL/adminDatabaseStub.php';

class adminLogikkTest extends PHPUnit\Framework\TestCase {
    
    public function testNyAdminObjectUtenDB(){
        //arrange
        $admin = new Admin();
        $admin2 = new Admin(new AdminDBStub());
        //assert
        $this->assertEquals($admin->hentAlleKunder(), $admin2->hentAlleKunder());
    }
    
    public function testHentAlleKunder(){
        //arrange
        $admin=new Admin(new AdminDBStub());
        $kunde1personnummer ="01010122344";
        $kunde1fornavn = "Per";
        $kunde1etternavn = "Olsen";
        $kunde1adresse = "Osloveien 82 0270 Oslo";
        $kunde1telefonnr="12345678";
        $kunde2personnummer ="01010122344";
        $kunde2fornavn = "Line";
        $kunde2etternavn = "Jensen";
        $kunde2adresse = "Askerveien 100, 1379 Asker";
        $kunde2telefonnr="92876789";
        $kunde3personnummer ="02020233455";
        $kunde3fornavn = "Ole";
        $kunde3etternavn = "Olsen";
        $kunde3adresse = "Bærumsveien 23, 1234 Bærum";
        $kunde3telefonnr="99889988";
        
        //assert
        
            $this->assertEquals($kunde1personnummer, $admin->hentAlleKunder()[0]->personnummer);
            $this->assertEquals($kunde1fornavn, $admin->hentAlleKunder()[0]->fornavn);
            $this->assertEquals($kunde1etternavn, $admin->hentAlleKunder()[0]->etternavn);
            $this->assertEquals($kunde1adresse, $admin->hentAlleKunder()[0]->adresse);
            $this->assertEquals($kunde1telefonnr, $admin->hentAlleKunder()[0]->telefonnr);
            
            $this->assertEquals($kunde2personnummer, $admin->hentAlleKunder()[1]->personnummer);
            $this->assertEquals($kunde2fornavn, $admin->hentAlleKunder()[1]->fornavn);
            $this->assertEquals($kunde2etternavn, $admin->hentAlleKunder()[1]->etternavn);
            $this->assertEquals($kunde2adresse, $admin->hentAlleKunder()[1]->adresse);
            $this->assertEquals($kunde2telefonnr, $admin->hentAlleKunder()[1]->telefonnr);
            
            $this->assertEquals($kunde3personnummer, $admin->hentAlleKunder()[2]->personnummer);
            $this->assertEquals($kunde3fornavn, $admin->hentAlleKunder()[2]->fornavn);
            $this->assertEquals($kunde3etternavn, $admin->hentAlleKunder()[2]->etternavn);
            $this->assertEquals($kunde3adresse, $admin->hentAlleKunder()[2]->adresse);
            $this->assertEquals($kunde3telefonnr, $admin->hentAlleKunder()[2]->telefonnr);
    }
    
    public function testDatoFeilTransaksjoner() 
    {
        // arrange
        $kontoNr = "10502023523";
        $fraDato = '2015-03-27';
        $tilDato = '2015-03-22';
        $admin=new Admin(new AdminDBStub());
        // act
        $konto= $admin->hentTransaksjoner($kontoNr, $fraDato, $tilDato);
        // assert
        $this->assertEquals("Fra dato må være større enn tildato",$konto); 
    }
    
    public function testIngenTransaksjoner() 
    {
        // arrange
        $kontoNr = "10502023523";
        $fraDato = '2015-03-20';
        $tilDato = '2015-03-22';
        $admin=new Admin(new AdminDBStub());
        // act
        $konto= $admin->hentTransaksjoner($kontoNr, $fraDato, $tilDato);
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
        $admin=new Admin(new AdminDBStub());
        // act
        $konto= $admin->hentTransaksjoner($kontoNr, $fraDato, $tilDato);
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
        $admin=new Admin(new AdminDBStub());
        // act
        $konto= $admin->hentTransaksjoner($kontoNr, $fraDato, $tilDato);
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
        $admin=new Admin(new AdminDBStub());
        // act
        $konto= $admin->hentTransaksjoner($kontoNr, $fraDato, $tilDato);
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
}