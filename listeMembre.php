<?php
// On démarre une session
session_start();

// On inclut la connexion à la base
require_once('Bdd.php');

$sql = 'SELECT * FROM `membre` ORDER BY nom ASC';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('closeBase.php');
?>
<!DOCTYPE html>
<html lang="fr">
<?php    
         require_once('haut.php');
?>
<body>
 
    <main class="container-dark bg-dark text-white">
        <div class="row">
            <section class="col-12">
            <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">
                                '. $_SESSION['message'].'
                            </div>';
                        $_SESSION['message'] = "";
                    }
                ?>
                <h1>Liste Des Membres</h1>
                <table class="table" id="example">
                    <thead>
                
                        <th> Matricule</th>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Telephone</th>
                        <th>Action</th>
             
                       
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach($result as $produit){
                        ?>
                            <tr>
                  
                                <td><?= $produit['matricule'] ?></td>
                                <td><?= $produit['prenom'] ?></td>
                                <td><?= $produit['nom'] ?></td>
                                <td><?= $produit['adresse'] ?></td>
                                <td><?= $produit['telephone'] ?></td>
                                <td> <a  href="SaisieCotisation.php?matricule=<?= $produit['matricule'] ?>" class="btn btn-success">Ajouter une Cotisation</a></td>
                             
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>               
            </section>
        </div>
    </main>
</body>
</html>