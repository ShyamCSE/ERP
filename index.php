<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Ajax</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>View data</h2>
        <a href="AddRecord.php" class="btn btn-primary ">Add New Record</a>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>S.no </th>
                    <th>Father Name </th>
                    <th>Mother Name </th>
                    <th>Child Name </th>
                    <th>Child Image</th>
                </tr>
            </thead>
            <tbody id="table">

            </tbody>
        </table>
    </div>
    <script>
        $.ajax({
            url: "php/viewajax.php",
            type: "POST",
            cache: false,
            success: function(data) {
                $('#table').html(data);
            }
        });

        function deleteData(id) {
            $.ajax({
                method: "POST",
                url: "php/delete.php",
                data: {
                    id: id,
                },
                success: function(data) {
                    console.log(data);
                    $(".data-user-id-" + data).remove();
                }
            })

        }
    </script>
</body>

</html>