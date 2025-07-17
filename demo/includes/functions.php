<?php
function runtime_prettier($movie_length){

  $hours = intdiv($movie_length,60);
  $minutes = $movie_length % 60;
  
  $hour_word = ($hours==1) ? "hour" : "hours";
  $minutes_word = ($minutes==1) ? "minute" : "minutes";

  if ($hours > 0 && $minutes >0) {
    echo "$hours $hour_word $minutes $minutes_word";
  } elseif ($hours > 0) {
    echo "$hours $hour_word";
  } else {
    echo "$minutes $minutes_word";
  }
}

function check_old_movie($year){

    $current_year = date("Y");
    $age = $current_year - $year;

    if ($age > 40) {
        return $age;
    } else {
        return false;
    }

}

function mesaj_ora(){
$t = localtime( time(), true );
$h = $t['tm_hour'];

if( $h >= 7 && $h <= 11 ) print "Buna dimineata!";
elseif( $h > 11 && $h < 18 ) print "Buna ziua!";
elseif( $h >= 18 && $h < 22 ) print "Buna seara!";
elseif( $h >= 22 ) print "Noapte buna!";
else print "Cum adica esti treaz/a la ora asta?";
}

function find($element)
{
  if(in_array($_GET['genre'], $element['genres'])){
    return true;
  }else{
    return false;
  }
}

function find_movies_by_title($item)
{
   if (!isset($_GET['s'])) {
    return false;
  }

  if(stripos($item['title'], $_GET['s']) === false) {
    return false;
  } else {
    return true;
  }
}

function db_connect($host="localhost", $username="php-user", $password="php-password", $dbname="php-proiect"){
  return mysqli_connect($host, $username, $password, $dbname);
}

?>