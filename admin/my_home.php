<!-- 
    Page Name: basic home page

    Page Description: Home page with some stats; chartjs

    Created By: Oliver
-->

<?php
session_start();

//handles database connection
include "../external/db_connect.php";

//handles queries
include "admin_query.php";

//adds a navbar
include "admin_nav.php";
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
            top: 10%;
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
    
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>

    <title>Admin Homepage</title>
</head>

<body>
<div class="container-fluid">
  <div class="row justify-content-start">
    <div class="col-12 col-md-8">
        <!-- Dollar Value of Orders -->
        <div class="chart-container">
            <canvas id="dollarorder" width="800" height="250"></canvas>
        </div>
    </div>
    <div class="col-6 col-md-4">
      One of two columns
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row justify-content-start">
    <div class="col-12 col-md-8">
        <!-- Quantity Sold in Last 30 Days of Orders -->
        <div class="chart-container">
            <canvas id="quantitysold" width="800" height="250"></canvas>
        </div>
    </div>
    <div class="col-6 col-md-4">
      One of two columns
    </div>
  </div>
</div>
</body>

<script>

window.onload = function() {
// Dollar Value of Orders
var ctx1 = document.getElementById("dollarorder").getContext('2d');
var dollarorder = new Chart(ctx1, {
    type: 'line',
    data: {
    labels: [<?php echo $delivdate; ?>],
    datasets: [{
        label: 'Dollars',
        data: [<?php echo $dollaramt; ?>],
        borderColor: ['rgba(51, 153, 255, 1)'],
        borderWidth: 3
        }]
    },
    options: {
        title: {
            display:true,
            text:'Dollar Value of Orders'
        },
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

// Quantity Sold 
var ctx2 = document.getElementById("quantitysold").getContext('2d');
var quantitysold = new Chart(ctx2, {
    type: 'bar',
    data: {
	    labels: [<?php echo $prodname; ?>],
	    datasets: [{
    		label: 'Maximum',
	    	backgroundColor: "#3399FF",
		    stack: 'Stack 0',
		    data: [<?php echo $maxquantity; ?>]
	    }, {
    		label: 'Sold',
	    	backgroundColor: "#868686",
		    stack: 'Stack 1',
    		data: [<?php echo $soldquantity; ?>]
	    }]
    },
    options: {
        title: {
            display: true,
            text: 'Quantity Sold (Last 30 Days)'
        },
        tooltips: {
			mode: 'index',
			intersect: false
		},
        responsive: true,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }
});

}

</script>