<?php
namespace app\core;


class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public static string $ROOT_DIR;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        self::$app = $this;
    }

    public function run()
    {
        echo $this->router->resolve();
    }

}