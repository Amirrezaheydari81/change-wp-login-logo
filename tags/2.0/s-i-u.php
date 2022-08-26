<?php

global $wpdb;

$favIconTable = $wpdb->prefix . "fav_icon_link";
settings_fields('set-fav-icon');

//Update submit value
if(!empty($_POST['link'])) {
    $wpdb->update($favIconTable, array('link' => $_POST['link']), array('id' => 1));
}

// Define form value
$result  = $wpdb->get_results("SELECT * FROM $favIconTable WHERE id = 1");
$link    = (!empty($_POST['link'])) ? $_POST['link'] : $result[0]->link;
?>