<?php

namespace Horoshop\Test\View;

/**
 * Class View
 *
 * @package Horoshop\Test\View
 */
class View
{
    /**
     * @var string
     */
    private $path;
    /**
    /**
     * @var array
     */
    private $parameters;

    /**
     * View constructor.
     *
     * @param string $file
     * @param array  $params
     */
    public function __construct()
    {
        $path = __DIR__ . "/../../templates/template_page.php";

        $this->path       = $path;

    }
    public function getParams(){
        return $this->parameters;
    }
    public function generate($content_view, array $params = null)
    {
        $this->parameters = $params;
        include($this->path);
    }
    public function __destruct()
    {
        //extract($this->parameters);
        //include($this->path);

    }
}
