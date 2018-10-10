<?php
    class Models extends Controller{
        function endsWith($haystack, $needle)
        {
            $length = strlen($needle);
            if ($length == 0) {
                return true;
            }

            return (substr($haystack, -$length) === $needle);
        }
        public function run(){
            
            $this->models = array_filter(scandir('Gallery/'), function($filename){
                return $this->endsWith($filename, ".png")
                    || $this->endsWith($filename, ".jpg");
            }); 
        }
    }
?>