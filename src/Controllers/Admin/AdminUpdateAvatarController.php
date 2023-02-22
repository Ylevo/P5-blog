<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\MessageType;
use App\Services\BlogCustomizationService;

class AdminUpdateAvatarController extends Controller
{
    public function updateAvatar() : void
    {
        if (empty($_FILES)) {
            $this->session->addMessage("Error : could not upload new avatar - file size is over 2 MB.", MessageType::Error);
        } else {
            (new BlogCustomizationService($this->session))->uploadNewAvatar($_FILES['newAvatar']);
        }

        $this->render('layouts/admin/admin_dashboard.html.twig');
    }
}
