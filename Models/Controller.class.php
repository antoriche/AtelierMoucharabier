<?php
    abstract class Controller{
        public abstract function run();
        public function render(){
            $this->run();
            require_once VIEWS.get_class($this).'.php';
        }
    }

    abstract class LoggedController extends Controller{
        public function __constructor(){

        }
    }
?>