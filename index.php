<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Photo CRUD</title>
</head>
<body>
    <h1>Photo CRUD Application</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br><br>
        <label for="fileToUpload">Select file to upload:</label>
        <input type="file" name="image" id="fileToUpload" required>
        <br><br>
        <input type="submit" value="Upload Photo" name="submit">
    </form>
    <h2>Photo List</h2>
    <?php
    if(isset($_POST['submit'])){
        echo $name = $_POST['name']; // name of the person
        echo $image = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $image_temp = $_FILES['image']['tmp_name'];

        move_uploaded_file($image_temp, "uploads/$image");

        $sql = "INSERT INTO photos (id,name,image) VALUES (NULL, '$name', '$image')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Successfully inserted";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
  <table class="table table-striped"> 
  <tr>
      <th>id</th>
      <th>name</th>
      <th>file</th>
      <th>image</th>
  </tr>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']['name'], $_POST['id'])) {
  //if($_SERVER['REQUEST_METOD'] == 'POST' && isset($_FILES['file']['name'], $_POST['id'])) {
//   if (isset($_POST['change'])) {
    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    
    // Move the uploaded file to the 'file/' directory
    move_uploaded_file($file_tmp, "uploads/$file");
    
    // Update the 'file' column in the database
    $sid = $_POST['id'];
    mysqli_query($conn, "UPDATE photos SET image='$file' WHERE id='$sid'");
  }
    
$q =mysqli_query($conn,"select * from photos");
while($row = mysqli_fetch_array($q)){
    $image = $row['image'];
  ?>
  <tr>
      <td><?php echo $row['id']; ?> </td>
      <td><?php echo $row['name']; ?> </td>
      <td><form action="" method="post" enctype="multipart/form-data">
      Select file to upload:
      <input type="file" name="file" id="fileToUpload">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <input type="submit" value="Upload File" name="change">
    </form></td>
      <td><?php echo "<img src='uploads/$image' width='100' height='50'>"; } ?> </td>
    
    
    

    
    
    </tr>
 </table>     

</body>
</html>
<!--if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']['name'], $_POST['id'])) {-->
<!--    $image = $_FILES['file']['name'];-->
<!--    $image_tmp = $_FILES['file']['tmp_name'];-->
    
<!--    // Move the uploaded file to the 'file/' directory-->
<!--    move_uploaded_file($image_tmp, "file/$image");-->
    
<!--    // Update the 'file' column in the database-->
<!--    $sid = $_POST['id'];-->
<!--    mysqli_query($conn, "UPDATE data SET file='$image' WHERE id='$sid'");-->
<!--  }-->
