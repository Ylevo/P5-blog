<?php
declare(strict_types=1);

namespace App\Core;

use App\Models\ContactInfoModel;
use App\Services\BlogCustomizationService;
use App\Services\ContactInfoService;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

abstract class Controller
{
    protected Environment $twig;
    protected Session $session;

    public function __construct()
    {
        $this->session = new Session();
        $this->twig = new Environment(new FilesystemLoader('templates', getcwd().'/../'));
        $this->twig->addGlobal('session', $this->session);
        $this->twig->addGlobal('CSRFToken', $_SESSION['CSRFToken']);
        $this->twig->addGlobal('blogCustomization', $this->getBlogCustomization());
        $this->twig->addFunction(new TwigFunction('getContactInfos', [$this, 'getContactInfos']));
    }

    public function render(string $template, array $params = []): void
    {
        echo $this->twig->render($template, $params);
    }

    public function badRequest() : void
    {
        $this->session->addMessage("Error 400 : bad request.", MessageType::Error);

        header("Location: /");
        exit();
    }

    public function getPaginationPage() : int
    {
        if (empty($_POST['pageNumber'])) {
            $this->badRequest();
        }

        return (int)(empty($_POST['pageNumber'][0]) ? $_POST['pageNumber'][1] : $_POST['pageNumber'][0]);
    }

    public function getContactInfos() : array
    {
        return (new ContactInfoService(new ContactInfoModel()))->getContactInfos();
    }

    public function getBlogCustomization() : array
    {
        return (new BlogCustomizationService($this->session))->getBlogCustomization();
    }


}