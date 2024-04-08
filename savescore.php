<?php

include 'login.php';


if(isset($_GET['name']) && isset($_GET['score'])){

    $con = mysqli_connect($host, $db_username, $db_password, $db_name);

    //Lightly sanitize the GET's to prevent SQL injections and possible XSS attacks
    $name = strip_tags(mysqli_real_escape_string($con, $_GET['name']));
    $score = strip_tags(mysqli_real_escape_string($con, $_GET['score']));
    
    $sql = mysqli_query($con, "INSERT INTO $db_name.$db_table (name, score)
                               VALUES ('$name','$score');" );
    if($sql){

        //The query returned true - now do whatever you like here.
        echo 'Your score was saved. Congrats!';
        
    }else{
     
        //The query returned false - you might want to put some sort of error reporting here. Even logging the error to a text file is fine.
        echo 'There was a problem saving your score. Please try again later.';
    }

    mysqli_close($con);//Close off the MySQL connection to save resources.

}else{
    echo 'Your name or score wasnt passed in the request. Make sure you add ?name=NAME_HERE&score=1337 to the tags.';
}

?>
