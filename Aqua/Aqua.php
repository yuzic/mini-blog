<?php
namespace Aqua;

use Aqua\Base\Request;

class Aqua
{
    /** @var  \Aqua\Aqua $app */
    static $app = null;

    static $config = null;

    public function getRootPath()
    {
        return Request::getDocumentRoot();
    }

    public function getView()
    {
        return new \Aqua\Base\View();
    }

    public function getRouter()
    {
        return new \Aqua\Base\Router();
    }

    /**
     * @return \Aqua
     */
    public function init()
    {
        self::$app = new self;

        return self::$app;
    }

    public function setConfig(array $config)
    {
        self::$config = $config;
    }

    public static function getConfig()
    {
        return self::$config;
    }



}
