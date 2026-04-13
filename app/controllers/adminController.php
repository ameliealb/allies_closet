<?php

//shows dashboard only if the user is logged in AND if its role is 'admin'
function showDashboard()
{
    if (!isset($_SESSION['user'])) {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    if ($_SESSION['user']['role'] !== 'admin') {
        header('Location: /projet-final/index.php?action=default');
        exit;
    }

    require RACINE . '/app/views/admin/dashboardView.php';
}