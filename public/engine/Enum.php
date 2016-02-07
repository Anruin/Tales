<?php

abstract class Enum {
	private $current_val;

	final public function __construct( $type ) {
		$class_name = get_class( $this );

		$type = strtoupper( $type );
		if ( constant( "{$class_name}::{$type}" )  === NULL ) {
			throw new Enum_Exception( 'Свойства '.$type.' в перечислении '.$class_name.' не найдено.' );
		}

		$this->current_val = constant( "{$class_name}::{$type}" );
	}

	final public function __toString() {
		return $this->current_val;
	}
}

class Enum_Exception extends Exception {}