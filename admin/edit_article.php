<?php  require_once 'header.php'; ?>  

<?php
  if (isset($_POST) && !empty($_POST)) {
    updateArticle($_POST);
  }
?>
  
  	<div class="content-wrapper">
    	<div class="container-fluid">
      <!-- Breadcrumbs-->
      		<ol class="breadcrumb">
        		<li class="breadcrumb-item">
          			<a href="#">Dashboard</a>
        		</li>
       			<li class="breadcrumb-item active">My Dashboard</li>
      		</ol>
      		<div class="row">
            <div class="col-12">
            <?php $article = $_GET; ?>
              <form action="edit_article.php" method="post">
                <p>
                  <label>Title:<br>
                    <input name="title" size="50" type="text" value="<?= $article['title']; ?>" placeholder="">
                  </label>
                </p>
                <p>
                  <label>Sub Title:<br>
                    <input type="text" size="80" name="sub_title" value="<?= $article['sub_title']; ?>">
                  </label>
                </p> 
                <p>
                  <label>Content:<br>
                    <textarea rows="5" cols="80" name="content"><?= $article['content']; ?></textarea>
                  </label>
                </p>
                <input type="hidden" name="articleId" value="<?= $article['id']; ?>">
                <button class="btn btn-success">Редактировать</button>
              </form>
      		
					  </div>
          </div>              
		  </div>							
    </div>

<?php  require_once 'footer.php'; ?>