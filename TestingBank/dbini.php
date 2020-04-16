<?php
header('Content-Type: application/json');
$OK = true;
$db = new mysqli("localhost", "root","","Bank");
if($db->connect_error)
{
   $OK=false;
}
$fil= file_get_contents('iTestDB.sql');

$res = $db->multi_query($fil);
if($res)
{
    do {
        if ($result = $db->store_result()) {
            if($result == false)
            {
                $OK = false;
            }
            $result->free();
        }
        $db->more_results();
    } while ($db->next_result());

}
else
{
    $OK=false;
}
$db->close();
if($OK)
{
    echo json_encode("OK");
}
else
{
    echo json_encode("Feil");
}