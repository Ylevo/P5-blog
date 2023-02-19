<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Services\BlogCustomizationService;

class AdminUpdateAvatarController extends Controller
{
    public function updateAvatar()
    {
        if (empty($_FILES)) {
            $this->session->addErrorMessage("Error : could not upload new avatar - file size is over 2 MB.");
        } else {
            (new BlogCustomizationService($this->session))->uploadNewAvatar($_FILES['newAvatar']);
        }

        exit(header("Location: /admin"));
    }
}
                                                                        