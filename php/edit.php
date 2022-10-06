<?php

include_once('conn.php');

$id = $_GET['edit_id'];

$sql = "select * from parent where id='" . $id . "'";
$result = mysqli_query($conn, $sql);

$sqlchild = "select * from child where P_id='" . $id . "'";
$resultchild = mysqli_query($conn, $sqlchild);
$datachild = mysqli_fetch_array($resultchild);
$data = mysqli_fetch_array($result);

?>
<!doctype html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title> Create Records</title>
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <h1>Edit Records</h1>
                <a href="../index.php" class="btn btn-primary ">
                    <h6>Go To Home</h6>
                </a>
                <hr>
                <form id="form" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?= $id ?>" required />
                    <div class="form-group">
                        <label for="name"> Father Name </label>
                        <input type="text" class="form-control" id=" fathername" name=" fathername" placeholder="Enter Father Name" value="<?php echo $data['Father']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="MotherName">Mother Name</label>
                        <input type="text" class="form-control" id="MotherName" name="MotherName" placeholder=" Enter Mother Name" value="<?php echo $data['mother']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="ChildName">Child Name</label>
                        <input type="text" class="form-control" id="ChildName" name="ChildName" placeholder=" Enter Child Name" value="<?php echo $datachild['child']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="image">Child Image</label>
                        <input id="uploadImage" class="form-control" type="file" accept="image/*" name="image" />
                    </div>
                    <div class="form-group border">
                        <label>Preview Image : </label>
                        <img src="../php/uploads/<?= $datachild['ChildImage']; ?>" alt="Child Images " srcset="" style="height:50px ">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success form-control" type="submit" value="Upload">
                    </div>
                </form>
                <div id="err"></div>
                <div id="msg" class="text-success"></div>

            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(e) {
        $("#form").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "editform.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {

                    $("#err").fadeOut();
                },
                success: function(data) {
                    if (data == 'invalid') {
                        // invalid file format.
                        $("#err").html("Invalid File !").fadeIn();
                    } else {
                        // view uploaded file.
                        $("#preview").html(data).fadeIn();
                        $("#form")[0].reset();
                        $("#msg").html(data);
                    }

                },
                error: function(e) {
                    $("#err").html(e).fadeIn();
                }
            });
        }));
    });
</script>

</html>