<?php

//shows dashboard only if the user is logged in AND if its role is 'admin'
function showDashboard()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
        exit;
    }

    if ($_SESSION['user']['role'] !== 'admin') {
        show403();
    }

    require RACINE . '/app/views/admin/dashboardView.php';
}
