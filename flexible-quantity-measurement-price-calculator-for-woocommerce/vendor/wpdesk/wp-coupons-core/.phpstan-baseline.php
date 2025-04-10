<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
	'message' => '#^Access to deprecated property \\$legacy_values of class WC_Order_Item_Product\\:
4\\.4\\.0 For legacy actions\\.$#',
	'identifier' => 'property.deprecated',
	'count' => 3,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method WC_Data\\:\\:get_id\\(\\) with incorrect case\\: get_ID$#',
	'identifier' => 'method.nameCase',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Callback expects 2 parameters, \\$accepted_args is set to 3\\.$#',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:add_cart_item_data_filter\\(\\) has parameter \\$cart_item_data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:add_cart_item_data_filter\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:add_fields_to_product_action\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:add_to_cart_validation_filter\\(\\) has parameter \\$post_data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:field_defaults\\(\\) has parameter \\$field with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:field_defaults\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:get_clone_items_data\\(\\) has parameter \\$post_data with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:get_clone_items_data\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:get_fields\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:get_item_data_filter\\(\\) has parameter \\$cart_item with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:get_item_data_filter\\(\\) has parameter \\$item_data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:get_item_data_filter\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:get_variation_fields\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:is_field_disabled\\(\\) has parameter \\$field with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:new_order_item_action\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_email\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_email\\(\\) has parameter \\$field with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_email\\(\\) has parameter \\$value with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_invalid_date\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_invalid_date\\(\\) has parameter \\$field with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_invalid_date\\(\\) has parameter \\$value with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_maxlength\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_maxlength\\(\\) has parameter \\$field with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_maxlength\\(\\) has parameter \\$value with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_minlength\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_minlength\\(\\) has parameter \\$field with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_minlength\\(\\) has parameter \\$value with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_past_date\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_past_date\\(\\) has parameter \\$field with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_for_past_date\\(\\) has parameter \\$value with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_is_empty\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_is_empty\\(\\) has parameter \\$field with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:should_throw_exception_is_empty\\(\\) has parameter \\$value with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:validate_field\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:validate_field\\(\\) has parameter \\$field with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @return with type mixed is not subtype of native type string\\.$#',
	'identifier' => 'return.phpDocType',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Cart\\\\Cart\\:\\:\\$product_fields \\(WPDesk\\\\Library\\\\CouponInterfaces\\\\ProductFields\\) in empty\\(\\) is not falsy\\.$#',
	'identifier' => 'empty.property',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Cart/Cart.php',
];
$ignoreErrors[] = [
	'message' => '#^Expected 2 @param tags, found 1\\.$#',
	'identifier' => 'paramTag.count',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/Coupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Instanceof between WC_Coupon and WC_Coupon will always evaluate to true\\.$#',
	'identifier' => 'instanceof.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/Coupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\Coupon\\:\\:__construct\\(\\) has parameter \\$settings with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/Coupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\Coupon\\:\\:get_price_from_oder_item\\(\\) should return float but returns string\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/Coupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\Coupon\\:\\:insert\\(\\) has parameter \\$product_fields_values with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/Coupon.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @throws with type WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\Exception is not subtype of Throwable$#',
	'identifier' => 'throws.notThrowable',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/Coupon.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var has invalid value \\(PersistentContainer;\\)\\: Unexpected token ";", expected TOKEN_HORIZONTAL_WS at offset 32 on line 2$#',
	'identifier' => 'phpDoc.parseError',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/Coupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\Coupon\\:\\:\\$settings has no type specified\\.$#',
	'identifier' => 'missingType.property',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/Coupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Expected 3 @param tags, found 1\\.$#',
	'identifier' => 'paramTag.count',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Coupon/CouponCode.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\CouponCode\\:\\:__construct\\(\\) has parameter \\$item with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/CouponCode.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\CouponCode\\:\\:has_own_prefix\\(\\) has parameter \\$product_id with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/CouponCode.php',
];
$ignoreErrors[] = [
	'message' => '#^One or more @param tags has an invalid name or invalid syntax\\.$#',
	'identifier' => 'phpDoc.parseError',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/CouponCode.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$replace of function str_replace expects array\\<string\\>\\|string, int given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Coupon/CouponCode.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method WC_Order_Item\\:\\:get_product_id\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/CouponMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method WC_Order_Item\\:\\:get_variation_id\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/CouponMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Implicit array creation is not allowed \\- variable \\$coupon_data does not exist\\.$#',
	'identifier' => 'variable.implicitArray',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/CouponMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\CouponMeta\\:\\:update\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/CouponMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$price of function wc_price expects float, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/CouponMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$value of method WC_Data\\:\\:update_meta_data\\(\\) expects array\\|string, int given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/CouponMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method WC_Order_Item\\:\\:get_product_id\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method WC_Order_Item\\:\\:get_variation_id\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Callback expects 0 parameters, \\$accepted_args is set to 10\\.$#',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Callback expects 1 parameter, \\$accepted_args is set to 10\\.$#',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Callback expects 1 parameter, \\$accepted_args is set to 2\\.$#',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method get\\(\\) on array\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method get_product_id\\(\\) on WC_Order_Item\\|false\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method get_variation_id\\(\\) on WC_Order_Item\\|false\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Expected 3 @param tags, found 4\\.$#',
	'identifier' => 'paramTag.count',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^If condition is always true\\.$#',
	'identifier' => 'if.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Implicit array creation is not allowed \\- variable \\$coupon_meta does not exist\\.$#',
	'identifier' => 'variable.implicitArray',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:create_coupon\\(\\) has parameter \\$product_fields_values with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:create_coupon\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:create_coupon_for_order_status\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:create_coupon_meta\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:create_coupon_meta\\(\\) has parameter \\$order_id with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:create_coupon_meta\\(\\) has parameter \\$order_item with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:create_coupon_meta\\(\\) has parameter \\$product_fields_values with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:create_item_coupon\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:delete_order_item_postmeta\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:get_success_html\\(\\) has parameter \\$coupons_meta with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:handle_multiple_coupon_mails\\(\\) has parameter \\$product_fields_values with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:handle_multiple_coupon_mails\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:handle_single_coupon_mail\\(\\) has parameter \\$product_fields_values with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:handle_single_coupon_mail\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:should_send_email\\(\\) has parameter \\$meta with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:wp_ajax_generate_coupon\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @param has invalid value \\(bool true                Send by default\\.\\)\\: Unexpected token "true", expected variable at offset 81 on line 4$#',
	'identifier' => 'phpDoc.parseError',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @param references unknown parameter\\: \\$coupon_data$#',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$meta of class WPDesk\\\\Library\\\\WPCoupons\\\\Data\\\\Email\\\\EmailMeta constructor expects array, WPDesk\\\\Library\\\\WPCoupons\\\\Email\\\\FlexibleCouponsBaseEmail given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:\\$product_fields \\(array\\) does not accept WPDesk\\\\Library\\\\CouponInterfaces\\\\ProductFields\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Coupon\\\\GenerateCoupon\\:\\:\\$product_fields type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Unreachable statement \\- code above always terminates\\.$#',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Coupon/GenerateCoupon.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\CouponsIntegration\\:\\:get_shortcodes_definition\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/CouponsIntegration.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\CouponsIntegration\\:\\:set_pro\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/CouponsIntegration.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\CouponsIntegration\\:\\:set_product_fields\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/CouponsIntegration.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\CouponsIntegration\\:\\:\\$forms type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/CouponsIntegration.php',
];
$ignoreErrors[] = [
	'message' => '#^Class WPDesk\\\\Library\\\\WPCoupons\\\\Data\\\\Email\\\\EmailMeta implements generic interface ArrayAccess but does not specify its types\\: TKey, TValue$#',
	'identifier' => 'missingType.generics',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Data/Email/EmailMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Data\\\\Email\\\\EmailMeta\\:\\:__construct\\(\\) has parameter \\$meta with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Data/Email/EmailMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Data\\\\Email\\\\EmailMeta\\:\\:get_coupon_codes\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Data/Email/EmailMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Data\\\\Email\\\\EmailMeta\\:\\:get_coupon_urls\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Data/Email/EmailMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Data\\\\Email\\\\EmailMeta\\:\\:get_coupons_array\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Data/Email/EmailMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Data\\\\Email\\\\EmailMeta\\:\\:get_meta\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Data/Email/EmailMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Data\\\\Email\\\\EmailMeta\\:\\:\\$meta type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Data/Email/EmailMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Email\\\\Email\\:\\:send_mail\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Email/Email.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method addStringAttachment\\(\\) on an unknown class PHPMailer\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Email/FlexibleCouponsBaseEmail.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method get_date_created\\(\\) on bool\\|object\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Email/FlexibleCouponsBaseEmail.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method get_order_number\\(\\) on bool\\|object\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 3,
	'path' => __DIR__ . '/src/Coupons/Email/FlexibleCouponsBaseEmail.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Email\\\\FlexibleCouponsBaseEmail\\:\\:setup_placeholders\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Email/FlexibleCouponsBaseEmail.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$phpmailer of method WPDesk\\\\Library\\\\WPCoupons\\\\Email\\\\FlexibleCouponsBaseEmail\\:\\:add_string_attachments\\(\\) has invalid type PHPMailer\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Email/FlexibleCouponsBaseEmail.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to function in_array\\(\\) requires parameter \\#3 to be set\\.$#',
	'identifier' => 'function.strict',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Helpers/Plugin.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to function in_array\\(\\) requires parameter \\#3 to be set\\.$#',
	'identifier' => 'function.strict',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Assets\\:\\:__construct\\(\\) has parameter \\$shortcodes with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Assets\\:\\:admin_enqueue_scripts\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Assets\\:\\:enqueue_fonts_style\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Assets\\:\\:enqueue_fonts_style\\(\\) has parameter \\$fonts with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Assets\\:\\:get_editor_fonts\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Assets\\:\\:get_font_list\\(\\) has parameter \\$fonts with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Assets\\:\\:get_font_list\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Assets\\:\\:prepare_shortcodes_definition\\(\\) has parameter \\$shortcodes with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Assets\\:\\:prepare_shortcodes_definition\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Assets\\:\\:wp_enqueue_scripts\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$deps of function wp_enqueue_style expects array\\<string\\>, false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Assets\\:\\:\\$shortcodes type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Assets.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method WC_Order_Item\\:\\:get_product_id\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Helper.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method WC_Order_Item\\:\\:get_variation_id\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Helper.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\Helper\\:\\:make_coupon_url\\(\\) has parameter \\$coupon_data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/Helper.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method WC_Order_Item\\:\\:get_product_id\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/MyAccount.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method WC_Order_Item\\:\\:get_variation_id\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Integration/MyAccount.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\MyAccount\\:\\:view_documents\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/MyAccount.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\NullProductFields\\:\\:get\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/NullProductFields.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\PostMeta\\:\\:has\\(\\) has parameter \\$meta_key with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/PostMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\PostMeta\\:\\:has\\(\\) has parameter \\$post_id with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/PostMeta.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\SampleTemplates\\:\\:create\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/SampleTemplates.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\SampleTemplates\\:\\:find_and_replace_shortcodes\\(\\) has parameter \\$template with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/SampleTemplates.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\SampleTemplates\\:\\:find_and_replace_shortcodes\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/SampleTemplates.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\SampleTemplates\\:\\:insert_post\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/SampleTemplates.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\ShortCodeReplacer\\:\\:__construct\\(\\) has parameter \\$shortcode_values with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/ShortCodeReplacer.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\ShortCodeReplacer\\:\\:add_replacement\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/ShortCodeReplacer.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\ShortCodeReplacer\\:\\:get_replacements\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/ShortCodeReplacer.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\ShortCodeReplacer\\:\\:\\$replacements type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/ShortCodeReplacer.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Integration\\\\ShortCodeReplacer\\:\\:\\$shortcode_values type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Integration/ShortCodeReplacer.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\-\\=" between string and float results in an error\\.$#',
	'identifier' => 'assignOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/MakeOrder.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Order\\\\MakeOrder\\:\\:display_coupons_links\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/MakeOrder.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Order\\\\MakeOrder\\:\\:display_coupons_links\\(\\) has parameter \\$item with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/MakeOrder.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Order\\\\MakeOrder\\:\\:display_coupons_links\\(\\) has parameter \\$item_id with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/MakeOrder.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Order\\\\MakeOrder\\:\\:display_coupons_links\\(\\) has parameter \\$order with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/MakeOrder.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Order\\\\MakeOrder\\:\\:order_processed\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/MakeOrder.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Order\\\\MakeOrder\\:\\:order_processed\\(\\) has parameter \\$posted_data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/MakeOrder.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$amount of method WC_Coupon\\:\\:set_amount\\(\\) expects float, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/MakeOrder.php',
];
$ignoreErrors[] = [
	'message' => '#^Action callback returns bool\\|void but should not return anything\\.$#',
	'identifier' => 'return.void',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method WC_Order_Item\\:\\:get_product_id\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method WC_Order_Item\\:\\:get_variation_id\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^Foreach overwrites \\$items with its value variable\\.$#',
	'identifier' => 'foreach.valueOverwrite',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Order\\\\OrderMetaBox\\:\\:get_allowed_screen_ids\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Order\\\\OrderMetaBox\\:\\:get_item_render_data\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Order\\\\OrderMetaBox\\:\\:order_coupon_callback\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Order\\\\OrderMetaBox\\:\\:order_coupon_callback\\(\\) has parameter \\$args with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Order\\\\OrderMetaBox\\:\\:order_coupon_callback\\(\\) has parameter \\$post_or_order_object with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @param references unknown parameter\\: \\$item$#',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @param references unknown parameter\\: \\$post$#',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var has invalid value \\(\\$order WC_Order Order\\.\\)\\: Unexpected token "\\$order", expected type at offset 15 on line 2$#',
	'identifier' => 'phpDoc.parseError',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Order/OrderMetaBox.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Config\\:\\:get\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Config\\:\\:set_font_data\\(\\) has parameter \\$value with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Config\\:\\:set_font_dir\\(\\) has parameter \\$value with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Config\\:\\:\\$config type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Callback expects 0 parameters, \\$accepted_args is set to 2\\.$#',
	'identifier' => 'arguments.count',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/PDF/Download.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Download\\:\\:get_pdf_content\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Download.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Download\\:\\:get_pdf_content\\(\\) has parameter \\$request with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Download.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Download\\:\\:wp_ajax_download_pdf\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Download.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\FontsData\\:\\:set_font\\(\\) has parameter \\$attr with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/FontsData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\FontsData\\:\\:set_font_without_bold\\(\\) has parameter \\$attr with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/FontsData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\FontsData\\:\\:set_font_without_bold_italic\\(\\) has parameter \\$attr with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/FontsData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\FontsData\\:\\:set_font_without_italic\\(\\) has parameter \\$attr with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/FontsData.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\FontsData\\:\\:\\$fonts_data \\(array\\<array\\<string\\>\\>\\) does not accept default value of type array\\<string, array\\<string, int\\|string\\>\\>\\.$#',
	'identifier' => 'property.defaultValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/FontsData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Items\\:\\:__construct\\(\\) has parameter \\$objects with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Items.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Items\\:\\:default_object_data\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Items.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Items\\:\\:get_image_html\\(\\) has parameter \\$object with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Items.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Items\\:\\:get_text_html\\(\\) has parameter \\$object with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Items.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\Items\\:\\:\\$objects type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/Items.php',
];
$ignoreErrors[] = [
	'message' => '#^Iterating over an object of an unknown class WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\Shortcodes\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDF\\:\\:__construct\\(\\) has parameter \\$shortcodes with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDF\\:\\:debug_before_render_pdf\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDF\\:\\:get_order_item_meta\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDF\\:\\:match_shortcode_values\\(\\) has parameter \\$product_fields_values with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDF\\:\\:match_shortcode_values\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDF\\:\\:prepare_template_data\\(\\) has parameter \\$product_fields_values with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDF\\:\\:prepare_template_data\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var has invalid value \\(EditorIntegration;\\)\\: Unexpected token ";", expected TOKEN_HORIZONTAL_WS at offset 30 on line 2$#',
	'identifier' => 'phpDoc.parseError',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDF\\:\\:\\$editor has no type specified\\.$#',
	'identifier' => 'missingType.property',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDF\\:\\:\\$shortcodes \\(WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\Shortcodes\\) does not accept array\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDF\\:\\:\\$shortcodes has unknown class WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\Shortcodes as its type\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDF.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDFWrapper\\:\\:get_config\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDFWrapper.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDFWrapper\\:\\:get_fonts_data\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDFWrapper.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDFWrapper\\:\\:get_fonts_dir\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDFWrapper.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PDF\\\\PDFWrapper\\:\\:set_editor_data\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDFWrapper.php',
];
$ignoreErrors[] = [
	'message' => '#^One or more @param tags has an invalid name or invalid syntax\\.$#',
	'identifier' => 'phpDoc.parseError',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PDF/PDFWrapper.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PluginAccess\\:\\:__construct\\(\\) has parameter \\$shortcodes with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PluginAccess.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\PluginAccess\\:\\:get_shortcodes\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PluginAccess.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\PluginAccess\\:\\:\\$shortcodes type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/PluginAccess.php',
];
$ignoreErrors[] = [
	'message' => '#^Action callback returns array but should not return anything\\.$#',
	'identifier' => 'return.void',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method is_premium\\(\\) on array\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 3,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Implicit array creation is not allowed \\- variable \\$new_tabs might not exist\\.$#',
	'identifier' => 'variable.implicitArray',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductEditPage\\:\\:add_product_general_data_field\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductEditPage\\:\\:add_product_tab_action\\(\\) has parameter \\$tabs with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductEditPage\\:\\:add_product_tab_action\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductEditPage\\:\\:add_product_type_filter\\(\\) has parameter \\$types with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductEditPage\\:\\:add_product_type_filter\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductEditPage\\:\\:get_coupons_templates_options\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductEditPage\\:\\:update_product_type\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$args of function get_posts expects array\\{numberposts\\?\\: int, category\\?\\: int\\|string, include\\?\\: array\\<int\\>, exclude\\?\\: array\\<int\\>, suppress_filters\\?\\: bool, attachment_id\\?\\: int, author\\?\\: int\\|string, author_name\\?\\: string, \\.\\.\\.\\}\\|null, array\\{post_type\\: string, post_status\\: \'publish\', posts_per_page\\: \'\\-1\'\\} given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductEditPage\\:\\:\\$product_fields \\(array\\) does not accept WPDesk\\\\Library\\\\CouponInterfaces\\\\ProductFields\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductEditPage\\:\\:\\$product_fields type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$new_tabs might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method is_premium\\(\\) on array\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 5,
	'path' => __DIR__ . '/src/Coupons/Product/ProductVariationEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductVariationEditPage\\:\\:add_product_general_data_field\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductVariationEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductVariationEditPage\\:\\:add_product_general_data_field\\(\\) has parameter \\$loop with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductVariationEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductVariationEditPage\\:\\:add_product_general_data_field\\(\\) has parameter \\$variation with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductVariationEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductVariationEditPage\\:\\:add_product_general_data_field\\(\\) has parameter \\$variation_data with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductVariationEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductVariationEditPage\\:\\:get_coupons_templates_options\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductVariationEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$args of function get_posts expects array\\{numberposts\\?\\: int, category\\?\\: int\\|string, include\\?\\: array\\<int\\>, exclude\\?\\: array\\<int\\>, suppress_filters\\?\\: bool, attachment_id\\?\\: int, author\\?\\: int\\|string, author_name\\?\\: string, \\.\\.\\.\\}\\|null, array\\{post_type\\: string, post_status\\: \'publish\', posts_per_page\\: \'\\-1\'\\} given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductVariationEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductVariationEditPage\\:\\:\\$product_fields \\(array\\) does not accept WPDesk\\\\Library\\\\CouponInterfaces\\\\ProductFields\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductVariationEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\ProductVariationEditPage\\:\\:\\$product_fields type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/ProductVariationEditPage.php',
];
$ignoreErrors[] = [
	'message' => '#^Callback expects 1 parameter, \\$accepted_args is set to 2\\.$#',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductSimpleData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductSimpleData\\:\\:save_premium_fields\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductSimpleData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductSimpleData\\:\\:save_product_coupons_field\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductSimpleData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductSimpleData\\:\\:save_public_fields\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductSimpleData.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$default of method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductSimpleData\\:\\:post_data\\(\\) expects null, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductSimpleData.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$default of method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductSimpleData\\:\\:post_data\\(\\) expects null, int given\\.$#',
	'identifier' => 'argument.type',
	'count' => 3,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductSimpleData.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$default of method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductSimpleData\\:\\:post_data\\(\\) expects null, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 8,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductSimpleData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductVariationData\\:\\:save_premium_fields\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductVariationData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductVariationData\\:\\:save_premium_fields\\(\\) has parameter \\$i with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductVariationData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductVariationData\\:\\:save_product_coupons_field\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductVariationData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductVariationData\\:\\:save_product_coupons_field\\(\\) has parameter \\$i with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductVariationData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductVariationData\\:\\:save_product_coupons_field\\(\\) has parameter \\$variation_id with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductVariationData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductVariationData\\:\\:save_public_fields\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductVariationData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductVariationData\\:\\:save_public_fields\\(\\) has parameter \\$i with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductVariationData.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$default of method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductVariationData\\:\\:post_data\\(\\) expects null, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductVariationData.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$default of method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductVariationData\\:\\:post_data\\(\\) expects null, int given\\.$#',
	'identifier' => 'argument.type',
	'count' => 3,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductVariationData.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$default of method WPDesk\\\\Library\\\\WPCoupons\\\\Product\\\\SaveProductVariationData\\:\\:post_data\\(\\) expects null, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 10,
	'path' => __DIR__ . '/src/Coupons/Product/SaveProductVariationData.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Fields\\\\DisableFieldProAdapter\\:\\:get_field\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Fields/DisableFieldProAdapter.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Fields\\\\DisableFieldProAdapter\\:\\:\\$field \\(WPDesk\\\\Forms\\\\Field\\\\BasicField\\) does not accept WPDesk\\\\Forms\\\\Field\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Fields/DisableFieldProAdapter.php',
];
$ignoreErrors[] = [
	'message' => '#^@param WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Resolver \\$resolvers does not accept actual type of parameter\\: array\\{WPDesk\\\\View\\\\Resolver\\\\DirResolver, WPDesk\\\\Forms\\\\Resolver\\\\DefaultFormFieldResolver\\}\\.$#',
	'identifier' => 'parameter.phpDocType',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/SettingsForm.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\SettingsTab\\:\\:output_render\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/SettingsForm.php',
];
$ignoreErrors[] = [
	'message' => '#^Dynamic call to static method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\SettingsTab\\:\\:get_tab_slug\\(\\)\\.$#',
	'identifier' => 'staticMethod.dynamicCall',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/SettingsForm.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\SettingsForm\\:\\:enqueue_scripts\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/SettingsForm.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\SettingsForm\\:\\:save_tab_data\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/SettingsForm.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\SettingsForm\\:\\:save_tab_data\\(\\) has parameter \\$post_data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/SettingsForm.php',
];
$ignoreErrors[] = [
	'message' => '#^One or more @param tags has an invalid name or invalid syntax\\.$#',
	'identifier' => 'phpDoc.parseError',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Settings/SettingsForm.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @param has invalid value \\(array \\$this\\-\\>tabs \\.\\)\\: Unexpected token "\\$this", expected variable at offset 57 on line 4$#',
	'identifier' => 'phpDoc.parseError',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/SettingsForm.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\SettingsForm\\:\\:\\$renderer has no type specified\\.$#',
	'identifier' => 'missingType.property',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/SettingsForm.php',
];
$ignoreErrors[] = [
	'message' => '#^Class WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Fields\\\\DisableFieldProAdapter constructor invoked with 3 parameters, 2 required\\.$#',
	'identifier' => 'arguments.count',
	'count' => 6,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/CouponSettings.php',
];
$ignoreErrors[] = [
	'message' => '#^Dynamic call to static method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\CouponSettings\\:\\:get_tab_slug\\(\\)\\.$#',
	'identifier' => 'staticMethod.dynamicCall',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/CouponSettings.php',
];
$ignoreErrors[] = [
	'message' => '#^Dynamic call to static method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\EmailSettings\\:\\:get_tab_slug\\(\\)\\.$#',
	'identifier' => 'staticMethod.dynamicCall',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/EmailSettings.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\FieldSettingsTab\\:\\:get_data\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/FieldSettingsTab.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\FieldSettingsTab\\:\\:handle_request\\(\\) has parameter \\$request with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/FieldSettingsTab.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\FieldSettingsTab\\:\\:set_data\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/FieldSettingsTab.php',
];
$ignoreErrors[] = [
	'message' => '#^Return type \\(array\\|null\\) of method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\FieldSettingsTab\\:\\:get_data\\(\\) should be covariant with return type \\(array\\) of method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\SettingsTab\\:\\:get_data\\(\\)$#',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/FieldSettingsTab.php',
];
$ignoreErrors[] = [
	'message' => '#^Dynamic call to static method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\MainSettings\\:\\:get_tab_slug\\(\\)\\.$#',
	'identifier' => 'staticMethod.dynamicCall',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/MainSettings.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\MainSettings\\:\\:get_wc_order_statuses\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/MainSettings.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\MainSettings\\:\\:\\$renderer has no type specified\\.$#',
	'identifier' => 'missingType.property',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/MainSettings.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\SettingsTab\\:\\:get_data\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/SettingsTab.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\SettingsTab\\:\\:handle_request\\(\\) has parameter \\$request with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/SettingsTab.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\SettingsTab\\:\\:is_active\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/SettingsTab.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Tabs\\\\SettingsTab\\:\\:set_data\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Tabs/SettingsTab.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$color might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/allow-url-fopen-status.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$status might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/allow-url-fopen-status.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to function in_array\\(\\) requires parameter \\#3 to be set\\.$#',
	'identifier' => 'function.strict',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to function is_string\\(\\) with non\\-falsy\\-string will always evaluate to true\\.$#',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method get_attributes\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method get_classes\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method get_id\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method get_name\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method get_placeholder\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method get_sublabel\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method get_type\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 6,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method has_classes\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method has_placeholder\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method has_sublabel\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method is_disabled\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method is_readonly\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method is_required\\(\\) on an unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Implicit array creation is not allowed \\- variable \\$input_values might not exist\\.$#',
	'identifier' => 'variable.implicitArray',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var for variable \\$field contains unknown class Field\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Result of \\|\\| is always true\\.$#',
	'identifier' => 'booleanOr.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/input-email-multiple.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$base_url might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/menu.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$menu_items might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/menu.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$selected might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Settings/Views/menu.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\CouponCode\\:\\:definition\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/CouponCode.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\CouponValue\\:\\:definition\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/CouponValue.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$price of function wc_price expects float, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/CouponValue.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\ShortcodeDataContainer\\:\\:get_product_fields_values\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/ShortcodeDataContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\ShortcodeDataContainer\\:\\:set_coupon_code\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/ShortcodeDataContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\ShortcodeDataContainer\\:\\:set_item\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/ShortcodeDataContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\ShortcodeDataContainer\\:\\:set_order\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/ShortcodeDataContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\ShortcodeDataContainer\\:\\:set_product\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/ShortcodeDataContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\ShortcodeDataContainer\\:\\:set_product_fields_values\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/ShortcodeDataContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Method WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\ShortcodeDataContainer\\:\\:set_product_fields_values\\(\\) has parameter \\$product_fields_values with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/ShortcodeDataContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @param references unknown parameter\\: \\$order$#',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/ShortcodeDataContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Property WPDesk\\\\Library\\\\WPCoupons\\\\Shortcodes\\\\ShortcodeDataContainer\\:\\:\\$product_field_values type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Shortcodes/ShortcodeDataContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$color might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/allow-url-fopen-status.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$status might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/allow-url-fopen-status.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method get_fallback\\(\\) on an unknown class WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Settings\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/fields/coupon-code-length.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var for variable \\$settings contains unknown class WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Settings\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/fields/coupon-code-length.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method get_fallback\\(\\) on an unknown class WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Settings\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/fields/coupon-code-suffix.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var for variable \\$settings contains unknown class WPDesk\\\\Library\\\\WPCoupons\\\\Settings\\\\Settings\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/fields/coupon-code-suffix.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var for variable \\$meta contains unknown class PostMeta\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/fields/delay-type.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$params in isset\\(\\) always exists and is not nullable\\.$#',
	'identifier' => 'isset.variable',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/fields/delay-type.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$text of function esc_attr expects string, int given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/fields/include-categories.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$coupon_code might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/html-order-coupon-generated.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$coupon_url might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/html-order-coupon-generated.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$download_url might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/html-order-coupon-generated.php',
];
$ignoreErrors[] = [
	'message' => '#^Function esc_html invoked with 2 parameters, 1 required\\.$#',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/html-pdf.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method output_render\\(\\) on an unknown class Renderer\\.$#',
	'identifier' => 'class.notFound',
	'count' => 19,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/html-product-general-settings.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var for variable \\$renderer contains unknown class Renderer\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/html-product-general-settings.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var for variable \\$renderer contains unknown class Renderer\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/src/Coupons/Views/dashboard/variation/html-product-variation-settings.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
