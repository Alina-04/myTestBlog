<?php  require_once 'header.php'; ?>

<?php
  if (isset($_GET['id'])) {
    deleteArticle($_GET['id']);
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
      		<ol class="breadcrumb">
      			<a href="add_article.php">Add post</a>
      		</ol>
      
      <!-- Example DataTables Card-->
      		<div class="card mb-3">
       			<div class="card-header">
          			<i class="fa fa-table"></i> Data Table Example
          		</div>
        		<div class="card-body">
          			<div class="table-responsive">
            			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              				<thead>
                				<tr>
					                <th>Id</th>
					                <th>Title</th>
					                <th>Subtitle</th>
					                <th>Content</th>
					                <th>Date</th>
					                <th>Url</th>
					                <th>Author</th>
					                <th>Actions</th>
                				</tr>
              				</thead>
              				<tfoot>
                				<tr>
                					<th>Id</th>
					                <th>Title</th>
					                <th>Subtitle</th>
					                <th>Content</th>
					                <th>Date</th>
					                <th>Url</th>
					                <th>Author</th>
					                <th>Actions</th>
                				</tr>
              				</tfoot>
              				<tbody>
              					<?php if (getArticles()): ?>
            					<?php foreach (getArticles() as $article): ?>
				                <tr>
				                	<td><?= $article['id']; ?></td>
					                <td><?= $article['title']; ?></td>
					                <td><?= substr($article['sub_title'], 0, 25); ?></td>
					                <td><?= $article['content']; ?></td>
					                <td><?= $article['created_at']; ?></td>
					                <td><?= $article['url']; ?></td>
					                <td><?= $article['author']; ?></td>
					                <td>
					                	<a href="edit_article.php?title=<?= $article['title']; ?>&sub_title=<?= $article['sub_title']; ?>&content=<?= $article['content']; ?>&id=<?= $article['id']; ?>">Edit</a><br>
										        <a href="articles.php?id=<?= $article['id']; ?>">Delete</a>
                          </td>
					            </tr>
					            <?php endforeach; ?>
					            <?php else: ?>
            						<p>Статьи не найдены!</p>
          						<?php endif; ?>
				            </tbody>
            			</table>
          			</div>
        		</div>
        		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      		</div>
    	</div>

<?php  require_once 'footer.php'; ?>