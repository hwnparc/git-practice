<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post | Blog</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            padding-top: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .edit-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .edit-container h1 {
            color: #667eea;
            margin-bottom: 2rem;
            text-align: center;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color 0.3s;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        .form-group textarea {
            min-height: 300px;
            resize: vertical;
        }
        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .btn {
            flex: 1;
            padding: 1rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-submit {
            background: #FFA726;
            color: white;
        }
        .btn-submit:hover {
            background: #FB8C00;
            transform: translateY(-2px);
        }
        .btn-cancel {
            background: #666;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-cancel:hover {
            background: #555;
        }
        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-container">
                <h1>Haewon Park</h1>
                <ul>
                    <li><a href="index.html#home">Home</a></li>
                    <li><a href="index.html#about">About</a></li>
                    <li><a href="index.html#projects">Projects</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="index.html#contact">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="edit-container">
        <h1>✏️ Edit Blog Post</h1>
        
        <?php
        $postId = isset($_GET['id']) ? $_GET['id'] : '';
        $postsDir = __DIR__ . '/posts';
        $postFile = $postsDir . '/' . $postId . '.json';
        
        if (empty($postId) || !file_exists($postFile)) {
            echo '<div class="error-message">Post not found or invalid post ID.</div>';
            echo '<a href="blog.php" class="btn btn-cancel">← Back to Blog</a>';
        } else {
            $postContent = file_get_contents($postFile);
            $post = json_decode($postContent, true);
            
            if ($post) {
                ?>
                <form method="POST" action="blog-handler.php">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($postId); ?>">
                    
                    <div class="form-group">
                        <label for="title">Post Title *</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="content">Content *</label>
                        <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" class="btn btn-submit">💾 Update Post</button>
                        <a href="blog.php" class="btn btn-cancel">❌ Cancel</a>
                    </div>
                </form>
                <?php
            } else {
                echo '<div class="error-message">Error reading post data.</div>';
                echo '<a href="blog.php" class="btn btn-cancel">← Back to Blog</a>';
            }
        }
        ?>
    </div>
</body>
</html>
