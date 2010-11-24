<?php
/*
 * Izitrip
 *
 * @package Izitrip
 * @author The Izitrip Team
 * @subpackage CI_Thrift, Code Igniter Thrif integration class
*/

/*
 * Notes :
 * This class is autoloaded !
 * The CI_Thrift constructor method loads the Thrift's core files
 * and Thrit's generated PHP files (Structures, services ...) automaticaly.
*/

// Defines the Thrift's path
$GLOBALS['THRIFT_ROOT'] = APPPATH . 'libraries/thrift/';

class CI_Thrift
{

  //
  // Thrift PHP core and packages loader (auto loaded with Code Igniter)
  //
  public function CI_Thrift($class = NULL) {
    // Includes the Thrift's core
    require_once($GLOBALS['THRIFT_ROOT'].'/Thrift.php');
    require_once($GLOBALS['THRIFT_ROOT'].'/protocol/TBinaryProtocol.php');
    require_once($GLOBALS['THRIFT_ROOT'].'/transport/TMemoryBuffer.php');

    // Includes the Thrift-generated PHP files (Structures, services ...) 
    // which are located in : /system/application/library/thrift/packages
    $this->load_packages($GLOBALS['THRIFT_ROOT'].'/packages/');
  }

  //
  // Loads up all of the Thrift-generated files (Structures, services ...)
  //
  private function load_packages($path) {  
  
    // If it's a simple php package : we include it
    if(!is_dir($path) && '.php' == substr($path, -4, 4)) {
	  require_once($path);
    }

    // It it's a dir, we walk through it and call this function recursively to include packages
    if(is_dir($path)) { 
	  $packagesDir = dir($path);
	
	  while(false !== ($i = $packagesDir->read())) {
	    if(!preg_match('#^[\.]+$#', $i)) {
		  $this->load_packages($path.'/'.$i);
	    }
	  }
	
	  $packagesDir->close();
    }	
	
  }

}
?>