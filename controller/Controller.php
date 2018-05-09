<?php

/**
 * Description of Controller
 *
 * @author lucas
 */
class Controller extends System {

    public $dados,
            $data,
            $layout = 'default';
    private $path,
            $pathRender;
    protected $title = null,
            $description = null,
            $model;

    public function __construct() {
        parent::__construct();
        $this->model = new Model();
    }

    private function setPath($render) {
        $this->pathRender = is_null($render) ? $this->getAction() : $render;
        $this->path = 'view/' . $this->pathRender . '.php';
        $this->fileExists($this->path);
    }

    private function fileExists($file) {
        if (!file_exists($file)) {
            die('O arquivo ' . $file . ' não foi localizado');
        }
    }

    private function getTitle() {
        $title = $this->title;
        if (is_null($title)) {
            $title = $this->map[$this->getUrl()]['title'];
        }
        return $title . ' - Be a PRO';
    }

    private function getDescription() {
        if (is_null($this->description)) {
            return $this->map[$this->getUrl()]['description'];
        }
        return $this->description;
    }

    public function view($render = null) {
        $this->setPath($this->map[$this->getUrl()]['view']);
        $this->setLayouts();

        if (is_null($this->layout)) {
            $this->render();
        } else {
            $this->setLayout();
        }
    }

    private function setLayouts() {
        $layout = $this->map[$this->getUrl()]['layout'];
        if (is_null($layout)) {
            $this->layout = 'default';
        } else {
            $this->layout = $layout;
        }
    }

    private function setLayout() {
        $this->layout = 'view/layout/' . $this->layout . '.php';
        if (file_exists($this->layout)) {
            $this->render($this->layout);
        } else {
            die('Não foi possível localizar o layout ' . $this->layout);
        }
    }

    public function render($file = null) {
        if (is_array($this->dados) && count($this->dados) > 0) {
            extract($this->dados);
        }
        
        ob_start();
        if (!is_null($file)) {
            include($file);
        } else {
            $file = is_null($file) ? $this->path : $file;
            file_exists($file) ? include $file : die($file);
        }
        
        $output = ob_get_clean();
        $output = preg_replace("/\s\s+/", ' ', str_replace("\n", '', $output));
        echo $output;
    }

}
