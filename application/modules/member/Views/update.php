<?php 

$page_id = mysql_real_escape_string(html_entities($_POST['page_id']));
$rating = mysql_real_escape_string(html_entities($_POST['rating']));

mysql_query(" UPDATE tb_user(Barcode) VALUES ('$rating') WHERE ID = $page_id ");
 ?>