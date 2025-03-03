Code 1: HTML Form for File Upload
This code snippet creates an HTML form that allows users to upload a file and pass an id value.

html
<form action="" method="post" enctype="multipart/form-data">
      Select file to upload:
      <input type="file" name="file" id="fileToUpload">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <input type="submit" value="Upload File" name="submit">
</form>
Steps:

Form Tag: <form action="" method="post" enctype="multipart/form-data"> - Specifies the form submission method as POST and allows file uploads.

File Input: <input type="file" name="file" id="fileToUpload"> - Provides a file input for the user to select a file to upload.

Hidden Input: <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> - Stores the id value in a hidden input field, which will be sent along with the form submission.

Submit Button: <input type="submit" value="Upload File" name="submit"> - Provides a button for submitting the form.

Code 2: PHP Script for Handling File Upload
This code snippet processes the uploaded file and updates the database.

php
if (isset($_POST['change'])) {
    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $sid = $_POST['id']; // 
    // Move the uploaded file to the 'file/' directory
    move_uploaded_file($file_tmp, "uploads/$file");
}
Steps:

Check Form Submission: if (isset($_POST['change'])) { - Checks if the form with the name change was submitted.

Retrieve File Information:

$file = $_FILES['file']['name']; - Gets the name of the uploaded file.

$file_tmp = $_FILES['file']['tmp_name']; - Gets the temporary file path of the uploaded file.

Retrieve ID Value: $sid = $_POST['id']; - Retrieves the id value from the hidden input field in the form.

Move Uploaded File: move_uploaded_file($file_tmp, "uploads/$file"); - Moves the uploaded file from its temporary location to the uploads directory.

Code 3: PHP Script for Displaying Data
This code snippet retrieves data from the database and displays it.

php
$query = mysqli_query($conn, "SELECT * FROM photos");
while ($row = mysqli_fetch_array($query)) {
    $image = $row['image'];
}
Steps:

Execute SQL Query: $query = mysqli_query($conn, "SELECT * FROM photos"); - Runs an SQL query to select all records from the photos table.

Fetch Query Results:

while ($row = mysqli_fetch_array($query)) { - Iterates through each row returned by the query.

$image = $row['image']; - Retrieves the image value from each row.

Putting It All Together
You can combine these snippets to create a complete file upload and display system. Ensure that the form action points to the correct PHP script that handles the form submission and file upload, and that the id values are dynamically generated and passed correctly.
