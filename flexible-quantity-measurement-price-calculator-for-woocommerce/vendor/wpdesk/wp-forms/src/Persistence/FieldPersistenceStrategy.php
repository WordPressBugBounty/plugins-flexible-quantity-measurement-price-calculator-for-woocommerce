<?php

namespace WPDesk\Forms\Persistence;

use Psr\Container\NotFoundExceptionInterface;
use WPDesk\Forms\FieldProvider;
use WPDesk\Persistence\PersistentContainer;

/**
 * Can save/load provided fields to/from PersistentContainer.
 *
 * @package WPDesk\Forms
 */
class FieldPersistenceStrategy {
	/** @var PersistentContainer */
	private $persistence;

	public function __construct( PersistentContainer $persistence ) {
		$this->persistence = $persistence;
	}

	/**
	 * Save fields data.
	 *
	 * @param FieldProvider $fields_provider
	 * @param array $data
	 */
	public function persist_fields( FieldProvider $fields_provider, array $data ) {
		foreach ( $fields_provider->get_fields() as $field ) {
			$field_key = $field->get_name();
			$this->persistence->set( $field_key, $field->get_serializer()->serialize( $data[ $field_key ] ) );
		}
	}

	/**
	 * Load fields data.
	 *
	 * @return array
	 */
	public function load_fields( FieldProvider $fields_provider ) {
		$data = [];
		foreach ( $fields_provider->get_fields() as $field ) {
			$field_key = $field->get_name();
			try {
				$data[ $field_key ] = $field->get_serializer()->unserialize( $this->persistence->get( $field_key ) );
			} catch ( NotFoundExceptionInterface $not_found ) {
				// TODO: Logger
//				LoggerFactory::get_logger()->info( "FieldPersistenceStrategy:: Field {$field_key} not found" );
			}
		}

		return $data;
	}
}
