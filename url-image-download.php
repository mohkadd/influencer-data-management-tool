
<?php
  
$url = 
'https://yt3.ggpht.com/ytc/AKedOLREOBT109d1QFQcEBEKs25fsOi9nOWxGT75UoIN5g=s88-c-k-c0x00ffffff-no-rj'; 
  
$img = 'youtube1.png'; 
  
// Function to write image into file
file_put_contents($img, file_get_contents($url));
  
echo "File downloaded!"
  
?>