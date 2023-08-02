<?php
include_once 'template/head.php'
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-12 text-center">
            <p class="h1">Bonjour, <?= $_SESSION['user']['firstname'] ?></p>
        </div>
    </div>
    <div class="row justify-content-center mx-0">
        <div class="col-7">

            <p class="text-center">Dernières notes de frais</p>

            <!-- Affichage des notes de frais dans un tableau -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date dépense</th>
                        <th>Description</th>
                        <th>Montant TTC</th>
                        <th>Montant HT</th>
                        <th>Statut</th>
                        <th>Justificatif</th>
                        <!-- Autres en-têtes de colonnes si nécessaire -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connexion à la base de données (à compléter avec vos identifiants)
                    $db_host = "localhost";
                    $db_name = "expense";
                    $db_user = "root";
                    $db_pass = "";

                    try {
                        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Récupérer les données des notes de frais depuis la base de données
                        $stmt = $conn->query("SELECT exp_date, exp_description, exp_amount_ttc, exp_amount_ht, exp_proof, sta_id, typ_id FROM expense_report");
                        $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Définir les types qui auront un taux de TVA de 20% (les trois premiers types)
                        $typesWith20PercentTVA = ['1', '2', '3'];
                        
                        
                        // Afficher les notes de frais dans le tableau
                        foreach ($expenses as $expense) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($expense['exp_date']) . "</td>";
                            echo "<td>" . htmlspecialchars($expense['exp_description']) . "</td>";
                            // var_dump($expense['typ_id']);
                            //Calculer les montants avec TVA selon le type de dépense
                            if (in_array($expense['typ_id'], $typesWith20PercentTVA)) {
                                $tva_rate = 0.10; // 20% TVA
                            } else {
                                $tva_rate = 0.20; // 10% TVA pour les autres types
                            } 
                                
                            
                            //Obtenir le montant TTC
                            $amount_ttc = $expense['exp_amount_ttc'];

                            //Obtenir le taux de TVA en fonction du type de dépense
                            // $tva_rate = ($expense['typ_id'] === 'Type1' || $expense['typ_id'] === 'Type2' || $expense['typ_id'] === 'Type3') ? 0.20 : 0.10;
                            // var_dump($tva_rate);
                            //Calculer le montant HT
                            $amount_ht = $amount_ttc * (1 - $tva_rate);
                            
                            echo "<td>" . number_format($amount_ttc) . " €</td>"; // Montant TTC
                            echo "<td>" . number_format($amount_ht) . " €</td>"; // Montant HT
                            
                            // echo "<td>" . htmlspecialchars($expense['exp_amount_ttc']) . "</td>";
                            // echo "<td>" . htmlspecialchars($expense['exp_amount_ht']) . "</td>";
                            echo "<td>" . htmlspecialchars($expense['sta_id']) . "</td>";
                            
                            echo "<td>" . "<a href='../controllers/details-controller.php'>" . htmlspecialchars($expense['exp_proof']) . "</a>" . "</td>";
                            // Au lieu d'afficher le nom du justificatif, afficher l'image du dossier upload en miniature
                            // echo "<td><img src='../controllers/upload/" . htmlspecialchars($expense['exp_proof']) . "' alt='Justificatif' style='max-height: 100px;'></td>";
                            echo "<td>";
                            
                            if ($expense['sta_id'] === 'en cours') {
                                echo '<span class="badge bg-secondary">En cours</span>';
                            } elseif ($expense['sta_id'] === 'acceptée') {
                                echo '<span class="badge bg-success">Acceptée</span>';
                            } elseif ($expense['sta_id'] === 'réfusée') {
                                echo '<span class="badge bg-danger">Réfusée</span>';
                            }
                            echo "</td>";
                            //Lien "Modifier" pour éditer la note de frais
                            // echo "<td><a href='../controllers/edit-expense-controller.php?id=" . htmlspecialchars($expense['exp_id']) . "'>Modifier</a></td>";

                            // Lien "Supprimer" pour supprimer la note de frais (ajoutez une confirmation JavaScript si nécessaire)

                            // echo "<td><a href='../controllers/delete-expense-controller.php?id=" . htmlspecialchars($expense['id']) . "'>Supprimer</a></td>";
                            // Afficher d'autres colonnes si nécessaire
                            
                            echo "</tr>";
                        }
                    } catch (PDOException $e) {
                        // En cas d'erreur lors de la connexion à la base de données
                        echo "Erreur de connexion à la base de données : " . $e->getMessage();
                    }
                    ?>
                </tbody>
            </table>

            <a class="btn btn-dark mt-4" href="../controllers/expense-form-controller.php">+ Ajout d'une nouvelle note</a>

        </div>
    </div>
</div>

<?php include_once 'template/footer.php' ?>