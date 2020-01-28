
<?php 
include "../connection.php";

//PENGIRIM
$time = date('Y-m-d H:i:s');
$text = $_POST['message'];
$sender = $_SESSION['username'];
$receiver = $_POST['receives'];

//penerimanya
$penerima = $db->query("SELECT * FROM users WHERE name = '$receiver'")->fetch();

$query = "INSERT INTO chats VALUES ('', '$time', '$text', '$sender', '$penerima[username]',  '1')";

$db->query($query);




?>


<!-- Message. Default to the left -->
 <!-- Message to the right -->
 <div class="direct-chat-msg right">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name float-right"><?= $_SESSION['name']; ?></span>
        <span class="direct-chat-timestamp float-left"><?= $time ?></span>
    </div>
    <!-- /.direct-chat-info -->
    <img class="direct-chat-img" src="picture/user3-128x128.jpg" alt="message user image">
    <!-- /.direct-chat-img -->
    <div class="direct-chat-text">
        <?= $_POST['message']; ?>
    </div>
    <!-- /.direct-chat-text -->
</div>

