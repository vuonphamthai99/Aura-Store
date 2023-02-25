<?php
/**
* Format Class
*/
    class Format{
        public function formatDate($date){
            return date('F j, Y, g:i a', strtotime($date));
        }

        public function textShorten($text, $limit = 400){
            $text = $text. " ";
            $text = substr($text, 0, $limit);
            $text = substr($text, 0, strrpos($text, ' '));
            $text = $text.".....";
            return $text;
        }

        public function validation($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function title(){
            $path = $_SERVER['SCRIPT_FILENAME'];
            $title = basename($path, '.php');
            //$title = str_replace('_', ' ', $title);
            if ($title == 'index') {
            $title = 'home';
            }elseif ($title == 'contact') {
            $title = 'contact';
            }
            return $title = ucfirst($title);
        }

        function adddotstring($strNum) {
        
            $len = strlen($strNum);
            $counter = 3;
            $result = "";
            while ($len - $counter >= 0)
            {
                $con = substr($strNum, $len - $counter , 3);
                $result = '.'.$con.$result;
                $counter+= 3;
            }
            $con = substr($strNum, 0 , 3 - ($counter - $len) );
            $result = $con.$result;
            if(substr($result,0,1)=='.'){
                $result=substr($result,1,$len+1);
            }
            return $result;
        }
    }
?>
