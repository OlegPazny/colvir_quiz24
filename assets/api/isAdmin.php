<?php
    $isAdmin=false;
    $isAssistant=false;
    $isColvir=false;
    if(isset($_SESSION["user"]["UserName"])){
        if ($_SESSION["user"]["UserName"] == "admin") {
            $isAdmin = true;
        } else if ($_SESSION["user"]["UserName"] == "assistant") {
            $isAssistant = true;
        } else if ($_SESSION["user"]["UserName"] == "colvir") {
            $isColvir = true;
        }
    }
?>