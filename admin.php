<?php require_once 'header.php'; ?>

<?php 
	if (isset($_SESSION['access']) && $_SESSION == false) {
		header('Location: /access_denied.php');
	}
	if (isset($_GET) && key_exists('logout', $_GET)) {
		session_destroy();
		header('Location: /');
		exit;
	}
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
              <h1>Личный кабинет</h1>
              <span class="subheading">Инструменты блогера</span>
            </div>
          </div>
        </div>
      </div>
    </header>
	<div class="col-lg-6 mx-auto">
	<div>
		<?php if (getArticles()): ?>
            <?php foreach (getArticles() as $article): ?>
            	<span><?= $article['id'].'.' ?></span>
            	<span><?= $article['title']; ?></span>
            	<button formaction="deletepost.php" formmethod="POST" name="delete">Удалить</button>
            	<?php if (isset($_POST['delete']) && ($_POST['delete'])){
					deleteArticle($article['id']);
					echo "delete";
					}; ?>
            	<button>Редактировать</button>
            	<hr>
            	<?php endforeach; ?>
        <?php else: ?>
            <p>Статьи не найдены!</p>
        <?php endif; ?>
	</div>
	<?php deleteArticle(1); ?>
	<h3>Добавить новый пост</h3>
		<form action="admin.php" method="POST">
		
			<label for="title">Заголовок</label>
			<p>
				<input type="text" name="title" value="">
			</p>
			<label for="subtitle">Краткое описание</label>
			<p>
				<input type="text" name="subtitle">
			</p>
			<label for="content">Ваше сообщение</label>
			<p>
				<textarea name="content" placeholder="Сообщение" cols="30" rows="5" value=""></textarea>
			</p>
			<!-- <p name="date"><//?= //date('F d, Y'); //?></p>
			<?php //if (isset($_POST['title']) && !empty($_POST['title'])): ?>
				<?php $url //= mb_strtolower(translit($_POST['title'])); ?>
				<p" name="url"><?= $url//.".php"; ?></p">
			<?php //endif; ?>
			<p name="author"><//?= //"Автор ".$_SESSION['author']; //?></p>
			<p> -->
			<label for="date">Дата</label>
			<p>
				<input type="date" name="date">
			</p>
			<label for="url">Адрес страницы нового поста</label>
			<p>
				<input type="url" name="url">
			</p>
			<label for="author">Автор</label>
			<p>
				<input type="text" name="author">
			</p>
				<input type="submit" name="" value="Разместить пост">
			</p>
		</form>
		
	</div>

<?php require_once 'footer.php'; ?>
