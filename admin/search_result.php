<?php  require_once 'header.php'; ?>

    <div class="content-wrapper">
      <div class="container-fluid">
      <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Dashboard</li>
          </ol>
                
      <!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Data Table Example
              </div>
            <div>
            <!-- <?php //var_dump($); ?> -->
                <?php if(isset($_POST) && !empty($_POST)) : ?>
                <?php foreach (searchBlog($_POST) as $article) : ?>
          
                  <h2><?= $article['title']; ?></h2>
                  <p><?= $article['sub_title'];  ?></p>
                  <p><?= $article['content']; ?></p>
                  
                <?php endforeach; ?>
                <?php if(searchBlog($_POST)) : ?>
                  <?php else: ?>
                  <p> По вашему запросу ничего не найдено.</p>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
      </div>

<?php  require_once 'footer.php'; ?>