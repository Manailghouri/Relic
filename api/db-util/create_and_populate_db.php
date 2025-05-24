<?php
require_once '../api/db.php'; 

$sourcesTable = "
CREATE TABLE IF NOT EXISTS Sources (
    source_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    website_url VARCHAR(255),
    language VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

$articlesTable = "
CREATE TABLE IF NOT EXISTS Articles (
    article_id INT AUTO_INCREMENT PRIMARY KEY,
    source_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    published_date DATE,
    url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (source_id) REFERENCES Sources(source_id) ON DELETE CASCADE
) ENGINE=InnoDB;
";

$topicsTable = "
CREATE TABLE IF NOT EXISTS Topics (
    topic_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

$articleTopicsTable = "
CREATE TABLE IF NOT EXISTS ArticleTopics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    topic_id INT NOT NULL,
    FOREIGN KEY (article_id) REFERENCES Articles(article_id) ON DELETE CASCADE,
    FOREIGN KEY (topic_id) REFERENCES Topics(topic_id) ON DELETE CASCADE,
    UNIQUE KEY unique_article_topic (article_id, topic_id)
) ENGINE=InnoDB;
";

foreach ([$sourcesTable, $articlesTable, $topicsTable, $articleTopicsTable] as $sql) {
    if (!$conn->query($sql)) {
        die("Table creation failed: " . $conn->error);
    }
}


$conn->query("INSERT INTO Sources (name, website_url, language) VALUES
    ('The Daily News', 'https://dailynews.example.com', 'English'),
    ('Le Monde', 'https://lemonde.fr', 'French')
");

// 2. Insert into Topics
$conn->query("INSERT INTO Topics (name) VALUES
    ('Climate Change'),
    ('Elections 2024')
");

// 3. Insert into Articles
$conn->query("INSERT INTO Articles (source_id, title, content, published_date, url) VALUES
    (1, 'Climate action rises worldwide', 'Many countries commit to climate goals...', '2025-04-15', 'https://dailynews.example.com/climate-action'),
    (2, 'French elections overview', 'The upcoming elections promise change...', '2025-04-10', 'https://lemonde.fr/elections-2024')
");

// 4. Link articles to topics
$conn->query("INSERT INTO ArticleTopics (article_id, topic_id) VALUES
    (1, 1),  -- article 1 about Climate Change
    (2, 2)   -- article 2 about Elections 2024
");

echo "Tables created and sample data inserted successfully.";

$conn->close();
?>
