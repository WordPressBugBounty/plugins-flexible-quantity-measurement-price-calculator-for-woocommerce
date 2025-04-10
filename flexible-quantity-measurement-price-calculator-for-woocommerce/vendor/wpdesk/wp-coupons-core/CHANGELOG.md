## [2.3.0] - 2025-01-04
* Added logger from main plugin 
* Fixed some security issues

## [2.2.3] - 2024-12-23
* Fixed ArrayAccess compatibility notice in php 8

## [2.2.2] - 2024-12-11
* Fixed bulk variations update

## [2.2.1] - 2024-11-19
* Fixed EmailMeta array access implementation in php 7.4 

## [2.2.0] - 2024-10-10
* Added blank (parent) option for delay type setting

## [2.1.0] - 2024-10-04
* Added get_plugin_version method into PluginAccess

## [2.0.3] - 2024-09-16
* Fixed multiple PDF addon link and translation

## [2.0.2] - 2024-08-14
* Fixed email meta delay date getter

## [2.0.1] - 2024-08-12
* Added required HTML attribute for required fields

## [2.0.0] - 2024-08-06
* Added support for multiple PDF addon.
* Code refactor made to accept arrays of coupons

## [1.7.6] - 2024-07-25
* Fixed pdf fonts do not work fo some alphabets (ex. cyrillic)

## [1.7.5] - 2024-07-23
* Fixed use of dynamic property notice
* Fixed min and max char validation for some alphabets (ex. cyrillic)

## [1.7.4] - 2024-04-18
* Marketing changes

## [1.7.3] - 2024-03-25
* Update translations

## [1.7.2] - 2024-02-28
* Fixed coupon amount set with tax even when woo settings expects prices without tax

## [1.7.1] - 2023-12-21
* Fixed error when delete coupon 

## [1.7.0] - 2023-09-19
* Added disable PDF Coupon option for variations
* Fixed some links

## [1.6.0] - 2023-08-10
* added hook for qr_code integration

## [1.5.11] - 2023-07-03
* fixed display pro button on coupon template edit page

## [1.5.10] - 2023-06-21
* added settings page with tabs
* fixed send email to both buyer and recipient

## [1.5.9] - 2023-02-22
* fixed issue with old coupons
* fixed issue on edit product page
## [1.5.8] - 2023-01-12
* fixed coupons for virtual variations
## [1.5.7] - 2023-01-12
* added option to create not only virtual coupons for variations

## [1.5.6] - 2022-12-29
* show shipping tab

## [1.5.5] - 2022-12-16
* added option to create not only virtual coupons

## [1.5.4] - 2022-11-17
* fixed issue with metabox on orders page

## [1.5.3] - 2022-11-16
* refactor register_meta_boxes_action method
## [1.5.2] - 2022-11-16
* added support for WooCommerce high performace order storage

## [1.5.1] - 2022-10-11
* added arguments for coupon code filters
* generate pot
* added docs url

## [1.5] - 2022-08-18
* fixed coupon code
* added template cloning
* added init hook

## [1.4.12] - 2022-07-19
* added item to shortcode value container

## [1.4.11] - 2022-07-14
* fixed nested settings

## [1.4.10] - 2022-04-14
* added character counter for text field
* added prompts for fields
* added coupon URL on the page
* fixed regular price for variants
* fixed expiration date when date format is empty

## [1.4.9] - 2022-03-14
* fixed loading variation fields when product was added as shortcode
* fixed notice in settings

## [1.4.8] - 2022-02-10
* fixed css
* remove unused fields
* fixed header

## [1.4.7] - 2022-01-13
* added setting to use regular price

## [1.4.6] - 2021-12-08
* fixed php fatal

## [1.4.5] - 2021-12-02
* fixed php warning

## [1.4.4] - 2021-12-01
* fixed js

## [1.4.3] - 2021-11-09
* fixed cart validation
* fixed security issues
* update libraries

## [1.4.2] - 2021-10-12
* removed flexible_coupons_pdf_filename hook, use fcpdf/core/pdf/filename
* removed flexible_coupons_coupon_code_random_lenght hook, use fcpdf/core/coupon/code/length
* removed flexible_coupons_coupon_code_prefix hook, use fcpdf/core/coupon/code/prefix
* removed flexible_coupons_font_data hook, use fcpdf/core/fonts/data
* removed flexible_coupons_font_dir hook, use fcpdf/core/fonts/dir

## [1.4.2] - 2021-07-12
* fixed own coupon expiring date

## [1.4.1] - 2021-06-24
* fixed coupon expiring
* fixed PDF class
* fixed notices

## [1.4.0] - 2021-03-31
* added support for variations
* added coupon code settings
* added field for define own expiration time
* added 'fcpdf/core/pdf/filename' filter to change filename of PDF file attached in email or downloaded
* added 'fc/core/editor/fonts' filter to adds new fonts to editor.
* added 'fcpdf/core/fonts/dir' filter to manipulate PDF library font directories.
* added 'fcpdf/core/fonts/data' filter to manipulate PDF library fonts data.
* added 'fcpdf/core/coupon/code/suffix' filter to manipulate coupon suffix.
* remove 'flexible_coupons_coupon_code_prefix' filter in next minor version.
* remove 'flexible_coupons_coupon_code_random_lenght' filter in next minor version.

## [1.3.0] - 2021-02-09
- fixed tab visibility
- fixed required custom fields
- fixed mpdf library

## [1.2.4] - 2020-12-17
- added usage restriction for PDF coupon on the product edit page
- changed PDF Coupon view on the product edit page
- added filter 'fcpdf/core/coupon/code/length' for change coupon code length
- added filter 'fcpdf/core/coupon/code/prefix' for change coupon code prefix
- added filter 'fcpdf/core/coupon/expiry' for change coupon expires date
- added filter 'fcpdf/core/coupon/before/create' for change coupon object
- added filter 'fcpdf/core/coupon/before/after' for change meta data saved to post meta
- added 'never' option for expiration date of the coupon on the product edit page
- fixed bug for auto generating vouchers with other products
- fixed font rendering on the template editor

## [1.2.3] - 2020-11-30
### added
- added my account
- rename shortcode
- added fcpdf_shortcodes filter

## [1.2.3] - 2020-11-30
### Added
- added my account
- rename shortcode
- added fcpdf_shortcodes filter

## [1.2.2] - 2020-09-14
### Added
- added support for chinese, cyrylic and latin extended for fonts

## [1.2.1] - 2020-09-11
### Fixed
- fixed price format

## [1.2.0] - 2020-08-17
### Fixed
- fixed email template

## [1.1.3] - 2020-07-16
### Fixed
- fixed JS for woocommerce metabox

## [1.1.2] - 2020-07-16
### Fixed
- hide unused checkbox

## [1.1.1] - 2020-07-14
### Fixed
- metabox in all post types.

## [1.1.0] - 2020-06-18
### Fixed
- deep refactor (class names, interfaces)
- added sample templates for coupons
- remove attachment from email
- added better shortcode implementation

## [1.0.1] - 2020-06-06
### Fixed
- custom product fields

## [1.0.0] - 2020-06-06
### Added
- init
