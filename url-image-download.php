
<?php
  
$url = 
'https://secureservercdn.net/50.62.89.58/a5l.a90.myftpupload.com/wp-content/uploads/2020/07/CAIT-LOGO-1.png'; 
  
$img = 'youtube1.jpg'; 
  
// Function to write image into file
file_put_contents($img, file_get_contents($url));
  
echo "File downloaded!";
  
?>