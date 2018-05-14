<?php require_once 'header.php'; ?>

<?php 
	if (isset($_GET) && key_exists('logout', $_GET)) {
    	session_destroy();
    	header('Location: /authorization.php');
    	exit;
	}
	if (isset($_POST) && !empty($_POST)) {
    	login($_POST);
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
		<form>
			<label for="title">Заголовок</label>
			<p>
				<input type="text" name="title">
			</p>
			<label for="subtitle">Краткое описание</label>
			<p>
				<input type="text" name="subtitle">
			</p>
			<label for="message">Ваше сообщение</label>
			<p>
				<textarea name="message" placeholder="Сообщение" cols="30" rows="5"></textarea>
			</p>
			
			<input type="submit" name="">
		</form>
		
	</div>

<?php require_once 'footer.php'; ?>
