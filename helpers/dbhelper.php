<?php
    class format{
        public function formatDate($date){
            return date('F j, Y , g:i a', strtotime($date));
        }
        // chua doan text ngan, giup website chuan seo
        public function textShorten($text,$limit=400){
            $text = $text. " ";
            $text = substr($text,0,$limit);
            $text = substr($text, 0 , strrpos($text, ' '));
            $text = $text.'';
            return $text;
        }
        //kiem tra form co trong hay ko
        public function validation($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //kiem tra ten cua server
        public function title(){
            $path = $_SERVER['SCRIPT_FILENAME'];
            $title = basename($path,'.php');
            if($title =='index'){
                $title = 'home';
            } 
            elseif($title == 'contact'){
                $title ='contact';
            }
            return $title = ucfirst($title);
        }
    }

?>