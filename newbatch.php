<!-- 
    Page Name: Manage your batches (Admin)

    Page Description: An Admin page for store owners to add new batch 

    Created By: Hiro
-->
<?php
session_start();

//handles database connection
include "db_connect.php";
?>

<!DOCTYPE html>

<html lang=en>

<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>My Batches</title>
</head>

<body>

<!-- Website Container -->
<div class="container">

<h3>Add a New Order</h3>

<!-- Form to add a new batch-->
<div class="batch_form">
<form>

<div class="form-group">
    <label for="start_date">Start Date</label>
    <input type="date" name="start_date" class="form-control" required>
</div>

<div class="form-group">
    <label for="end_date">End Date</label>
    <input type="date" name="end_date" class="form-control" required>
</div>

<div class="form-group">
    <label for="delivery_date">End Date</label>
    <input type="date" name="delivery_date" class="form-control" required>
</div>

<!-- Hidden Inputs-->
<input type="hidden" name="status" value="New">

<button type="submit" name="submit_batch" class="btn btn-primary">Submit</button>

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
    SELECT id, start_date, end_date, delivery_date, status
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
            <td>".$row['status']."</td>
        </tr>";
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