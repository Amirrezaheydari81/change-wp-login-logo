<?php
//The icon in the data URI scheme
function setimageBase64($e){
    $icon_data = 'data:image/svg+xml;base64,' . $e;
    return $icon_data;
}