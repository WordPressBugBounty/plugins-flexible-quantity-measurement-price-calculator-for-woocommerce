## [3.0]
### Changed
- Major change: setting null deletes a value like delete
- Major change: PersistentContainer interface has been changed!
- Behaviour unification of "has" for: null, '', 0, empty
- PHP 7
### Added
- get_fallback method with default value in containers
- WooCommerce session container
- SerializedPersistentContainer

## [2.1.4] - 2020-09-29
### Added
- Interface AllDataAccessContainer
- Implementation of AllDataAccessContainer interface in DelaySinglePersistentContainer class
### Fixed
- Refactor WordPressPostMetaContainer, remove var_dump
- WordpressPostMetaContainer bug on has() method

## [2.1.3] - 2020-06-18
### Fixed
- DelaySinglePersistentContainer bug on has() method

## [2.1.2] - 2020-06-18
### Fixed
- DelaySinglePersistentContainer bug

## [2.1.1] - 2020-06-18
### Added
- Decorator DelaySinglePersistentContainer
### Changed
- Access to DelayPersistentContainer properties

## [2.1.0] - 2020-05-25
### Added
- WordPress serialized container
### Changed
- WordPress adapters namespace

## [2.0.0] - 2020-03-09
### Added
- Adapter for WC_Settings_API
- Adapter for WC_Shipping_Method
- PersistentContainer::has
- PersistentContainer::delete
- DeferredPersistentContainer interface
- Decorator that implements: DeferredPersistentContainer to PersistenContainer
### Changed
- Adapter namespace for all adapters
- MemoryContainer -> ArrayContainer
- Wordpress namespace -> WordPress
- PersistentContainer implements PSR Container
- ElementNotFoundException implements PSR NotFoundExceptionInterface
- Warning: Namespace in options and transients also has been changed

## [1.0.0] - 2019-02-04
### Added
- first stable version