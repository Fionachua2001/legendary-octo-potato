
<!doctype html>
<html>
<head>
<title>Upload Image</title>
</head>
<body>
<?php
    include "db_connect.php";
    $stmt = $conn->prepare("select sFilePath from tb_images");
    $stmt->execute();
    $stmt->bind_result($sFilePath);

    while($stmt->fetch()){
        echo $sFilePath;
    ?>
        <img src="<?=$sFilePath?>" style="width=25%;">
    <?php
    }
    $stmt->close();
    $conn->close();
?>

</body>
</html>