<?php 
include "../connection.php";



function processLogin($username, $password){
    $db = new PDO("mysql:host=localhost; dbname=live_chat; charset=utf8", "root", "");
    $login = $db->query("SELECT * FROM users WHERE username='$username' and password='$password' ");
    if($login->rowCount() >= 1){
        $data = $login->fetch();
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['name'] = $data['name'];

        pesan("success", "Register Berhasil!", "../home.php");
    } else {
        pesan("danger", "Username / password salah", base_url());
    }
    
}

$process = $_GET['process'];
switch ($process) {
    case 'register':
        //proses register
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $gender = $_POST['gender'];
        $picture = $_FILES["picture"]["name"];
        if(empty($picture)) {
            $picture = "Not Set";
        } else {
            move_uploaded_file($_FILES['picture']['tmp_name'], '../picture/'.$picture);
        }
        if($name == "" && $username == "" && $password == ""){
            pesan('danger', "Please fill entire field", '../register.php');
        } 
        $query = "INSERT INTO users VALUES ('', '$username', '$password', '$name', '$gender', '$picture')";
        
        $insert = $db->query($query);
        processLogin($username, $password);

        break;
    
    case 'login':
        processLogin($_POST['username'], sha1($_POST['password']));
        
        break;
    case 'logout':
        
        session_destroy();
        pesan("warning", "Logout berhasil", base_url());
        
        break;
    default:
        # code...
        break;
}


?>