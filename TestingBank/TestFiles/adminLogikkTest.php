<?php
//Arthur jobber her
include_once '../BLL/adminLogikk.php';
include_once '../DAL/adminDatabaseStub.php';

class adminLogikkTest extends PHPUnit\Framework\TestCase {
    
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
    
}