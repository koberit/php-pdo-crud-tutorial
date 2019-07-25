<?php
require_once 'formprocess.php';
 ?>

<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PHP MYSQL PDO TUTORIAL</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">KOBERIT Tutorials</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <?php
        if(isset($_SESSION['msg']) && isset($_SESSION['msg-class'])){
       ?>
        <div class="alert alert-<?= $_SESSION['msg-class']; ?>" role="alert">
          <?= $_SESSION['msg']; ?>
        </div>
      <?php
        unset($_SESSION['msg']);
        unset($_SESSION['msg-class']);
      }
       ?>
      <div class="row mt-5">
        <h3>Daten eintragen</h3>
        <form method="post" action="formprocess.php" class="col-12">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Firstname" name="firstname">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Lastname" name="lastname">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" placeholder="E-Mail" name="email">
            </div>
            <input type="submit" class="btn btn-primary" name="submit">
        </form>
      </div>

      <div class="row mt-5">
        <h3>Gespeicherte Daten</h3>
        <?php
        $results = $crud->getMembers();
        ?>
        <table class="table table-hover" class="col-12">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Firstname</th>
              <th scope="col">Lastname</th>
              <th scope="col">E-Mail</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($results as $result){
             ?>
            <tr>
              <th scope="row"><?= $result['id']; ?></th>
              <td><?= $result['firstname']; ?></td>
              <td><?= $result['lastname']; ?></td>
              <td><?= $result['email']; ?></td>
              <td><a class="btn btn-primary" href="index.php?edit=<?= $result['id']; ?>">EDIT</a><a class="btn btn-danger ml-3" href="index.php?delete=<?= $result['id']; ?>">DELETE</a></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <?php
      if(isset($_GET['edit'])){
        $result = $crud->getMember($_GET['edit']);
      ?>
      <div class="row mt-5">
        <h3>UPDATE</h3>
        <form method="post" action="formprocess.php" class="col-12">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Firstname" name="firstname" value="<?= $result['firstname']; ?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Lastname" name="lastname" value="<?= $result['lastname']; ?>">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" placeholder="E-Mail" name="email" value="<?= $result['email']; ?>">
            </div>
            <input type="hidden" name="id" value="<?= $result['id']; ?>">
            <input type="submit" class="btn btn-primary" name="update">
        </form>
      </div>

      <?php
      }
      ?>

    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  </html>
