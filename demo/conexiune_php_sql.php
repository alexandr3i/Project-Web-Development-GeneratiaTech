<?php
echo "<pre>";

//$conn=mysqli_connect('localhost', 'root', 'root', 'local');

// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// echo "Connected successfully to the database.";

// print_r($conn);
// echo "</pre>";

//Close the connection
//mysqli_close($conn);

// Example of a function to connect to a database
// function dbConnect(){
//     return mysqli_connect($host, $username, $password, $dbname);
// }

// $conn=dbConnect('localhost','root','root','local');

//2nd example of a function to connect to a database

function dbConnect($host='localhost', $username='root', $password='root', $dbname='local') {
    return mysqli_connect($host, $username, $password, $dbname);
}

$conn=dbConnect();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully to the database.";
//print_r($conn);
// echo "</pre>";

//CREARE TABLE and INSERT INTO example

// $sql="CREATE TABLE IF NOT EXISTS Elevi(
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     CNP VARCHAR(13) NOT NULL,
//     nume VARCHAR(30) NOT NULL,
//     prenume VARCHAR(30) NOT NULL,
//     scoala TEXT(30) NOT NULL,
//     varsta SMALLINT NOT NULL 
//     -- varsta, de ex, este cheia coloanei
// )";

// $action=mysqli_query($conn, $sql);

// if ($action){

//     $sql2="INSERT INTO Elevi (CNP, nume, prenume, scoala, varsta) VALUES
//     ('1234567890123', 'Popescu', 'Ion', 'Liceul Teoretic', 16),
//     ('2345678901234', 'Ionescu', 'Maria', 'Colegiul National', 17),
//     ('3456789012345', 'Georgescu', 'Ana', 'Scoala Generala', 15)";

//     if(mysqli_query($conn, $sql2)){
//         echo "Record created successfully.";
//     } else {
//         echo "Error: " .$sql. "<br>" . mysqli_error($conn);
//     }

// } else {
//     echo "Error executing action: " . mysqli_error($conn);
// }

//filtrarea

$adresare="SELECT id, prenume, varsta FROM Elevi WHERE varsta > 15";
$result=mysqli_query($conn, $adresare);

if(mysqli_num_rows($result) > 0) {

    //un tip de afisare
    // while($row=mysqli_fetch_assoc($result)) {
    //     echo "<pre>";
    //     print_r($row);
    //     echo "</pre>";
    // }

    //alt tip de afisare
    while($row=mysqli_fetch_assoc($result)) {
        echo "ID: " . $row['id'] . " - Prenume: " . $row['prenume'] . " - Varsta: " . $row['varsta'] . "<br>";
    }
} else {
    $result = "No results found";
}
?>
