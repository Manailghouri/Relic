<?php
session_start();

$articles = $_SESSION['articles'] ?? [];
$topic = $_SESSION['query_topic'] ?? '';

// Clear session after use (optional)
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Relic – Search Results</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/styles.css" />
</head>
<body>
  <!-- Background Video -->
  <video autoplay muted loop id="bgVideo">
    <source src="../css/3973260-uhd_3840_2160_25fps.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>

  <!-- Overlay -->
  <div class="overlay"></div>

  <!-- Navbar -->
  <nav class="section__container nav__container sticky">
    <div class="nav__logo">
      <i class="ri-archive-line"></i>
      <span class="logo-text">Rel<span>ic</span></span>
    </div>

    <div class="nav__toggle" id="navToggle">
      <i class="ri-menu-line"></i>
    </div>

    <div class="nav__menu" id="navMenu">
      <ul class="nav__links">
        <li class="link"><a href="../index.html#home">Home</a></li>
        <li class="link"><a href="../index.html#about">About Us</a></li>
      </ul>
      <button class="btn nav__btn">Contact Us</button>
    </div>
  </nav>

  <!-- Results Container -->
  <section class="section__container">
    <div class="glass" style="padding: 2rem;">
      <h2 style="color: var(--white); margin-bottom: 1rem;">
        Search Results for "<?php echo htmlspecialchars($topic); ?>"
      </h2>

      <?php if (empty($articles)): ?>
        <p style="color: var(--white);">No articles found.</p>
      <?php else: ?>
        <div style="overflow-x: auto;">
          <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
              <tr style="color: var(--white); text-align: left; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                <th style="padding: 0.75rem;">ID</th>
                <th style="padding: 0.75rem;">Title</th>
                <th style="padding: 0.75rem;">Date</th>
                <th style="padding: 0.75rem;">Link</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($articles as $article): ?>
                <tr style="color: var(--white); border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                  <td style="padding: 0.75rem;"><?php echo $article['article_id']; ?></td>
                  <td style="padding: 0.75rem;"><?php echo htmlspecialchars($article['title']); ?></td>
                  <td style="padding: 0.75rem;"><?php echo $article['published_date']; ?></td>
                  <td style="padding: 0.75rem;">
                    <a href="<?php echo $article['url']; ?>" target="_blank" style="color: #7fffbb; text-decoration: none;">View</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- JavaScript for nav toggle -->
  <script>
    const toggleBtn = document.getElementById("navToggle");
    const navMenu = document.getElementById("navMenu");

    toggleBtn.addEventListener("click", () => {
      navMenu.classList.toggle("show-nav");

      const icon = toggleBtn.querySelector("i");
      icon.classList.toggle("ri-menu-line");
      icon.classList.toggle("ri-close-line");
    });
  </script>
</body>
</html>
