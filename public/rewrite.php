<html>
    <body>
    <?php
    $textToSpin = 'This is without a doubt the best article rewriting api in the world';
    echo '<br/>Original Text: <br/>'. $textToSpin;

    $url = 'https://api.spinbot.com';
    $header = array();
    // Required header:
    $spinbotApiKey = 'ff35f520b9f842a689d75834caf25a46';
    $header[] = "x-auth-key:$spinbotApiKey";

    // optional header values
    $header[] = 'x-spin-cap-words:true';
    $header[] = 'x-words-to-skip:rewrit,nonExistentWordPart';
    $header[] = 'x-min-percent-change-per-sentence:any';

    // Execute cURL request, get response
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $textToSpin);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    // Make the response readable
    list($strResponseHeaders, $strResponseBody) = explode("\r\n\r\n", $response, 2);
    $aHeaders = putHeadersTextIntoArray($strResponseHeaders);

    // Display return values
    echo '<br/><br/>Text After Spinning: <br/>' . $strResponseBody;
    // Notice the use of response header 'available-spins' to keep track of remaining Spinbot credits.
    echo '<br/><br/>Available Spins: <br/>' . $aHeaders['available-spins'];

    // helper function to process return header plain text
    function putHeadersTextIntoArray($header_text) {
        $headers = array();
        foreach (explode("\r\n", $header_text) as $i => $line)
            if ($i === 0) {
                $headers['http_code'] = $line;
            } else {
                list ($key, $value) = explode(': ', $line);
                $headers[$key] = $value;
            }
        return $headers;
    }
    ?>
    </body>
</html>
