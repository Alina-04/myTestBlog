<?php  require_once 'header.php'; ?>

<!-- <?php
	//if (isset($_SESSION['access']) && $_SESSION['access']) {
	  //  header('Location: /accessdenied.php');
	    //exit;
	//}
	//if (isset($_POST) && !empty($_POST)) {
    //	login($_POST);
	//}
?> -->

<?php 
  if (isset($_POST) && !empty($_POST)) {
    if (userLogin() !== false && userPassword() !== false) {
      $_SESSION['access'] = true;
      $_SESSION['author'] = $_POST['login'];
      header('Location: /admin.php');
    } else {
      header('Location: /access_denied.php');
    }
  }
?>

	<header class="masthead" style="background-image: url('img/contact-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading">
              <h1>Вход</h1>
              <span class="subheading">Новый пост</span>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="col-lg-4 col-md-8 mx-auto">
    	<form method="POST" action="authorization.php">
    		<label for="login">Login</label>
	    	<p>
	    		<input type="text" name="login" placeholder="login">
	    	</p>
	    	
	    	<label for="password">Пароль</label>
	    	<p>
	    		<input type="password" name="password">
	    	</p>
    	
    		<input type="submit">
    	</form>
    	
    	
    </div>

<?php  require_once 'footer.php'; ?>