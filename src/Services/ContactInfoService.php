<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\ContactInfo;
use App\Models\ContactInfoModel;

class ContactInfoService
{
    private ContactInfoModel $contactInfoModel;

    public function __construct(ContactInfoModel $contactInfoModel)
    {
        $this->contactInfoModel = $contactInfoModel;
    }

    public function getContactInfos() : array
    {
        return array_map(function($comment){
            return new ContactInfo($comment);
        }, $this->contactInfoModel->getContactInfos());
    }

    public function updateContactInfos(array $contactInfos) : void
    {
        $newContactInfos = [];
        foreach ($contactInfos as $key => $value) {
            $newContactInfos[] = array($value, $key);
        }
        $this->contactInfoModel->updateContactInfos($newContactInfos);
    }
}
