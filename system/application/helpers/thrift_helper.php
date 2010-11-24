<?php
/*
 * Izitrip
 *
 * @package Izitrip
 * @author The Izitrip Team
 * @subpackage Thrift Helper, providing Thrifts data objects serializing functions for Code Igniter
*/

//
// Thrift data object serializer, returns the serialized content
//
if( !function_exists('tSerialize') ) {

  function tSerialize($object) {

    // Note : Use it in a try/catch !

    // Loads the buffer and the protocol handler
    $buffer = new TMemoryBuffer();
    $protocol = new TBinaryProtocol($buffer);

    // Writing the serialized content in the buffer
    $object->write($protocol);

    // Returning the serialized content
    return $buffer->getBuffer();
	
  }

}


//
// Unserialize and loads up content into a Thrift data object
//
if( !function_exists('tUnserialize') ) {

  function tUnserialize($object, $serializedContent) {

  // Note : Use it in a try/catch !
  // Note : $object is a reference and will be modified !

  // Loads the buffer and the protocol handler
  $buffer = new TMemoryBuffer($serializedContent);
  $protocol = new TBinaryProtocol($buffer);  

  // Loading the serialized content into the targeted object
  $object->read($protocol);
  
  }
  
}

?>