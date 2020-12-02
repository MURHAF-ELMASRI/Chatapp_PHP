<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Chat</h1>
    <h3>Conversation</h3>

    <div id="messages"></div>

    <div class="send-message">
        <input id='message-box' type="text" name='message' max='40' id='message-box'>

        <button type="button" id='send-button' class="btn btn-primary" onclick="sendMessage()">send</button>
    </div>

    <?php include '../utilCDN.php' ?>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
        function update() {
            console.log('update running');
            fetch_data();
            setTimeout(update, 1000);
        }

        function fetch_data(){
            $.getJSON('./app.php', function(messages) {
                console.log('json running');
                console.log(messages);
                $('#messages').empty()
                for (let i = 0; i < messages.length; i++) {
                    const element = messages[i];
                    $('#messages').append(`<p>message at ${element.date}  :<br>${element.message}<p>`);
                }

            });
        }

        function sendMessage() {
            console.log("message sendding");
            let [hour, minute, second] = new Date().toLocaleTimeString("en-US").split(/:| /);
            $.post("./app.php", {
                    'send': {
                        'message': $('#message-box').val(),
                        "date": `${hour} :${minute} :${second}`
                    }
                }, function() {
                    console.log("post sucseed");
                })
                .fail(function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                });
        }
        $("#message-box").keyup(function(event) {
            if (event.keyCode === 13) {
                $("#send-button").click();
                fetch_data();
                $("#message-box").val("");
            }
            });
        $(document).ready(function() {
            update();
        })

    
    </script>

</body>

</html>