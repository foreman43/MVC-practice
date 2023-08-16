<?php
namespace app\core;

class Application
{
    public static string $ROOT;
    public static Application $app;

    public string $userClass;
    public Database $db;
    public Routing $routing;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public Session $session;
    public ?ActiveRecord $user = null;

    public function __construct(array $config)
    {
        $this->userClass = $config["userClass"];
        $this->request = new Request();
        $this->routing = new Routing($this->request);
        $this->response = new Response();
        $this->session = new Session();
        $this->db = new Database($config["db"]);
        $this->controller = new Controller();

        self::$ROOT = $config["root"];
        self::$app = $this;

        $primaryValue = $this->session->get("user");
        if($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
    }

    public function run(): void
    {
        echo $this->routing->resolve();
    }

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }

    public function login(ActiveRecord $user): bool
    {
        $this->user = $user;
        $primaryKey = $user::primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set("user", $primaryValue);
        return true;
    }

    public function logout(): void
    {
        $this->session->remove("user");
    }
}