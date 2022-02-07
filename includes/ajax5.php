<?php
include "config.php";
if(isset($_POST['i_id']))
{
  $i_id = $_POST['i_id'];
  $statement = $conn->prepare("SELECT * FROM sas_classes WHERE  batch_id='".$i_id."' ORDER BY id ASC");
  $statement->execute();
  $result = $statement->fetchAll();
  $c=$statement->rowCount();
  echo json_encode($result);  
}
?>