<?php
// blog-handler.php - Handles create and update operations

$postsDir = __DIR__ . '/posts';

// Create posts directory if it doesn't exist
if (!file_exists($postsDir)) {
    mkdir($postsDir, 0777, true);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    // Validate required fields
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    
    if (empty($title) || empty($content)) {
        header("Location: blog.php?error=missing_fields");
        exit;
    }
    
    // Sanitize input
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    
    if ($action === 'create') {
        // CREATE - New blog post
        
        // Generate unique ID based on timestamp
        $postId = date('YmdHis') . '_' . uniqid();
        
        // Create post data
        $postData = [
            'id' => $postId,
            'title' => $title,
            'content' => $content,
            'date' => date('Y-m-d H:i:s'),
            'updated' => date('Y-m-d H:i:s')
        ];
        
        // Save to JSON file
        $filename = $postsDir . '/' . $postId . '.json';
        $jsonData = json_encode($postData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        
        if (file_put_contents($filename, $jsonData)) {
            header("Location: blog-post.php?id=" . $postId);
            exit;
        } else {
            header("Location: blog-create.php?error=save_failed");
            exit;
        }
        
    } elseif ($action === 'update') {
        // UPDATE - Edit existing post
        
        $postId = isset($_POST['id']) ? $_POST['id'] : '';
        
        if (empty($postId)) {
            header("Location: blog.php?error=invalid_id");
            exit;
        }
        
        $filename = $postsDir . '/' . $postId . '.json';
        
        // Check if post exists
        if (!file_exists($filename)) {
            header("Location: blog.php?error=post_not_found");
            exit;
        }
        
        // Read existing post
        $existingContent = file_get_contents($filename);
        $existingPost = json_decode($existingContent, true);
        
        // Update post data
        $postData = [
            'id' => $postId,
            'title' => $title,
            'content' => $content,
            'date' => $existingPost['date'], // Keep original date
            'updated' => date('Y-m-d H:i:s') // Update modification time
        ];
        
        // Save updated data
        $jsonData = json_encode($postData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        
        if (file_put_contents($filename, $jsonData)) {
            header("Location: blog-post.php?id=" . $postId . "&updated=true");
            exit;
        } else {
            header("Location: blog-edit.php?id=" . $postId . "&error=save_failed");
            exit;
        }
        
    } else {
        header("Location: blog.php?error=invalid_action");
        exit;
    }
    
} else {
    // If not POST request, redirect to blog
    header("Location: blog.php");
    exit;
}
?>
