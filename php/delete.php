<?php
include("conn.php");
$id = $_POST['id'];
$sqlparent = "DELETE FROM `parent` WHERE id = $id";
$sqlchild = "DELETE FROM `child` WHERE P_id = $id";


$parentquery = mysqli_query($conn, $sqlparent);
$childquery = mysqli_query($conn, $sqlchild);
if ($parentquery && $childquery) {
    echo $id;
} else {
    echo "somting wen t wrong";
}
