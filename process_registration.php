<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $resume = $_FILES["resume"]["name"];
  
  // Save the uploaded resume to a desired directory
  $targetDir = "resumes/";
  $targetFile = $targetDir . basename($_FILES["resume"]["name"]);
  move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFile);
  
  // Save the registration details to a database
  // Assuming you have a database connection already established
  $dbHost = "127.0.0.1";
  $dbUsername = "root";
  $dbPassword = "";
  $dbName = "resumes";
  
  $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
  
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "INSERT INTO job_seekers (name, email, phone, resume) VALUES ('$name', '$email', '$phone', '$resume')";
  
  if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();
}
?>
