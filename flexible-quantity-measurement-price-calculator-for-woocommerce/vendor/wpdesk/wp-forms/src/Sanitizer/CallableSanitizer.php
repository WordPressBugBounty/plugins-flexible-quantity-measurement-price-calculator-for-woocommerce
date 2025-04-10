<?php

namespace WPDesk\Forms\Sanitizer;

use WPDesk\Forms\Sanitizer;

class CallableSanitizer implements Sanitizer {
	private $callable;

	public function __construct( $callable ) {
		$this->callable = $callable;
	}

	public function sanitize( $value ) {
		return call_user_func( $this->callable, $value );
	}

}
