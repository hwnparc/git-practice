<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | Haewon Park</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            padding-top: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .blog-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
        }
        .blog-header {
            text-align: center;
            color: white;
            margin-bottom: 3rem;
        }
        .blog-header h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .create-button {
            display: inline-block;
            background: #4CAF50;
            color: white;
            padding: 1rem 2rem;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s;
        }
        .create-button:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .blog-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        .blog-card h2 {
            color: #667eea;
            margin-bottom: 1rem;
        }
        .blog-meta {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        .blog-excerpt {
            color: #333;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        .blog-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        .btn {
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .btn-read {
            background: #667eea;
            color: white;
        }
        .btn-read:hover {
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
            border: none;
            cursor: pointer;
        }
        .btn-delete:hover {
            background: #E53935;
        }
        .no-posts {
            text-align: center;
            color: white;
            padding: 3rem;
            background: rgba(255,255,255,0.1);
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

    <div class="blog-container">
        <div class="blog-header">
            <h1>📝 My Blog</h1>
            <p>Thoughts, tutorials, and experiences</p>
            <a href="blog-create.php" class="create-button">✍️ Write New Post</a>
        </div>

        <?php
        // Get all blog posts
        $postsDir = __DIR__ . '/posts';
        
        // Create posts directory if it doesn't exist
        if (!file_exists($postsDir)) {
            mkdir($postsDir, 0777, true);
        }
        
        $posts = [];
        
        // Read all JSON files from posts directory
        if (is_dir($postsDir)) {
            $files = scandir($postsDir);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                    $content = file_get_contents($postsDir . '/' . $file);
                    $post = json_decode($content, true);
                    if ($post) {
                        $post['filename'] = $file;
                        $posts[] = $post;
                    }
                }
            }
        }
        
        // Sort posts by date (newest first)
        usort($posts, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        
        if (count($posts) > 0) {
            echo '<div class="blog-grid">';
            foreach ($posts as $post) {
                $id = pathinfo($post['filename'], PATHINFO_FILENAME);
                $excerpt = strlen($post['content']) > 200 ? substr($post['content'], 0, 200) . '...' : $post['content'];
                
                echo '<article class="blog-card">';
                echo '<h2>' . htmlspecialchars($post['title']) . '</h2>';
                echo '<div class="blog-meta">📅 ' . date('F j, Y', strtotime($post['date'])) . '</div>';
                echo '<div class="blog-excerpt">' . nl2br(htmlspecialchars($excerpt)) . '</div>';
                echo '<div class="blog-actions">';
                echo '<a href="blog-post.php?id=' . $id . '" class="btn btn-read">Read More</a>';
                echo '<a href="blog-edit.php?id=' . $id . '" class="btn btn-edit">Edit</a>';
                echo '<form method="POST" action="blog-delete.php" style="display: inline;" onsubmit="return confirm(\'Are you sure you want to delete this post?\');">';
                echo '<input type="hidden" name="id" value="' . $id . '">';
                echo '<button type="submit" class="btn btn-delete">Delete</button>';
                echo '</form>';
                echo '</div>';
                echo '</article>';
            }
            echo '</div>';
        } else {
            echo '<div class="no-posts">';
            echo '<h2>No blog posts yet</h2>';
            echo '<p>Start writing your first post!</p>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
