<?php
require_once '../db.php';

$conn->query("CREATE TABLE IF NOT EXISTS Sources (
    source_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    website_url VARCHAR(255),
    language VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB");

$conn->query("CREATE TABLE IF NOT EXISTS Articles (
    article_id INT AUTO_INCREMENT PRIMARY KEY,
    source_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content MEDIUMTEXT,
    published_date DATE,
    url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (source_id) REFERENCES Sources(source_id) ON DELETE CASCADE
) ENGINE=InnoDB");

$conn->query("CREATE TABLE IF NOT EXISTS Topics (
    topic_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB");

$conn->query("CREATE TABLE IF NOT EXISTS ArticleTopics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    topic_id INT NOT NULL,
    FOREIGN KEY (article_id) REFERENCES Articles(article_id) ON DELETE CASCADE,
    FOREIGN KEY (topic_id) REFERENCES Topics(topic_id) ON DELETE CASCADE,
    UNIQUE KEY unique_article_topic (article_id, topic_id)
) ENGINE=InnoDB");

// Insert NEW sources (completely unique names)
$conn->query("INSERT INTO Sources (name, website_url, language) VALUES
    ('Global Insights', 'https://globalinsights.example.com', 'English'),
    ('Tech Frontier', 'https://techfrontier.example.com', 'English'),
    ('Nature Watch', 'https://naturewatch.org', 'English'),
    ('Science Daily', 'https://sciencedaily.example.com', 'English'),
    ('World Sports Network', 'https://wsn.example.com', 'English')");

// Insert NEW topics (completely unique, no overlap)
$conn->query("INSERT INTO Topics (name) VALUES
    ('Renewable Energy'),
    ('Artificial Intelligence'),
    ('Wildlife Conservation'),
    ('Space Technology'),
    ('Global Sports Events'),
    ('Economic Policies'),
    ('Health Innovations'),
    ('Digital Privacy')");

// Insert NEW articles linked to the new sources
$conn->query("INSERT INTO Articles (source_id, title, content, published_date, url) VALUES
    (1, 'Renewable energy adoption accelerates globally', 'Countries are investing heavily in solar and wind power...', '2025-05-01', 'https://globalinsights.example.com/renewable-energy'),
    (2, 'AI breakthroughs in natural language processing', 'Recent models have improved accuracy drastically...', '2025-04-25', 'https://techfrontier.example.com/ai-nlp'),
    (3, 'Efforts to save endangered species intensify', 'Conservationists are using drones to monitor wildlife...', '2025-04-28', 'https://naturewatch.org/endangered-species'),
    (4, 'Mars rover sends new data about water presence', 'Findings suggest underground water reserves...', '2025-05-03', 'https://sciencedaily.example.com/mars-rover'),
    (5, 'Upcoming international soccer championship preview', 'Teams prepare for the biggest event in soccer...', '2025-04-30', 'https://wsn.example.com/soccer-championship'),
    (1, 'Global economic policies adapting post-pandemic', 'Governments tweak fiscal policies to boost growth...', '2025-04-27', 'https://globalinsights.example.com/economic-policies'),
    (2, 'New health innovations in wearable tech', 'Devices now monitor vitals in real-time with high accuracy...', '2025-05-02', 'https://techfrontier.example.com/wearables'),
    (3, 'Concerns over digital privacy rise', 'Users demand stronger encryption and regulations...', '2025-05-04', 'https://naturewatch.org/digital-privacy')");

// Link articles to topics
$conn->query("INSERT INTO ArticleTopics (article_id, topic_id) VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5),
    (6, 6),
    (7, 7),
    (8, 8)");

echo "Schema and new data setup complete.";
$conn->close();
?>
