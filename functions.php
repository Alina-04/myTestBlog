<?php

	session_start();

	function connectDb(){

	    try {
	    	$dbh = new PDO('mysql:host=localhost;dbname=myblog.com;charset=UTF8', 'root', 'moysql04');

	        // mysql_query("SET NAMES utf8");
	    	return $dbh;
	    } catch (PDOException $e) {
	        print "Error!: " . $e->getMessage() . "<br/>";

	        return false;
	    }
	}	

	// function selectPosts(){
	// 	$link = connectDb();
	// 	$sql = 'SELECT * FROM `articles` WHERE 1';
	// 	echo "$post";
	// }

	function loginPassData(){
		$db = connectDb();
			if ($db) {
				$sql = "SELECT `login`, `password` FROM `users`";

				return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			}
			return false;
	}

	function userLogin(){
		if (isset($_POST['login']) && !empty($_POST['login'])) {
			$login = $_POST['login'];
		}
		if (loginPassData()){
			$arr = loginPassData();
				foreach($arr as $key => $value) {
		        	if($login === $value) {
		            	return true;
		        	} elseif (is_array($value)) {
		        		foreach ($value as $k => $v) {
		        			if ($login === $v) {
		        				return true;
		        			}
		        		}
		        	}
		    	}
		}
		return false;
	}


	function userPassword(){
		if (isset($_POST['password']) && !empty($_POST['password'])) {
			$password = md5($_POST['password']);
		}
		if (loginPassData()){ 
			$arr = loginPassData();
				foreach($arr as $key => $value) {
		        	//$current_value = $value;
		        		if($password === $value) {
		            		return true;
		        		} elseif (is_array($value)) {
		        			foreach ($value as $k => $v) {
		        				if ($password === $v) {
		        					return true;
		        				}
		        			}
		        		}
		    	}
		}
		return false;
	}

	function getIdAuthor($login){
		$db = connectDb();
	    	if ($db) {
	    		$sql = "SELECT `id` FROM `users` WHERE `login`='$login'";

	    		return $db->query($sql)->fetch(PDO::FETCH_ASSOC);
	    		
	    	}	
	    	return false;
	}
	function getArticleByUrl($str){
		$db = connectDb();
		 if ($db) {
		 	$sql = "SELECT * FROM `articles` WHERE `url`='$str'";

		 	return $db->query($sql)->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}
	// function getUrl($str){
	// 	$url = translit($str);
	// 	$newUrl = getArticleByUrl($url);
	// 		if (!getArticleByUrl($url)) {
	// 			return $url;
	// 		}
	// 		else {
	// 			$useUrl = explode("-", $newUrl);
	// 			$i = 1;
	// 			$resUrl = $url."-".$i++;
	// 		}
	// 		return $resUrl;
	// }
	function getUrl($str){

	    $articleUrl = translit($str);

	    $articleIsset = getArticleByUrl($articleUrl);
	    if (!$articleIsset) {
	        return $articleUrl;
	    } else {
	        $url = $articleIsset['url'];
	        $exUrl = explode('-', $url);
	        if ($exUrl){
	            $temp = (int)end($exUrl);
	            $newUrl = $exUrl[0] . '-'. ++$temp;
	        } else {
	            $temp = 0;
	            $newUrl = $articleUrl . '-'. ++$temp;
	        }
	        
	    }
	    return getUrl($newUrl);
	}

	function insertArticle($userData){
		$db = connectDb();
	    	if ($db) { 	


	    		$sql = "INSERT INTO articles(title, sub_title, content, created_at, url, author ) VALUES ( :title, :subtitle, :content, :created_at, :url, :author)";

	    		$stmt = $db->prepare($sql);
	    		
				$newurl = getUrl($userData['title']);
					
				if ($_SESSION['author']) {
					$id = getIdAuthor($_SESSION['author']);
					$authorId = $id['id'];
				} else {
					return;
				}
	    		
	    		$datetime = new DateTime();
        		$date = $datetime->format('Y-m-d H:i:s');

        		   		
	    		$stmt->bindParam(':title', $userData['title'], PDO::PARAM_STR);
		        $stmt->bindParam(':subtitle', $userData['sub_title'], PDO::PARAM_STR);
		        $stmt->bindParam(':content', $userData['content'], PDO::PARAM_STR);
		        $stmt->bindParam(':created_at', $date, PDO::PARAM_STR);
		        $stmt->bindParam(':url', $newurl, PDO::PARAM_STR);
		        $stmt->bindParam(':author', $authorId, PDO::PARAM_STR);

		        $stmt->execute();
	    	}
	}

	function insertUser($userData){
		$db = connectDb();
		$password = md5($userData['password']);
	    	if ($db) {
	    		
		        $sql = "INSERT INTO users(name, last_name, login, email, password, role) 
		        VALUES ( :name,  :lastName, :login, :email, :password, :role)";

		        $stmt = $db->prepare($sql);

		        $role = "User";

		        $stmt->bindParam(':name', $userData['firstName'], PDO::PARAM_STR);
		        $stmt->bindParam(':lastName', $userData['lastName'], PDO::PARAM_STR);
		        $stmt->bindParam(':login', $userData['login'], PDO::PARAM_STR);
		        $stmt->bindParam(':email', $userData['email'], PDO::PARAM_STR);
		        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
		        $stmt->bindParam(':role', $role, PDO::PARAM_STR);

	    		return $stmt->execute();
	    	}
	}

	function registerUser(array $userData){

		if ($userData['password'] !== $userData['passwordCon']) {
			$_SESSION['eror_message'] = 'Пароли не совпадают!';
			return;
		}
		if (!isset($userData['login']) || empty($userData['login'])) {
			$_SESSION['eror_message'] = 'Ошибка в логине!';
			return;
		}
		if (!isset($userData['email']) || empty($userData['email'])) {
			$_SESSION['eror_message'] = 'Введите почту!';
			return;
		}
		if (insertUser($userData)) {
			$_SESSION['eror_message'] = false;
		}
		else{
			$_SESSION['eror_message'] = 'Ошибка регистрации';
		}
	}

	function translit($str){
	    $alphavit = array(
	    /*--*/
		    "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e",
		    "ё"=>"yo","ж"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l", "м"=>"m",
		    "н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t",
		    "у"=>"y","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch", "ш"=>"sh","щ"=>"sh",
		    "ы"=>"i","э"=>"e","ю"=>"u","я"=>"ya",
		    /*--*/
		    "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g","Д"=>"d","Е"=>"e", "Ё"=>"yo",
		    "Ж"=>"j","З"=>"z","И"=>"i","Й"=>"i","К"=>"k", "Л"=>"l","М"=>"m",
		    "Н"=>"n","О"=>"o","П"=>"p", "Р"=>"r","С"=>"s","Т"=>"t","У"=>"y",
		    "Ф"=>"f", "Х"=>"h","Ц"=>"c","Ч"=>"ch","Ш"=>"sh","Щ"=>"sh",
		    "Ы"=>"i","Э"=>"e","Ю"=>"u","Я"=>"ya",
		    "ь"=>"","Ь"=>"","ъ"=>"","Ъ"=>"", " "=>"_", "."=>"_", ","=>"", "!"=>"", "?"=>"",
		    ";"=>"", ":"=>"", "/"=>"", "|"=>"", "#"=>"",
	    );
    	return (strtr($str, $alphavit));
	}
	// function login(array $post){
	// 	$log = null;
	// 		if (isset($post['login']) && isset($post['password'])) {
	// 			if ($post['login'] == LOGIN && ($post['password']) === PASSWORD) {
	// 				$log = true;
	// 			}
	// 		}
	// 		if ($log) {
	// 			$_SESSION['access'] = true;
	// 			$SESSION['login'] = $post['login'];
	// 			header('Location: /admin.php');
	// 			exit;
	// 		} else {
	// 			$_SESSION['access'] = false;
	// 			header('Location: /accessdenied.php');
	// 			exit;
			
	// 		}
	// }
		
	function getErorMesage(){
		return isset($_SESSION['eror_message'])? $_SESSION['eror_message'] : false;
	}

	// function getPosts(){
	// 	$arr = [];
	// 	for ($i = 1; $i <= 6; $i++) { 
	// 		$arr[] = [
	// 			'title' => 'Весенняя гроза '.$i,
	// 			'postSubtitle' => 'Люблю грозу в начале мая...'.$i,
	// 			'post' => 'Федор Тютчев <br />Весенняя гроза <br />Люблю грозу в начале мая, <br />Когда весенний, первый гром, <br />Как бы резвяся и играя, <br />Грохочет в небе голубом. <br />Гремят раскаты молодые, <br />Вот дождик брызнул, пыль летит, <br />Повисли перлы дождевые, <br />И солнце нити золотит. <br />С горы бежит поток проворный, <br />В лесу не молкнет птичий гам, <br />И гам лесной, и шум нагорный — <br />Всё вторит весело громам. <br />Ты скажешь: ветреная Геба, <br />Кормя Зевесова орла, <br />Громокипящий кубок с неба, <br />Смеясь, на землю пролила. <br /><1828>, начало 1850-х годов '.$i,
	// 			'author' => 'Вася Пупкин'.$i,
	// 		];
	// 	}
	// 	return $arr;
	// }

	// PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8";

	// mysql_query("SET NAMES utf8");

	function enterAdmin(){
		
	}

	function searchBlog($post){
		$db = connectDb();
    		if ($db) {
    		$searching = $post['search'];	
        	$sql = "SELECT * FROM `articles` WHERE `title` LIKE '%$searching%' OR `sub_title` LIKE '%$searching%' OR `content` LIKE '%$searching%'";

        	return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    	}
    	return false;
	}

	function viewTitle(){

	    $arr = explode('.', $_SERVER['REQUEST_URI']);
	    $str = substr($arr[0], 1);
	    	if ($str) {
	        echo 'My Blog - '. ucfirst($str);
	    } else {
	        echo 'My Blog';
		}
	}

	function getArticles(){
		$db = connectDb();
    		if ($db) {
        	$sql = "SELECT * FROM articles";

        	return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    	}
    	return false;
	}

	function viewArticleCount(){
		$db = connectDb();
    		if ($db) {
        	$sql = "SELECT COUNT(1) FROM articles";

        	return $db->query($sql)->fetchcolumn();
    	}
    	return false;
	}
	
	function viewUserCount(){
		$db = connectDb();
    		if ($db) {
        	$sql = "SELECT COUNT(1) FROM `users` WHERE `role`='user'";

        	return $db->query($sql)->fetchcolumn();
    	}
    	return false;
	}

	function getUsers(){
		$db = connectDb();
    		if ($db) {
        	$sql = "SELECT * FROM users";

        	return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    	}
    	return false;
	}

	function getArticle(array $arr){
		$db = connectDb();
    		if ($db) {
	    		$title = $arr['title'];
	    		$subTitle = $arr['sub_title'];
	    		$content = $arr['content'];
	    		var_dump($title);
	    		var_dump($subTitle);
	    		var_dump($content);
	        	$sql = "SELECT * FROM `articles` WHERE `title`='$title', `sub_title`='$subTitle', `content`='$content'";

	        	return $db->query($sql)->fetch(PDO::FETCH_ASSOC);

	        }
    	return false;
	}

	function getAuthor(){
		$db = connectDb();
    		if ($db) {
        	$sql = "SELECT *
                FROM users
                WHERE id='$id'
                ";

        	return $db->query($sql)->fetch(PDO::FETCH_ASSOC);
    	}

    	return false;
	}

	
	function updateArticle($post){

    	$db = connectDb();
    		if ($db) {
    			$id = $post['articleId'];
    			$title = ($post['title']) ? $post['title'] : null;
			    $subTitle = ($post['sub_title']) ? $post['sub_title'] : null;
			    $content = ($post['content']) ? $post['content'] : null;
			    $date = date('F d, Y');

			    $sql = "UPDATE articles SET title = :title, sub_title = :sub_title, content = :content, created_at = :created_at WHERE id= '$id'";
		        $stmt = $db->prepare($sql);
		        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
		        $stmt->bindParam(':sub_title', $subTitle, PDO::PARAM_STR);
		        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
		        $stmt->bindParam(':created_at', $date, PDO::PARAM_STR);
		        
		        $stmt->execute();
			    				
				// $sql = "UPDATE article SET title = :title, sub_title = :subtitle, content = :content WHERE id = '$id'";
 
 			// 	$stmt = $db->prepare($sql);

				// $stmt->bindParam(':title', $post['title'], PDO::PARAM_STR);
		  //       $stmt->bindParam(':subtitle', $post['sub_title'], PDO::PARAM_STR);
		  //       $stmt->bindParam(':content', $post['content'], PDO::PARAM_STR);

	   //  		return $stmt->execute();
        		// return $db->prepare($sql)->execute();

    		}

    	return false;
	}

	function deleteArticle($id)
	{
	    $db = connectDb();
	    if ($db) {
	        $sql = "DELETE FROM article WHERE id='$id'";


	        return $db->prepare($sql)->execute();
	    }

	    return false;
	}

	//    $arr = [
	//        '/' => 'Custom Blog',
	//        '/about.php' => 'Custom Blog - About',
	//        '/post.php' => 'Custom Blog - Post',
	//        '/contact.php' => 'Custom Blog - Contact',
	//    ];
	//
	//    if (isset($arr[$_SERVER['REQUEST_URI']])) {
	//        echo $arr[$_SERVER['REQUEST_URI']];
	//    } else {
	//        echo 'Custom Blog';
	//    }
	//    if ($_SERVER['REQUEST_URI'] === '/') {
	//        echo 'Custom Blog';
	//    } elseif (strpos($_SERVER['REQUEST_URI'], 'about')) {
	//        echo 'Custom Blog - About';
	//    } elseif (strpos($_SERVER['REQUEST_URI'], 'post')) {
	//        echo 'Custom Blog - Post';
	//    } elseif (strpos($_SERVER['REQUEST_URI'], 'contact')) {
	//        echo 'Custom Blog - Contact';
	//    } else {
	//        echo 'Custom Blog';
	//    }
	
?>