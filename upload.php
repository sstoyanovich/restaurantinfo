
<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" value="<?=$file?>">
    <?php
  echo $file;
   echo pathinfo($file,PATHINFO_EXTENSION);

    ?>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
