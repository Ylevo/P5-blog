<?php
declare(strict_types=1);

namespace App\Entities;

use App\Core\Entity;
use DateTime;

class Comment extends Entity
{
    private int $commentId;
    private int $postId;
    private int $userId;
    private string $content;
    private string $authorName;
    private DateTime $creationDate;
    private bool $validated;

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function setCommentId(int $commentId): void
    {
        $this->commentId = $commentId;
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

    public function getValidated(): bool
    {
        return $this->validated;
    }

    public function setValidated(int $validated): void
    {
        $this->validated = (bool)$validated;
    }
}
