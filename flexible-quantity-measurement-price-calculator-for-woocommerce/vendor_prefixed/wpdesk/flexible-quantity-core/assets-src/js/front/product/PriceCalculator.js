export default class PriceCalculator {
    calculatorSelector = '#wc-variation-price-calculator';

    calculatorInputSelector = '#price_calculator input';

    pricePlaceholderSelector = 'span.product_price';

    currentVariationSelector = 'input[type="hidden"][name^="variation_id"]';

    totalAmmountSelector = '.wc-measurement-price-calculator-total-amount';

	measurementNeededSelector = 'input[type="hidden"][name^="_measurement_needed"]';

	measurementNeededUnitSelector = 'input[type="hidden"][name^="_measurement_needed_unit"]';

    init() {
        jQuery(document.body).on('init_calculator', () =>
            this.calculatePrice()
        );
        jQuery(document.body).on('woocommerce_variation_has_changed', () =>
            this.getCalculatorForm()
        );
        jQuery(document.body).on('found_variation', () =>
            this.getCalculatorForm()
        );
        jQuery(document.body).on('reset_data', () =>
            this.clearCalculatorForm()
        );

        jQuery(document.body).on(
            'input',
            this.calculatorInputSelector,
            this.debounce(() => {
                this.calculatePrice();
            }, 250)
        );

        if (fq_price_calculator_params.product_type === 'simple') {
            jQuery(document.body).trigger('init_calculator');
        }
    }

    calculatePrice() {
        const variationId = jQuery(this.currentVariationSelector).val();
        const formData = jQuery('#price_calculator').find('input').serialize();
        const $pricePlaceholder = jQuery(this.pricePlaceholderSelector);
        const $measurementPlaceholder = jQuery(this.totalAmmountSelector);
		const $measurementNeeded = jQuery(this.measurementNeededSelector);
		const $measurementNeededUnit = jQuery(this.measurementNeededUnitSelector);

        jQuery.ajax({
            type: 'POST',
            url: fq_price_calculator_params.ajax_url,
            data: {
                action: 'price_calculation',
                action: 'price_calculation',
                product_id:
                    variationId || fq_price_calculator_params.product_id,
                form_data: formData,
                nonce: fq_price_calculator_params.nonce,
            },
            success: (response) => {
                if (response.success === true) {
                    $pricePlaceholder.html(response.data.price_html);
                    $measurementPlaceholder.html(response.data.measurement_needed);
					$measurementNeeded.val(response.data.measurement_needed);
					$measurementNeededUnit.val(response.data.measurement_needed_unit);
                    // Backward compatibility (not needed internally)
                    $pricePlaceholder.trigger(
                        'wc-measurement-price-calculator-total-price-change'
                    );
                } else {
                    $pricePlaceholder.html('');
                    $measurementPlaceholder.html('');
                    console.error(
                        'Price calculation ajax error',
                        response.data
                    );
                }
            },
            error: (xhr, status, error) => {
                console.error('Price calculation ajax error', error);
            },
        });
    }

    getCalculatorForm() {
        const variationId = jQuery(this.currentVariationSelector).val();
        if (!variationId) {
            return;
        }

        const $priceCalculator = jQuery(this.calculatorSelector);
        const variationData = jQuery('select[name^="attribute"]').serialize();

        $priceCalculator.html('');

        jQuery.ajax({
            type: 'POST',
            url: fq_price_calculator_params.ajax_url,
            data: {
                action: 'calculator_form',
                variation_id: variationId,
                variation_data: variationData,
                nonce: fq_price_calculator_params.nonce,
            },
            success: (response) => {
                if (response.success === true) {
                    $priceCalculator.html(response.data);

                    jQuery(document.body).trigger('init_calculator');
                } else {
                    console.error('Calculator form ajax error', response.data);
                }
            },
            error: (xhr, status, error) => {
                console.error('Calculator form ajax error', error);
            },
        });
    }

    clearCalculatorForm() {
        const $priceCalculator = jQuery(this.calculatorSelector);
        $priceCalculator.html('');
    }

    debounce(func, wait) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }
}
