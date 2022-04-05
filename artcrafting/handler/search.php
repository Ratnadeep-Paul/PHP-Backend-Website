<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../partials/dbconnect.php';
    $name_post =  $_POST['name'];

    $sql = "SELECT * FROM `products` WHERE `name` LIKE '%$name_post%' AND `status`='available'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $artist = $row['artist'];
        $name = $row['name'];
        $id = $row['id'];
        echo '<a href="product-details.php?product=' . $name . '&&id=' . $id . '">' . $name . '<br> <em>By ' . $artist . '</em></a>';
    }
}

?>