<?php
$username = filter_input(INPUT_POST,'username');
$password = filter_input(INPUT_POST,'password');
if(!empty($username)){
    if(!empty($password)){
        $host="localhost";
        $dbusername="root";
        $dbpassword="";
        $dbname="politalkhub_login";
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
        if(mysqli_connect_error())
        {
            die('connect error ('.mysqli_connect_errno() .')' .mysqli_connect_error());

        }
        else{
            $sql= "INSERT INTO account (username, password)
            values ('$username', '$password')";
            if($conn->query($sql)){
                echo "new record is inserted successfully ";
            }
            else{
                echo "error". $sql ."<br>" . $conn->error;
            }

            
            
        }

}
else{
    echo "password shant be emypy ";
    die();


}
}
else{
    echo "username should not be empty";
}



?>