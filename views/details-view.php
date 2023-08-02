<?php
include_once 'template/head.php'


?>

<div id="details" class="container bg-light rounded shadow my-4 p-3 font-pangolin">
    
    

    <?php if ($expense === true) { ?>
        <p class="ms-2 text-center h1 big-h2"><?= $expenseDetails['exp_id'] ?></p>
        <p class="ms-2 text-secondary-emphasis text-center h3"><?= ucfirst($expenseDetails['exp_date'])?></p>
        <p class="ms-2 text-secondary-emphasis text-center h3"><?= ucfirst($expenseDetails['exp_amount_ttc'])?></p>
        <p class="ms-2 text-secondary-emphasis text-center h3"><?= ucfirst($expenseDetails['exp_amount_ht'])?></p>
        <p class="ms-2 text-secondary-emphasis text-center h3"><?= ucfirst($expenseDetails['exp_description'])?></p>
        <p class="ms-2 text-secondary-emphasis text-center h3"><?= ucfirst($expenseDetails['exp_cancel_reason'])?></p>
        <p class="ms-2 text-secondary-emphasis text-center h3"><?= ucfirst($expenseDetails['exp_decision_date'])?></p>
        <p class="text-body-secondary text-center">Statut <?= $expenseDetails['sta_id'] ?></p>
        <hr>
        <div class="row justify-content-center">

            <div class="col-md-5 p-4">
                <img class="img-fluid rounded" src="../controllers/upload/" alt="proof">
            </div>

            <div class="col-md-7 p-4">
                <p class="fw-normal h6"><i class="fa-solid fa-house me-2"></i>Date création note de frais : <?= $expenseDetails['exp_date'] ?></p>
                
                <p class="fw-normal h2"><?= $expenseDetails['exp_description'] ?></p>
            </div>

            <div class="text-center">
                <a href="../index.php" class="btn btn-sm btn-secondary mt-2">Retour</a>
            </div>
            <?php
        //     if ($expenseDetails != false) {
        //     $expenseFound = true;
        // }
        ?>

        </div>
    <?php } else { ?>
        <p class="text-center mt-3 h4">Il n'y a pas de note correspondante</p>
        <div class="text-center">
            <a href="../index.php" class="btn btn-sm btn-secondary mt-2">Retour</a>
        </div>
    <?php } ?>






</div>







<?php include_once 'template/footer.php' ?>
























<?php include_once 'template/footer.php' ?>