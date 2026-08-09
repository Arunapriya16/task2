<?php
require_once 'db.php';

$tables = [];
$result = mysqli_query($conn, "SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

$sqlScript = "";
foreach ($tables as $table) {
    // Get table structure
    $query = mysqli_query($conn, "SHOW CREATE TABLE $table");
    $row = mysqli_fetch_row($query);
    $sqlScript .= $row[1] . ";\n\n";

    // Get table data
    $result = mysqli_query($conn, "SELECT * FROM $table");
    while ($row = mysqli_fetch_assoc($result)) {
        $keys = array_keys($row);
        $values = array_map(function($val) use ($conn) {
            return "'" . mysqli_real_escape_string($conn, $val) . "'";
        }, array_values($row));
        
        $sqlScript .= "INSERT INTO `$table` (`" . implode("`, `", $keys) . "`) VALUES (" . implode(", ", $values) . ");\n";
    }
    $sqlScript .= "\n\n";
}

file_put_contents('schema.sql', $sqlScript);
echo "<h2 style='color:green;'>SUCCESS! schema.sql has been created in your folder.</h2>";
?>