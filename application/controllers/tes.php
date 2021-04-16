<?php
    class tes extends CI_Controller{
        public function tesuhuy(){
            echo hash('sha256', md5('123adminga456'));
            echo '<br>';
            echo substr(md5(time()), 0, 8);
        }
    }
?>