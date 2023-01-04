<?php
echo 'here';
$file="here";
header('Content-Type: application/pdf');
header('Content-Disposition: inline; 
filename="yourfilename.pdf"'); //not the path but just the name
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($file));
header('Accept-Ranges: bytes');
header('Expires: 0');
header('Cache-Control: public, must-revalidate, max-age=0');
ob_clean();
flush();
readfile($file);
exit();
?>