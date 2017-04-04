
<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" value="<?=$file?>">
    <?php

    $uploadOk = 1;
    $imageFileType = pathinfo($file,PATHINFO_EXTENSION);
    if($imageFileType == "jpg"){
    echo "jpg";
  }
    if($imageFileType == "pdf"){
    echo "pdf";
  }
    ?>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
