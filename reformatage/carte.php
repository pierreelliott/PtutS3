<?php
    include_once('modele/Model.php');

    if (!isset($_GET['section']) OR $_GET['section'] == 'index')
    {
        include('controleur/carte/index.php');
    }