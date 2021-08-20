<?php

$connect = new PDO('mysql:host=127.0.0.1:3307;dbname=unism', 'root', '');

if(isset($_POST["title"]))
{
    $query = "
 INSERT INTO events
 (title, start, end)
 VALUES (:title, :start_event, :end_event)
 ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':title'  => $_POST['title'],
            ':start_event' => $_POST['start'],
            ':end_event' => $_POST['end']
        )
    );
}


?>
