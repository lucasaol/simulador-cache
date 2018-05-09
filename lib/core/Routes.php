<?php

/**
 * Description of Routes
 *
 * @author lucas
 */
class Routes {

    protected $map = array();
    private $model;

    public function __construct() {
        $this->model = new Model();
        $this->processMap();
    }

    public function setMap($map) {
        $this->map = $map;
    }

    public function getMap() {
        return $this->map;
    }

    private function processMap() {
        $this->map = array(
            'home' => array(
                'controller' => 'HomeCtrl',
                'method' => 'getHome',
                'view' => 'home',
                'layout' => 'default'
            ),
            'inicia-cache' => array(
                'controller' => 'CacheCtrl',
                'method' => 'getInicio',
                'view' => 'inicia-cache',
                'layout' => 'default'
            ),
            'simulacao' => array(
                'controller' => 'CacheCtrl',
                'method' => 'getSimulacao',
                'view' => 'simula',
                'layout' => 'default'
            )
        );
    }

}
