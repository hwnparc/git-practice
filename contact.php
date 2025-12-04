<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data using POST method
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Validate data
    if (empty($name) || empty($email) || empty($message)) {
        echo "<h2>Error: All fields are required!</h2>";
        echo "<a href='index.html'>Go Back</a>";
        exit;
    }
    
    // Display the submitted data
    echo "<h1>Thank you for contacting me!</h1>";
    echo "<h2>Your submission:</h2>";
    echo "<p><strong>Name:</strong> " . $name . "</p>";
    echo "<p><strong>Email:</strong> " . $email . "</p>";
    echo "<p><strong>Message:</strong> " . $message . "</p>";
    echo "<br><a href='index.html'>Back to Home</a>";
    
    // Optionally: Save to a file
    $file = fopen("messages.txt", "a");
    fwrite($file, "\n--- New Message ---\n");
    fwrite($file, "Name: $name\n");
    fwrite($file, "Email: $email\n");
    fwrite($file, "Message: $message\n");
    fwrite($file, "Date: " . date("Y-m-d H:i:s") . "\n");
    fclose($file);
} else {
    echo "Invalid request method.";
}
?>
