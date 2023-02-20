<?php
declare(strict_types=1);

namespace App\Services;


use App\Core\MessageType;
use App\Core\Session;

class BlogCustomizationService
{
    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getBlogCustomization() : array
    {
        return yaml_parse_file(__DIR__ . '/../../config/blogCustomization.yml');
    }

    public function saveBlogCustomization(array $customizations) : void
    {
       yaml_emit_file(__DIR__ . '/../../config/blogCustomization.yml', $customizations);
    }

    public function uploadNewAvatar(array $uploadedFile) : bool
    {
        $uploadPath = __DIR__ . '/../../public/img/admin/avatar.png';
        $fileSize = $uploadedFile['size'];
        $fileTmpName  = $uploadedFile['tmp_name'];
        $ext = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);

        if ($fileSize >= 2000000) {
            $this->session->addMessage("Error : could not upload new avatar - file size is over 2 MB.", MessageType::Error);
            return false;
        }

        $newImg = match ($ext) {
            'jpg', 'jpeg' => imagecreatefromjpeg($fileTmpName),
            'png' => imagecreatefrompng($fileTmpName),
            'gif' => imagecreatefromgif($fileTmpName),
            default => false
        };

        if (!is_uploaded_file($fileTmpName) || !$newImg || !imagepng($newImg, $uploadPath)) {
            $this->session->addMessage("Error : could not upload new avatar - incompatible file type.", MessageType::Error);
            return false;
        }

        $this->session->addMessage("New avatar successfully uploaded.", MessageType::Success);
        return true;
    }

}