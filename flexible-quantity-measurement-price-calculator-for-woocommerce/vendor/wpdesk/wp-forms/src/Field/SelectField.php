<?php

namespace WPDesk\Forms\Field;

class SelectField extends BasicField {

	public function get_template_name() {
		return 'select';
	}

	public function set_options( $options ) {
		$this->meta['possible_values'] = $options;

		return $this;
	}

	public function set_multiple() {
		$this->attributes['multiple'] = true;

		return $this;
	}
}
