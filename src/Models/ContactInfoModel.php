<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class ContactInfoModel extends Model
{
    public function getContactInfos() : array
    {
        return $this->database->run('SELECT * from contact_info')->fetchAll();
    }

    public function updateContactInfos(array $contactInfos) : void
    {
        $this->database->runTransaction('UPDATE contact_info SET url = ? WHERE name = ?', $contactInfos);
    }
}