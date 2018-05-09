<?php

/**
 * Description of System
 *
 * @author lucas
 */
class System extends Routes
{

    public $url,
            $exploder,
            $controller,
            $action,
            $params,
            $runController;

    public function __construct()
    {
        parent::__construct();

        $this->setUrl();
        $this->setExploder();
        $this->setController();
        $this->setAction();
        $this->setParams();
    }

    public function getUrl()
    {
        return $this->url;
    }

    private function setUrl()
    {
        $this->url = isset($_GET['url']) ? $_GET['url'] : 'home';
    }

    private function setExploder()
    {
        $this->exploder = explode('/', $this->url);
    }

    private function setController()
    {
        if (empty($this->exploder[0]) || is_null($this->exploder[0]) || !isset($this->exploder[0])) {
            $this->controller = 'home';
        } else {
            if (array_key_exists($this->exploder[0], $this->map)) {
                $this->controller = $this->map[$this->exploder[0]]['controller'];
            }
        }
    }

    public function getController()
    {
        return $this->controller;
    }

    private function setAction()
    {
        if (empty($this->exploder[0]) || is_null($this->exploder[0]) || !isset($this->exploder[0])) {
            $this->action = 'getHome';
        } else {
            if (array_key_exists($this->exploder[0], $this->map)) {
                $this->action = $this->map[$this->exploder[0]]['method'];
            }
        }
    }

    public function getAction()
    {
        return $this->action;
    }

    private function setParams()
    {
        if (end($this->exploder) == null) {
            array_pop($this->exploder);
        }

        if (empty($this->exploder)) {
            $this->params = array();
        } else {
            foreach ($this->exploder as $value) {
                $params[] = $value;
            }
            $this->params = $params;
        }
    }

    public function getParams($indice)
    {
        return isset($this->params[$indice]) ? $this->params[$indice] : null;
    }

    private function ValidaController()
    {
        if (!file_exists($this->runController)) {
            header('HTTP/1.0 404 Not Found');
            define('ERROR', 'Controller ' . $this->runController . ' não existe');
            include 'view/404.php';
            exit();
        }
    }

    public function Run()
    {
        $ctrl = $this->getController();
        $this->runController = 'controller/' . $ctrl . '.php';

        $this->ValidaController();
        $act = $this->action;

        $ctrlObj = new $ctrl();
        $ctrlObj->$act();
    }

}
