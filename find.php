<?php

include_once("admin.php");

$adminFinder = 'adminFinder';
$bruteAdmin  = file("admin.txt");
$foundDir    = array();

$adminFinder::banner();

if( count($argv) != 3 ){
     die( "[ usage : php " . basename(__FILE__) . " <url_site> <time_out> ] \n\n" );
}else{
     if( !is_numeric($argv[2]) ) die("[!] timeout have to be numeric! \n");
     $urlTarget = $argv[1];
     $requestTO = $argv[2];
}

if( substr($urlTarget,-1) !== "/" ) $urlTarget .= "/"; // url got to have / at the end.
/* is site alive? */
//$checkConnection = $adminFinder::sendingRequest($urlTarget,10);
if(!preg_match("/200/", @get_headers($urlTarget)[0])) die( "[!] site's dead or ur connection is on the trouble! \n" );

foreach( $bruteAdmin as $dirAdmin )
{
     /* which one is file and dir? let's figure the difference out! */
     $dirAdmin  = str_replace("\n","",$dirAdmin);
     if( !pathinfo($dirAdmin,PATHINFO_EXTENSION) && substr($dirAdmin,-1) !== "/" ) $dirAdmin .= "/";
     $responseServer = $adminFinder::scanAdmin($urlTarget . $dirAdmin,$requestTO);

     if( $responseServer["statusCode"] == 200 )
     {
          $foundDir[][$responseServer["statusCode"]] = $responseServer["urlTarget"];
     }

     echo "[ " . $responseServer['statusCode'] . " ] " . $responseServer['urlTarget'] . " \n";
}

echo "\n--------------------------------------------------------\n";
if( !(count($foundDir) > 0)  ){
     echo "[-] sorry buddy, nothing dir found!\n";
}
else{
     echo "[+] " .count($foundDir) . " found!\n\n";
     foreach($foundDir as $key => $value)
     {
          foreach($value as $x => $z)
          {
               echo "[*] " . $z . " ($x) \n";
          }
     }
}
echo "--------------------------------------------------------\n";

?>
