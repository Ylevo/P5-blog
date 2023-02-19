<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ContactInfoModel;
use App\Services\BlogCustomizationService;
use App\Services\ContactInfoService;

class AdminUpdateCustomizationController extends Controller
{
    public function updateOptions()
    {
        (new BlogCustomizationService($this->session))->saveBlogCustomization(array_intersect_key(
            $_POST, array_flip(['header', 'headerDescription', 'cvUrl'])));
        (new ContactInfoService(new ContactInfoModel()))->updateContactInfos(array_intersect_key(
            $_POST, array_flip(['github', 'linkedin', 'twitter'])));
        $this->session->addErrorMessage("Blog options saved.");
        exit(header("Location: /admin"));
    }

}
                                                                        