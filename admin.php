<?php

class adminFinder
{
     static public function banner()
     {
          $banner = "
                      ___      _           _
                     / _ \    | |         (_)
 ___  ___ __ _ _ __ / /_\ \ __| |_ __ ___  _ _ __
/ __|/ __/ _` | '_ \|  _  |/ _` | '_ ` _ \| | '_ \
\__ \ (_| (_| | | | | | | | (_| | | | | | | | | | |
|___/\___\__,_|_| |_\_| |_/\__,_|_| |_| |_|_|_| |_|
                              [ Proud Indonesian! ]";
          echo $banner . "\n\n";
     }

     static private function findingTruth($request)
     {
          @preg_match_all("/HTTP\/1\.[0-1] [0-9]{3}/i",$request,$match);
          //$httpNormalPage = self::sendingRequest($urlTarget);
          $httpCodeStatus  = @explode(" ",$match[0][0])[1];
          $foolingResponse = [ "not found", "tak dapat ditemukan", "tidak dapat ditemukan", "tidak dikenal", "tak dikenal",
     "tak dapat ditemukan", "tidak dapat ditemukan", "tidak dapat mencari", "tak dapat mencari", "tidak dapat dicari", "tak dapat dicari",
     "tidak ditemukan", "tak ditemukan", "404"];
          if( $httpCodeStatus ){
               foreach($foolingResponse as $fooling)
               {
                    if( preg_match("/$fooling/i",$request) ){
                         $httpCodeStatus = 404;
                         break;
                    }
               }
          }else{
               $httpCodeStatus = "response late!";
          }
          return $httpCodeStatus;
     }

     static public function sendingRequest($urlTarget,$timeOut)
     {
          $curlMain = curl_init($urlTarget);
          curl_setopt_array($curlMain,array(
               //CURLOPT_URL => $this -> urlTarget,
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_USERAGENT => rand(1,10000),
               CURLOPT_TIMEOUT => $timeOut,
               CURLOPT_CONNECTTIMEOUT => 3,
               CURLOPT_HEADER => true,
          ));
          $curlExec = curl_exec($curlMain);
          curl_close($curlMain); return $curlExec;
     }

     static public function scanAdmin($urlTarget,$timeOut)
     {
          $foundAdminDir   = array();
          $serverResponse  = self::sendingRequest($urlTarget,$timeOut);
          $serverHttpCode  = self::findingTruth($serverResponse);
          $foundAdminDir["statusCode"] = $serverHttpCode;
          $foundAdminDir["urlTarget"]  = $urlTarget;

          return $foundAdminDir;
     }
}

?>
