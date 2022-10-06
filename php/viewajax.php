<?php
include 'conn.php';
$sql = "SELECT * FROM parent JOIN child ON parent.id = child.P_id;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <tr class="data-user-id-<?= $row['id']; ?>">
            <td><?= $row['id'] ?></td>
            <td><?= $row['Father']; ?></td>
            <td><?= $row['mother']; ?></td>
            <td><?= $row['child']; ?></td>
            <td> <img src="../ERP/php/uploads/<?= $row['ChildImage']; ?>" alt="Child Images " srcset="" style="height:50px"> </td>
            <td>
            <td class="btn btn-success text-white"><a href="./php/edit.php?edit_id=<?= $row['id']; ?>">Edit</a></td>
            <td id="delete" class="btn btn-danger" onClick="deleteData(<?= $row['id']; ?>)">Delete</td>
            </td>
        </tr>
<?php
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?>