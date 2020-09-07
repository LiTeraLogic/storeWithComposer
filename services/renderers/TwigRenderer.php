<?php
namespace App\services\renderers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
class TwigRenderer implements IRenderer
{
    private $twig;

    // загружаем FilesystemLoader, передаем директории где лежат шаблоны
    //с помощью загрузчика подгружаем все директории
    public function __construct()
    {
        $loader = new FilesystemLoader([
            dirname(__DIR__, 2) . '/views/',
            dirname(__DIR__, 2) . '/views/layouts/'
        ]);

        $this->twig = new Environment($loader);

//        $this->twig = new Environment(
//            $loader,
//            [
//                'debug' => true,
//            ]
//        );
//        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    /**
     * @param $template
     * @param array $params
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render($template, $params = [])
    {
        $name = $template . ".twig";
//        try {
//            $content = $this->twig->render($template, $params);
//        } catch (\Exception $exception) {
//            $content = 'Не верное работа рендеринга';
//        }
        //return $content;
        return $this->twig->render($name, $params);
    }

}