#!/usr/bin/env php 
<?

// This is a Squid 3 script

if (! defined("STDIN")) {
        define("STDIN", fopen("php://stdin", "r"));
}
while (!feof(STDIN)) {
        $line = trim(fgets(STDIN));

        fwrite(STDOUT, "OK\n");

        $fields = explode(' ', $line);
        $username = rawurldecode($fields[0]);
        $url = cleanUrl(rawurldecode($fields[1]));

        file_put_contents ( '/tmp/squid.log' , "\n- ", FILE_APPEND );
        file_put_contents ( '/tmp/squid.log' , "$username - $url", FILE_APPEND );



        // if ($username == 'hello'
        //     and $password == 'world') {
        //         fwrite(STDOUT, "OK\n");
        // } else if ($username == 'fo'
        //     and $password == 'bar') {
        //         fwrite(STDOUT, "OK\n");
        // } else {
        //         // failed miserably
        //         fwrite(STDOUT, "ERR\n");
        // }
}

function cleanURL($url)
{

    // in case scheme relative URI is passed, e.g., //www.google.com/
    $url = trim($url, '/');

    // If scheme not included, prepend it
    if (!preg_match('#^http(s)?://#', $url)) {
        $url = 'http://' . $url;
    }

    $urlParts = parse_url($url);

    // remove www
    $domain = preg_replace('/^www\./', '', $urlParts['host']);

    return $domain;

}
