<?php 
          session_name("test"); 
          session_start(); 

require_once('_include.php');


          $auth  = new \SimpleSAML\Auth\Simple("admin"); 
          $session = SimpleSAML_Session::getSessionFromRequest(); 
          $session->cleanup(); 

          session_regenerate_id(TRUE); 
            echo "OK";