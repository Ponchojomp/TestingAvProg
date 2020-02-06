<?php
include_once 'View/minNavigasjon.php';
include_once 'DAL/bankDatabaseStub.php';
$bank = new BankDBStub();
echo "";
?>
<br/><br/>
<div class="container">
    <br/><br/>
    <h4>Velkommen til TestingBank</h4>
    <p>Trykk her for å logge inn</p>
    <br/>
    <a href="View/loggInn.php" class="btn btn-success">Logg inn</a>
    <br/> <br/>
    <div id="feilMeldinger"></div>
    <script>console.log( . $bank->hentAlleKunder()[0]->personnummer . )</script>
</div>

