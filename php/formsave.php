<?php
include("conn.php");
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt');
$path = 'uploads/'; // upload dir
if (!empty($_POST['fathername']) || !empty($_POST['MotherName']) || !empty($_POST['ChildName']) || $_FILES['image']) {
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    $final_image = rand(1000, 1000000) . $img;

    if (in_array($ext, $valid_extensions)) {
        $path = $path . strtolower($final_image);
        if (move_uploaded_file($tmp, $path)) {

            $fathername = $_POST['fathername'];
            $MotherName = $_POST['MotherName'];
            $ChildName = $_POST['ChildName'];
            $ChildImage =  $final_image;

            $sql = "INSERT INTO parent (Father, mother) VALUES ('$fathername', 'MotherName')";
            if ($conn->query($sql) === TRUE) {
                $P_id = $conn->insert_id;
                $sqlChild = "INSERT INTO child (P_id, child, ChildImage) VALUES ($P_id, '$ChildName','$ChildImage')";
                if ($conn->query($sqlChild) === TRUE) {
                    echo "data inserted ! ";
                } else {
                    echo "Somting wnr wrong " . $conn->error;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo 'invalid';
    }
}
