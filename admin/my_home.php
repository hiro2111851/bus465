<!-- 
    Page Name: basic home page

    Page Description: Home page with some stats; chartjs

    Created By: Oliver
-->

<?php
session_start();

//handles database connection
include "../external/db_connect.php";

//adds a navbar
include "admin_nav.php";

//query to get data from the database
$delivdate = '';
$dollaramt = '';

$sql = "SELECT b.delivery_date as Dates, SUM(oi.quantity*oi.price) as Dollars
FROM batches b, batch_items bi, order_items oi 
WHERE b.id = bi.batch_id AND bi.id = oi.batch_item_id
GROUP BY b.delivery_date
ORDER BY b.delivery_date DESC";

$result = mysqli_query($conn, $sql);

//loop through returned data
while ($row = mysqli_fetch_array($result)) {

    $delivdate = $delivdate . '"' . $row['Dates'].'",';
    $dollaramt = $dollaramt . '"' . $row['Dollars'].'",';
}

$delivdate = trim($delivdate,",");
$dollaramt = trim($dollaramt,",");

?>

<!DOCTYPE html>

<html lang=en>

<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!--search icon from w3school-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS -->
    <style>
        .navitem {
          border-style: groove;
          box-sizing: border-box;
          padding: 10px;
          border: 0.5px solid grey;
          background: #D3DEE5;
        }

        body {
          background-color: #EADED6;
        }

        h1 {
          font-size: 84pt;
          font-family: "Vivaldi";
        }

        .col-md-6, .col-md-1, .col-md-5{
          padding: 20pt;
          margin: auto;
        }

        form.example input[type=text] {
          padding: 10px;
          font-size: 17px;
          border: 1px solid grey;
          float: left;
          width: 80%;
          background: #f1f1f1;
          }

        form.example button {
          float: left;
          width: 20%;
          padding: 10px;
          background: #DC747D;
          color: white;
          font-size: 17px;
          border: 1px solid grey;
          border-left: none;
          cursor: pointer;
          }
        
        .outer {
            display: table;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            }

        .middle {
            display: table-cell;
            vertical-align: middle;
            }

        .inner {
            margin-left: auto;
            margin-right: auto;
            width: 400px;
            /*whatever width you want*/
            }
    </style>

    <!-- This will link the Bootstrap css file to this HTML page allowing us to use the Bootstrap classes to style our HTML components.  -->
    <link rel="stylesheet" href="../css/bootstrap.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>

    <title>Admin Homepage</title>
</head>

<body>
<div class="outer">
    <div class="middle">
        <div class="inner">
        <!-- Sample Chart -->
        <canvas id="myChart" width="400" height="400"></canvas>
        <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: [<?php echo $delivdate; ?>],
            datasets: [{
                label: 'Dollars',
                data: [<?php echo $dollaramt; ?>],
                borderColor: ['rgba(255, 99, 132, 1)'],
                borderWidth: 3
            }]
        },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        </script>
        </div>
    </div>
</div>
</body>
