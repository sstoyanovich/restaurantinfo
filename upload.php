
<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="text" name="first_name" size="40" maxlength="255" value="<?=$first_name?>" onfocus="this.select();">
    <input type="file" name="fileToUpload" value="<?=$file?>">
    <?php

    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
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
