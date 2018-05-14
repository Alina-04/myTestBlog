<?php require_once 'header.php'; ?>

<?php 
	if (isset($_POST) && !empty($_POST)) {
		insertArticle($_POST);
	}
?>

	<header class="masthead" style="background-image: url('img/contact-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading">
            	<?php $article = $_GET; ?>
              	<h1><?= $article['title']; ?></h1>
              	<span class="subheading"><?= $article['subtitle']; ?></span>
            </div>
          </div>
        </div>
      </div>
    </header>
	<article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
	        <form action="insertpost.php" method="POST">
	            <p><?= $article['content']; ?></p>
	            	<?php $url = translit($_GET['title']); ?>
	            <p>
	            	<a href=<?= mb_strtolower($url); ?>.php><?= $_GET['title']; ?></a>
	            </p>
	            <p class="post-meta">Автор
	                <a href="#"><?= $_SESSION['author']; ?></a>
	                <?= date('F d, Y'); ?>
	            </p>
	            <button>Разместить пост</button>
	            <?php if(getErorMesage()): ?>
    				<p><?= getErorMesage(); ?></p>
    			<?php  endif; ?>
	        </form>
          </div>
        </div>
      </div>
    </article>



<?php require_once 'footer.php'; ?>
