<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AQUILA</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .message-container {
            text-align: center;
        }

        .success-message, .error-message {
            color: #5a9bd5; /* Pastel blue color */
            font-size: 32px; /* Bigger font size */
            margin-top: 20px; /* Add some space on top */
        }

        .error-message {
            color: #ff6666; /* Red color for error message */
        }

        .message-container img {
            width: 100%; /* Make the image take the full width of the page */
            max-height: 80vh; /* Limit the maximum height of the image to 80% of viewport height */
        }
    </style>
</head>
<body>
<?php
// Establish database connection
$servername = "127.0.0.1";
$username = "root"; // Remove @localhost
$password = ""; // If you haven't set a password, leave it empty
$dbname = "artist";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) { // Check if form is submitted and submit button is clicked
    // Escape user inputs for security

    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $inputState = $conn->real_escape_string($_POST['inputState']);
    $idea = $conn->real_escape_string($_POST['idea']);
    $model = $conn->real_escape_string($_POST['model']);


    // Insert data into database
    $sql = "INSERT INTO cli (firstname, lastname, email, inputState, idea, model) VALUES ('$firstname', '$lastname', '$email','$inputState', '$idea', '$model')";
    if ($conn->query($sql) === TRUE) {
      echo "<div class='message-container'><div class='success-message'>New record created successfully <br>Thank you for Sharing your Ideas with Us ! </br></div><img src='resources/10116.jpg' alt='Success'></div>";
    } else {
        echo "<div class='message-container'><div class='error-message'>Error: " . $sql . "<br>" . $conn->error . "</div></div>";
    }
  }

// Close connection
$conn->close();
?>
</body>
</html>
