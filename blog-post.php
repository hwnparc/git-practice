<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post | Haewon Park</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            padding-top: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .post-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 3rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .post-header {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #eee;
        }
        .post-header h1 {
            color: #667eea;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .post-meta {
            color: #666;
            font-size: 1rem;
            display: flex;
            gap: 2rem;
        }
        .post-content {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 3rem;
        }
        .post-actions {
            display: flex;
            gap: 1rem;
            padding-top: 2rem;
            border-top: 2px solid #eee;
        }
        .btn {
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        .btn-back {
            background: #667eea;
            color: white;
        }
        .btn-back:hover {
            background: #5568d3;
        }
        .btn-edit {
            background: #FFA726;
            color: white;
        }
        .btn-edit:hover {
            background: #FB8C00;
        }
        .btn-delete {
            background: #EF5350;
            color: white;
        }
        .btn-delete:hover {
            background: #E53935;
        }
        .error-message {
            text-align: center;
            padding: 3rem;
            color: #c62828;
            background: #ffebee;
            border-radius: 10px;
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

    <div class="post-container">
        <?php
        $postId = isset($_GET['id']) ? $_GET['id'] : '';
        $postsDir = __DIR__ . '/posts';
        $postFile = $postsDir . '/' . $postId . '.json';
        
        if (empty($postId) || !file_exists($postFile)) {
            echo '<div class="error-message">';
            echo '<h2>Post Not Found</h2>';
            echo '<p>The blog post you\'re looking for doesn\'t exist.</p>';
            echo '<a href="blog.php" class="btn btn-back">← Back to Blog</a>';
            echo '</div>';
        } else {
            $postContent = file_get_contents($postFile);
            $post = json_decode($postContent, true);
            
            if ($post) {
                ?>
                <article>
                    <div class="post-header">
                        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
                        <div class="post-meta">
                            <span>📅 <?php echo date('F j, Y', strtotime($post['date'])); ?></span>
                            <span>🕒 <?php echo date('g:i A', strtotime($post['date'])); ?></span>
                        </div>
                    </div>
                    
                    <div class="post-content">
                        <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                    </div>
                </article>
                
                <div class="post-actions">
                    <a href="blog.php" class="btn btn-back">← Back to Blog</a>
                    <a href="blog-edit.php?id=<?php echo $postId; ?>" class="btn btn-edit">✏️ Edit Post</a>
                    <form method="POST" action="blog-delete.php" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        <input type="hidden" name="id" value="<?php echo $postId; ?>">
                        <button type="submit" class="btn btn-delete">🗑️ Delete Post</button>
                    </form>
                </div>
                <?php
            } else {
                echo '<div class="error-message">';
                echo '<h2>Error</h2>';
                echo '<p>Unable to read post data.</p>';
                echo '<a href="blog.php" class="btn btn-back">← Back to Blog</a>';
                echo '</div>';
            }
        }
        ?>
    </div>
</body>
</html>
