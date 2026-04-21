<?php

//shows dashboard only if the user is logged in AND if its role is 'admin'
function showDashboard()
{
    //if user not logged, displays login page
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
        exit;
    }

    //if not admin, displays 403 page (forbidden access)
    if ($_SESSION['user']['role'] !== 'admin') {
        show403();
    }

    //if logged AND admin then displays dashboard view
    require RACINE . '/app/views/admin/dashboardView.php';
}
