<?php
$url = 'http://hdnow.biz/content/base/film.xml';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
$text=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $data);
$xml = simplexml_load_string($text);
$con = mysqli_connect("127.0.0.1",'root','');



mysqli_select_db($con,'films') or die(mysqli_error());
foreach ($xml -> url as $row) {
    $iframe_url = $row->iframe_url;
    $name = $row->name;
    var_dump($name.'<br>');
    $year = $row->year;
    $film_id = $row->kinopoisk_id;

    $sql = "INSERT INTO `moves` (`iframe_url`,`name`,`year`,`film_id`)" . "VALUES ('$iframe_url', '$name', '$year', '$film_id')";
    $resault = mysqli_query($con, $sql);
    if (!$resault) {
        echo 'Mysql ERROR';
    } else {

    }
}