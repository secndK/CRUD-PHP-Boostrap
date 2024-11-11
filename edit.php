<?php
include "db_conn.php";

$message = ""; // Variable pour stocker les messages

if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    // Insérer les données dans la table 'crud'
    $sql = "INSERT INTO crud (nom, prenom, email, genre) VALUES ('$firstName', '$lastName', '$email', '$gender')";

    if (mysqli_query($conn, $sql)) {
        $message = "Nouvel utilisateur ajouté avec succès.";
    } else {
        $message = "Erreur : " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <!-- Lien Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function resetForm() {
            document.getElementById("user-form").reset(); // Réinitialise le formulaire
        }

        // Affiche le modal si l'utilisateur a été ajouté avec succès
        function showModal(message) {
            const modalBody = document.getElementById('modal-body');
            modalBody.innerText = message; // Mettre à jour le texte du modal
            const modal = new bootstrap.Modal(document.getElementById('successModal'));
            modal.show(); // Afficher le modal
        }
    </script>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Modifier un utilisateur</a>
        </div>
    </nav>


    <?php

    $id = $_GET['id'];
    $sql = "SELECT * FROM crud WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    
    ?>

    <div class="container mt-4">
        <!-- Formulaire pour ajouter un utilisateur -->
        <form id="user-form" action="add_new.php" method="POST" onsubmit="event.preventDefault(); handleSubmit();">
            <div class="mb-3">
                <label for="first-name" class="form-label">Prénom :</label>
                <input type="text" id="first-name" name="first-name" class="form-control" value="<?php echo $row['nom'] ?>">
            </div>

            <div class="mb-3">
                <label for="last-name" class="form-label">Nom :</label>
                <input type="text" id="last-name" name="last-name" class="form-control" value="<?php echo $row['prenom'] ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $row['email'] ?>">
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Genre :</label>
                
                <select id="gender" name="gender" class="form-select" >
                    <option value="homme" <?php echo ($row['genre'] == 'homme')?
                    "selected":""; ?>>Homme</option>
                    <option value="femme"  <?php echo ($row['genre'] == 'femme')?
                    "selected":""; ?>>Femme</option>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
            <a href="index.php" class="btn btn-outline-secondary">Annuler</a>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Succès</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <!-- Message de succès ou d'erreur ici -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function handleSubmit() {
            const form = document.getElementById('user-form');
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Affiche le modal avec le message de succès ou d'erreur
                showModal( "Nouvel utilisateur ajouté avec succès.");
                resetForm(); // Réinitialiser le formulaire après la soumission
            })
            .catch(error => {
                showModal("Erreur lors de la soumission : " + error.message);
            });
        }
    </script>
</body>
</html>
