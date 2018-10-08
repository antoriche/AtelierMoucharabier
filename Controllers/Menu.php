<?php
    class Menu extends Controller{
        private function link($text, $page){
            return (object)['text' => $text, 'page' => $page];
        }
        public function run(){
            $this->elements = [
                $this->link("Présentation","home"),
                $this->link("Modèles","models"),
                $this->link("Gallerie","gallery"),
                $this->link("Contact","contact")
            ];
        }
    }
?>