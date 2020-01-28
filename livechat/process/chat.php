
    <!-- Message. Default to the left -->
<script>
window.setInterval(function(){
    $.ajax({
        url:"process/load_chat.php?user=<?= $_POST['user'] ?>",
        type: 'GET',
        cache: false,
        success: function(result) {
            $('#content-chat').html(result);
        }
    });
}, 2000);

window.scrollTo(0,document.querySelector(".direct-chat-messages").scrollHeight);

</script>

<div id="content-chat">

</div>
