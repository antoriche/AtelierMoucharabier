<?php
    class Menu extends Controller{
        private function link($text, $page){
            return (object)['text' => $text, 'page' => $page];
        }
        public function run(){
            $this->elements = [
                $this->link("Accueil","Home"),
                $this->link("Modèles","Models"),
                $this->link("Gallerie","Gallery"),
                $this->link("Contact","contact")
            ];
        }
    }
?>