<?php
// On démarre une session
session_start();

// On inclut la connexion à la base
require_once('Bdd.php');

$sql = 'SELECT * FROM `Cotisation`';

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
      

    <main class="container">
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
                <h1>Liste Des cotisations</h1>
                <table class="table" id="example">
                    <thead>
                        <th>NUMERO COTISATION</th>
                        <th>DATE COTISATION</th>
                        <th>MOIS</th>
                        <th>MOTIF</th>
                        <th>MONTANT</th>
                        <th>MATRICULE</th>
                        <th>ACTIONS</th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach($result as $produit){
                        ?>
                            <tr>
                                <td><?= $produit['id'] ?></td>
                                <td><?= $produit['DateCotis'] ?></td>
                                <td><?= $produit['Mois'] ?></td>
                                <td><?= $produit['Motif'] ?></td>
                                <td><?= $produit['Montant'] ?></td>
                                <td><?= $produit['Matricule'] ?></td>
                                <td> <a class="btn btn-success" href="Modifier.php?id=<?= $produit['id'] ?>">Modifier</a> 
                                <a class="btn btn-danger" href="delete.php?id=<?= $produit['id'] ?>" onclick="return confirm('voulez vous vraiment supprimer cette enregistrement')">Supprimer</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>                
            </section>
        </div>
    </main>
    <script>
         $(document).ready(function() {
    $('#example').DataTable( {
        "scrollY":        "800px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
    </script>
</body>
</html>