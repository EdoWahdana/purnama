<?php
include_once "../connection.php"; 
    $receiver = $_GET['user'];

    //penerimanya
    $penerima = $db->query("SELECT * FROM users WHERE name = '$receiver'")->fetch();
    $chat = $db->query("SELECT * FROM chats where sender = '".$_SESSION['username']."' AND receiver = '".$penerima['username']."' OR sender = '".$penerima['username']."' AND receiver = '".$_SESSION['username']."' order by time asc");
    
    foreach($chat as $data){
        if($data['sender'] == $_SESSION['username']){

        
?>
 <div class="direct-chat-msg right">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name float-right"><?= $data['sender']; ?></span>
        <span class="direct-chat-timestamp float-left"><?= $data['time'] ?></span>
    </div>
    <!-- /.direct-chat-info -->
    <img class="direct-chat-img" src="picture/iconA.png" alt="message user image">
    <!-- /.direct-chat-img -->
    <div class="direct-chat-text">
        <?= $data['text']; ?>
    </div>
    <!-- /.direct-chat-text -->
</div>

<?php } else { ?>

<!-- Message. Default to the left -->
<div class="direct-chat-msg">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name float-left"><?= $data['sender']; ?></span>
        <span class="direct-chat-timestamp float-right"><?= $data['time'] ?></span>
    </div>
    <!-- /.direct-chat-info -->
    <img class="direct-chat-img" src="picture/iconP.png" alt="message user image">
    <!-- /.direct-chat-img -->
    <div class="direct-chat-text">
        <?= $data['text']; ?>
    </div>
<!-- /.direct-chat-text -->
</div>
<!-- /.direct-chat-msg -->

<?php } ?>


<?php } ?>
