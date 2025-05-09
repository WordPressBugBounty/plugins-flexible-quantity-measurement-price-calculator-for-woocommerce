<?php

namespace WDFQVendorFree\WPDesk\Forms;

/**
 * @class FieldRenderer
 */
interface FieldRenderer
{
    /**
     * @param FieldProvider $provider
     * @param array $fields_data
     * @param string $name_prefix
     *
     * @return string|array String or normalized array
     */
    public function render_fields(FieldProvider $provider, array $fields_data, $name_prefix = '');
}
