<?php

namespace WPDesk\Forms;

interface Serializer {
	public function serialize( $value );

	public function unserialize( $value );
}
