<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=joinvasc;charset=utf8',
                    'root',
                    '');

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch(PDOException $ex) {
    echo "Não foi possível se conectar ao banco de dados, tente novamente.";
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=joinvasc.csv');

$sql = "SELECT * FROM options;";

$sth = $db->prepare($sql);
$sth->execute();

$filename = date('d.m.Y').'.csv';

$data = fopen($filename, 'w');

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) 
{
    $csv = implode(',', $row) . "\n";
    fwrite($data, $csv);
    print_r($csv);
}

echo "\r\n";

fclose($data);

?>
