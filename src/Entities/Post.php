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

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     */
    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return ?string
     */
    public function getLede(): ?string
    {
        return $this->lede;
    }

    /**
     * @param ?string $lede
     */
    public function setLede(?string $lede): void
    {
        $this->lede = $lede;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    /**
     * @param string $authorName
     */
    public function setAuthorName(string $authorName): void
    {
        $this->authorName = $authorName;
    }

    /**
     * @return DateTime
     */
    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate(string $creationDate): void
    {
        $this->creationDate = new DateTime($creationDate);
    }

    /**
     * @return DateTime
     */
    public function getLastModifiedDate(): DateTime
    {
        return $this->lastModifiedDate;
    }

    /**
     * @param string $lastModifiedDate
     */
    public function setLastModifiedDate(string $lastModifiedDate): void
    {
        $this->lastModifiedDate = new DateTime($lastModifiedDate);
    }


}
