<?php
include("conn.php");
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt');
$path = 'uploads/'; // upload dir

if (!empty($_POST['fathername']) || !empty($_POST['MotherName']) || !empty($_POST['ChildName'])) {
    $mainid =  $_POST['id'];
    $fathername = $_POST['fathername'];
    $MotherName = $_POST['MotherName'];
    $ChildName = $_POST['ChildName'];

    if ($_FILES['image']['name']) {
        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $final_image = rand(1000, 1000000) . $img;

        if (in_array($ext, $valid_extensions)) {
            $path = $path . strtolower($final_image);
            if (move_uploaded_file($tmp, $path)) {

                $sqlparentupdate = "UPDATE parent SET Father ='$fathername', mother='$MotherName' WHERE id = $mainid ";
                if ($conn->query($sqlparentupdate) === TRUE) {
                    $sqlchildupdate = "UPDATE child SET child ='$ChildName', ChildImage='$final_image' WHERE P_id = $mainid ";
                    if ($conn->query($sqlchildupdate) === TRUE) {
                        echo "data update successfull ! ";
                    } else {
                        echo "Somting wnr wrong " . $conn->error;
                    }
                } else {
                    echo "Somting wnr wrong " . $conn->error;
                }
            }
        } else {
            echo 'invalid';
        }
    } else {
        $sqlparentupdate = "UPDATE parent SET Father ='$fathername', mother='$MotherName' WHERE id = $mainid ";
        if ($conn->query($sqlparentupdate) === TRUE) {
            $sqlchildupdate = "UPDATE child SET child ='$ChildName' WHERE P_id = $mainid ";
            if ($conn->query($sqlchildupdate) === TRUE) {
                echo "data update successfull ! ";
            } else {
                echo "Somting wnr wrong " . $conn->error;
            }
        } else {
            echo "Somting wnr wrong " . $conn->error;
        }
    }
}
