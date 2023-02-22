<?php
declare(strict_types=1);

namespace App\Entities;

use App\Core\Entity;
use DateTime;

class Post extends Entity
{
    private int $postId;
    private int $userId;
    private string $title;
    private ?string $lede;
    private string $content;
    private string $authorName;
    private DateTime $creationDate;
    private DateTime $lastModifiedDate;

    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getLede(): ?string
    {
        return $this->lede;
    }

    public function setLede(?string $lede): void
    {
        $this->lede = $lede;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): void
    {
        $this->authorName = $authorName;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(string $creationDate): void
    {
        $this->creationDate = new DateTime($creationDate);
    }

    public function getLastModifiedDate(): DateTime
    {
        return $this->lastModifiedDate;
    }

    public function setLastModifiedDate(string $lastModifiedDate): void
    {
        $this->lastModifiedDate = new DateTime($lastModifiedDate);
    }
}
