<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $this->render('layouts/admin/admin_dashboard.html.twig');
    }

}
