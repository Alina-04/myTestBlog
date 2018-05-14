<?php  require_once 'header.php'; ?>

 
<?php
  if ($_POST) {
    registerUser($_POST);
  }
?>

	<header class="masthead" style="background-image: url('img/contact-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading">
              <h1>Вход</h1>
              <span class="subheading">Новый пост.</span>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="col-lg-6 col-md-8 mx-auto">
    <?php if(getErorMesage()): ?>
    <p style="color: red;"><?= getErorMesage(); ?></p>
    <?php  endif; ?>
    	<form method="POST" action="/register.php">
    		<label for="firstName">Имя</label>
	    	<p>
	    		<input type="text" name="firstName" placeholder="" value="">
	    	</p>
	    	
	    	<label for="lastName">Фамилия</label>
	    	<p>
	    		<input type="text" name="lastName" value="">
	    	</p>

        <label for="login">Логин*</label>
        <p>
          <input type="text" name="login" value="">
        </p>

        <label for="email">Почта*</label>
        <p>
          <input type="email" name="email" value="">
        </p>

        <label for="password">Пароль*</label>
        <p>
          <input type="password" name="password" value="">
        </p>

        <label for="password">Пароль повторно*</label>
        <p>
          <input type="password" name="passwordCon" value="">
        </p>
        
        <p name="role" value="User">
          Пользователь: User
        </p>
            	
    		<button>Отправить</button>
    	</form>
    	
    	
    </div>

<?php  require_once 'footer.php'; ?>