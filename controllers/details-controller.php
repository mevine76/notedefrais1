<?php

// nous ouvrons une session
session_start();

// j'inclus les fichiers nécessaires se trouvant dans le fichier config.php
require_once '../config.php';

// j'inclus les fichiers nécessaires se trouvant dans le dossier helpers
require_once '../helpers/Database.php';
require_once '../helpers/Form.php';

// j'inclus les fichiers nécessaires se trouvant dans le dossier models Employees.php
require_once '../models/Employees.php';
require_once '../models/Expense_report.php';














?>

<!-- nous incluons la vue details-view.php -->
<?php include_once '../views/details-view.php' ?>