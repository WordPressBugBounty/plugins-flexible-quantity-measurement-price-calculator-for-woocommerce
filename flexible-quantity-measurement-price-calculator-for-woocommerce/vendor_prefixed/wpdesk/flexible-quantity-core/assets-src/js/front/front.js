import PriceCalculator from './product/PriceCalculator';

jQuery(() => {
    /* global fq_price_calculator_params */
    if (typeof fq_price_calculator_params === 'undefined') {
		return false;
	}

	const priceCalculator = new PriceCalculator();

	priceCalculator.init();
});
