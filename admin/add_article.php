<?php require_once 'header.php' ?>

    <div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin/main.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Add new</li>
        </ol>
        <?php
            if ($_POST) {
                insertArticle($_POST);
            }
        ?>

        <!-- Example DataTables Card-->
        <div class="row">
            <div class="col-12">
                <form method="POST" action="add_article.php">
                    
                    <p>
                        <label>Title:<br>
                        	<input name="title" type="text" value="" placeholder="">
                        </label>
                    </p>
                    
                    
                    <p>
                        <label>Sub Title:<br>
                        	<textarea rows="5" cols="80" name="sub_title"></textarea>
                        </label>
                    </p> 
                    
                    
                    <p>
                        <label>Content:<br>
                        	<textarea rows="5" cols="80" name="content"></textarea>
                        </label>
                    </p>
                    
                    
                    <button class="btn btn-success">Создать</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->

<?php require_once 'footer.php' ?>