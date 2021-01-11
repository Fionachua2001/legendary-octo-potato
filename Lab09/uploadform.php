<!doctype html>
<html>
<head>
<title>Upload Image</title>
</head>
<body>
<h1>Upload Image</h1>
<form action="uploadbackend.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<a href="showImages.php">Load images</a>
</body>