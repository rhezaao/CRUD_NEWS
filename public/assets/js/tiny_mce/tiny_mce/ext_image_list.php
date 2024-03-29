<?php // this must be the very first line in your PHP file!

// You can't simply echo everything right away because we need to set some headers first!
$output = ''; // Here we buffer the JavaScript code we want to send to the browser.
$delimiter = "n"; // for eye candy... code gets new lines

$output .= 'var tinyMCELinkList = new Array(';

$directory = "/dealer/images"; // Use your correct (relative!) path here

// Since TinyMCE3.x you need absolute image paths in the list...
$abspath = preg_replace('~^/?(.*)/[^/]+$~', '/$1', $_SERVER['SCRIPT_NAME']);

if (is_dir($directory)) {
    $direc = opendir($directory);

    while ($file = readdir($direc)) {
        if (!preg_match('~^.~', $file)) { // no hidden files / directories here...
             if (is_file("$directory/$file") && getimagesize("$directory/$file") != FALSE) {
                // We got ourselves a file! Make an array entry:
                $output .= $delimiter
                    . '["'
                    . utf8_encode($file)
                    . '", "'
                    . utf8_encode("$abspath/$directory/$file")
                    . '"],';
            }
        }
    }

    $output = substr($output, 0, -1); // remove last comma from array item list (breaks some browsers)
    $output .= $delimiter;

    closedir($direc);
}

// Finish code: end of array definition. Now we have the JavaScript code ready!
$output .= ');';

// Make output a real JavaScript file!
header('Content-type: text/javascript'); // browser will now recognize the file as a valid JS file

// prevent browser from caching
header('pragma: no-cache');
header('expires: 0'); // i.e. contents have already expired

// Now we can send data to the browser because all headers have been set!
echo $output;

?>