<?php
declare(strict_types=1);

namespace App\Entities;

use App\Core\Entity;

class ContactInfo extends Entity
{
    private string $name;
    private string $url;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
