<!-- 
    Description: checks if user is admin
    Created By: Oliver
-->

<?php
    if(!isset($_SESSION['admin_id'])) die('Access denied, please log in');
?>