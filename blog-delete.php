<?php
// blog-delete.php - Handles delete operation

$postsDir = __DIR__ . '/posts';

// Check if form was submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = isset($_POST['id']) ? $_POST['id'] : '';
    
    if (empty($postId)) {
        header("Location: blog.php?error=invalid_id");
        exit;
    }
    
    // Sanitize the ID to prevent directory traversal
    $postId = basename($postId);
    
    $filename = $postsDir . '/' . $postId . '.json';
    
    // Check if post exists
    if (!file_exists($filename)) {
        header("Location: blog.php?error=post_not_found");
        exit;
    }
    
    // Delete the post file
    if (unlink($filename)) {
        // Successfully deleted
        header("Location: blog.php?deleted=true");
        exit;
    } else {
        // Failed to delete
        header("Location: blog.php?error=delete_failed");
        exit;
    }
    
} else {
    // If not POST request, redirect to blog
    header("Location: blog.php");
    exit;
}
?>
