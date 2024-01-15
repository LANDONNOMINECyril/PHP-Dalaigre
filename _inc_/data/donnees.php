<?php
    function getProduct(){
        $data = file_get_contents("data.json");
        $jsonversionne = json_decode($data, true);
        return $jsonversionne;
    }
?>