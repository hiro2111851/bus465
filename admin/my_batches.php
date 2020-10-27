<!-- 
    Page Name: Manage your batches (Admin)

    Page Description: An Admin page for store owners to add new batch 

    Created By: Hiro
-->
<?php
session_start();

//handles database connection
include "../external/db_connect.php";

//handles batch creation
include "../external/add_batch.php";
?>

<!DOCTYPE html>

<html lang=en>

<head>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>My Batches</title>
</head>

<body>

<!-- Website Container -->
<div class="container">

<h3>Add a New Batch</h3>

<!-- Form to add a new batch-->
<div class="batch_form">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

<div class="form-group">
    <label for="start_date">Start Date</label>
    <input type="date" name="start_date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
</div>

<div class="form-group">
    <label for="end_date">End Date</label>
    <input type="date" name="end_date" class="form-control" required>
</div>

<div class="form-group">
    <label for="delivery_date">Delivery Date</label>
    <input type="date" name="delivery_date" class="form-control" required>
</div>

<button type="submit" name="submit_batch" class="btn btn-primary">Add Batch</button>

</form>
</div>

<!-- List of existing batches -->
<h3> Upcoming Batches </h3>

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Batch ID</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Delivery Date</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>

<!-- Loop through sql query to generate table content (batches) -->
<?php
$sql = "
    SELECT id, start_date, end_date, delivery_date
    FROM batches
    ORDER BY delivery_date DESC;
    ";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    echo 
        "<tr scope='row'> 
            <td> <a href='batch.php?batch_id=".$row['id']."'>".$row['id']."</a></td>
            <td>".$row['start_date']."</td>
            <td>".$row['end_date']."</td>
            <td>".$row['delivery_date']."</td>
            <td>";

    if ($row['end_date'] < date("Y-m-d")) {
        echo "Closed";
    } else if ($row['start_date'] > date("Y-m-d")) {
        echo "Not Yet Started";
    } else {
        echo "Open";
    };
    
    echo "</td> </tr>";
};
?>
    </tbody>
</table>

</div>
</body>

</html>

<?php 
// close database connection
mysqli_close($conn); 
?>