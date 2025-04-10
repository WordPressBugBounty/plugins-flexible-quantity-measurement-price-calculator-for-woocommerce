<?php

namespace WPDesk\Forms\Serializer;

use WPDesk\Forms\Serializer;

class NoSerialize implements Serializer {
	public function serialize( $value ) {
		return $value;
	}

	public function unserialize( $value ) {
		return $value;
	}

}
