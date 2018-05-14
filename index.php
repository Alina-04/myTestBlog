<?php  require_once 'header.php'; ?>

<?php 
  if (isset($_GET['logout'])) {
    session_destroy();
  }
?>


    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Мой блог</h1>
              <span class="subheading">Честный блог</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?php if (getArticles()): ?>
            <?php foreach (getArticles() as $article): ?>
            <?php $author = getAuthor($article['author']); ?>
            <div class="post-preview">
              <a href="post.php">
                <h2 class="post-title">
                  <?= $article['title']; ?>
                </h2>
                <h3 class="post-subtitle">
                  <?= $article['sub_title']; ?>
                </h3>
              </a>
              <p class="post-meta">Автор
                <a href="#"<?= $author['login']; ?></a>
                <?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $article['created_at']); ?>
                 <?= $date->format('F d, Y'); ?></p>
            </div>
          <hr>
          <?php endforeach; ?>
          <?php else: ?>
            <p>Статьи не найдены!</p>
          <?php endif; ?>

          <!-- Pager -->
          <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Следующие записи &rarr;</a>
          </div>
        </div>
      </div>
    </div>

    <hr>
<?php  require_once 'footer.php'; ?>