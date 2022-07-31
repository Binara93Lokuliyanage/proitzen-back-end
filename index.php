<?php
header("Content-Type: application/json");

if(strpos($_SERVER["HTTP_ORIGIN"], "javascript") === false){
  
header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
}
?>
<html>
<body>
hi ...............................................
</body>
</html>