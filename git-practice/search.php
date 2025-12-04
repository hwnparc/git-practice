<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            padding-top: 80px;
        }
        .search-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
        }
        .search-result {
            background: white;
            padding: 2rem;
            margin: 1rem 0;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .no-results {
            text-align: center;
            padding: 3rem;
            color: #666;
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
                    <li><a href="index.html#contact">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="search-container">
        <?php
        // GET method: Retrieve search keyword from URL
        if (isset($_GET['keyword'])) {
            $keyword = htmlspecialchars($_GET['keyword']);
            
            echo "<h1>Search Results for: \"$keyword\"</h1>";
            echo "<p style='color: #666; margin: 1rem 0;'>Search method: GET (check the URL!)</p>";
            
            // Sample projects database
            $projects = [
                [
                    'title' => 'Project One',
                    'description' => 'A modern front-end framework project using HTML, CSS, and JavaScript',
                    'tags' => ['HTML', 'CSS', 'JavaScript', 'React']
                ],
                [
                    'title' => 'Project Two',
                    'description' => 'API integration project with REST APIs and data visualization',
                    'tags' => ['API', 'JavaScript', 'PHP', 'REST']
                ],
                [
                    'title' => 'Project Three',
                    'description' => 'Responsive design challenge with mobile-first approach',
                    'tags' => ['CSS', 'Responsive', 'Design', 'HTML']
                ]
            ];
            
            // Search logic
            $results = [];
            foreach ($projects as $project) {
                // Search in title, description, and tags
                $searchText = strtolower($project['title'] . ' ' . $project['description'] . ' ' . implode(' ', $project['tags']));
                if (strpos($searchText, strtolower($keyword)) !== false) {
                    $results[] = $project;
                }
            }
            
            // Display results
            if (count($results) > 0) {
                echo "<p style='margin: 1rem 0;'><strong>Found " . count($results) . " result(s)</strong></p>";
                
                foreach ($results as $project) {
                    echo "<div class='search-result'>";
                    echo "<h2>" . $project['title'] . "</h2>";
                    echo "<p>" . $project['description'] . "</p>";
                    echo "<p style='margin-top: 1rem;'><strong>Tags:</strong> " . implode(', ', $project['tags']) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<div class='no-results'>";
                echo "<h2>No results found</h2>";
                echo "<p>Try searching for: HTML, CSS, JavaScript, API, or Design</p>";
                echo "</div>";
            }
            
        } else {
            echo "<h1>No search keyword provided</h1>";
            echo "<p>Please enter a search term.</p>";
        }
        ?>
        
        <div style="text-align: center; margin-top: 3rem;">
            <a href="index.html#projects" class="button">Back to Projects</a>
        </div>
    </div>
</body>
</html>
