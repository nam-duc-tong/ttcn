<?php
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/database.php');
 include_once ($filepath.'/../helpers/dbhelper.php');
?>
<?php
    class user{  
        private $fm;
        private $db;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        }                                                                                                   

    }

?>    