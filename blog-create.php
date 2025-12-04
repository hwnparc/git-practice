<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post | Blog</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            padding-top: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .create-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .create-container h1 {
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
            background: #4CAF50;
            color: white;
        }
        .btn-submit:hover {
            background: #45a049;
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

    <div class="create-container">
        <h1>✍️ Create New Blog Post</h1>
        
        <form method="POST" action="blog-handler.php">
            <input type="hidden" name="action" value="create">
            
            <div class="form-group">
                <label for="title">Post Title *</label>
                <input type="text" id="title" name="title" placeholder="Enter an engaging title..." required>
            </div>
            
            <div class="form-group">
                <label for="content">Content *</label>
                <textarea id="content" name="content" placeholder="Write your blog post content here..." required></textarea>
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn btn-submit">📤 Publish Post</button>
                <a href="blog.php" class="btn btn-cancel">❌ Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
