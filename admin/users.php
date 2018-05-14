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
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Last name</th>
                          <th>Login</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Role</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Last name</th>
                          <th>Login</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Role</th>
                          <th>Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php if (getUsers()): ?>
                        <?php foreach (getUsers() as $article): ?>
                        <tr>
                          <td><?= $article['id']; ?></td>
                          <td><?= $article['name']; ?></td>
                          <td><?= $article['last_name']; ?></td>
                          <td><?= $article['login']; ?></td>
                          <td><?= $article['email']; ?></td>
                          <td><?= $article['password']; ?></td>
                          <td><?= $article['role']; ?></td>
                          <td>
                            <!-- <a href="edit_article.php?title=<?= $article['title']; ?>&sub_title=<?= $article['sub_title']; ?>&content=<?= $article['content']; ?>&id=<?= $article['id']; ?>">Edit</a><br>
                            <a href="articles.php?id=<?= $article['id']; ?>">Delete</a> -->
                          </td>
                      </tr>
                      <?php endforeach; ?>
                      <?php else: ?>
                        <p>Пользователи не найдены!</p>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
      </div>

<?php  require_once 'footer.php'; ?>