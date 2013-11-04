<?php
include_once 'controllers/Buildings.php';
include_once 'controllers/Flights.php';
include_once 'controllers/Messages.php';
include_once 'controllers/Planet.php';
include_once 'controllers/Resources.php';
include_once 'controllers/Ships.php';
include_once 'controllers/Sciences.php';
include_once 'controllers/User.php';
include_once 'controllers/Common.php';
include_once 'functions.php';

class App {

    private static $instance = null;
    public $_buildings = null;
    public $_messages = null;
    public $_flights = null;
    public $_planet = null;
    public $_resources = null;
    public $_ships = null;
    public $_sciences = null;
    public $_user = null;
    public $_common = null;
    
    public $enemyFlights = array();
    
    public $action = null;
    public $url = null;
    public $url_params = null;
    public $act = array();
    public $data = array();

    private function __construct() {
        $this->action = substr(basename($_SERVER['PHP_SELF']), 0, -4);
        $this->url = $_SERVER['REQUEST_URI'];
        $this->url_params = substr($_SERVER['REQUEST_URI'], -(strlen($_SERVER['REQUEST_URI']) - strlen($_SERVER['PHP_SELF'])));
        
        $this->_buildings = new Buildings();
        $this->_flights = new Flights();
        $this->_messages = new Messages();
        $this->_planet = new Planet();
        $this->_resources = new Resources();
        $this->_ships = new Ships();
        $this->_sciences = new Sciences();
        $this->_user = new User();
        $this->_common = new Common();
    }

    public function run() {
        
    }

    /**
     * @return App
     */
    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new App();
        }
        return self::$instance;
    }

}