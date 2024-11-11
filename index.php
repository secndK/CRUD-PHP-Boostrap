<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accueil</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5f9059d052.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

 <!-- La  Navbar -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">CRUD PHP + Bootstrap</a>
        </div>
    </nav>


    <!-- le tableau --> 


    <table class="table table-hover text-center">
  <thead class="table-pink">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Email</th>
      <th scope="col">Genre</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody> 
    <?php
    include "db_conn.php";

    $sql = "SELECT * FROM crud ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {

      ?>
      <tr>
        <td scope="row"><?php echo $row['id'] ?></td>
        <td scope="row"><?php echo $row['nom'] ?></td>
        <td scope="row"><?php echo $row['prenom'] ?></td>
        <td scope="row"><?php echo $row['email'] ?></td>
        <td scope="row"><?php echo $row['genre'] ?></td>
       
        <td>

        <a href="edit.php?id=<?php echo $row['id'] ?>" class="link-dark"><i class="bi bi-pencil-square"></i></a>
        <a href="delete.php?id=<?php echo $row['id'] ?>" class="link-dark"><i class="bi bi-trash3-fill"></i></a>
          
        </td>
    </tr>

      
    <?php




    }


    
    ?>

  



    
   
   
  </tbody>
</table>

<div class="d-flex justify-content-center">
    <a href="add_new.php" class="btn btn-outline-secondary">Ajouter nouveau</a>
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>