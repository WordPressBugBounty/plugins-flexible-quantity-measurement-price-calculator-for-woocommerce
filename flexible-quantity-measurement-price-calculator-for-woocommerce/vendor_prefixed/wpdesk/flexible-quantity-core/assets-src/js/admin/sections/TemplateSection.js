export default class TemplateSection {
    $productData = jQuery('#measurement_product_data');

    $pricingTable = jQuery('.fcm-pricing-table');

    $pricingTableEnabler = jQuery('.show_table_pricing');

    $shippingTable = jQuery('.fcm-shipping-table');

    $shippingTableEnabler = jQuery('.show_table_shipping');

    insertSelector = 'td.actions a.insert';

    removeSelector = 'td.actions a.remove';

    init() {
        this.$pricingTableEnabler.on('change', () =>
            this.toggle(this.$pricingTableEnabler, this.$pricingTable)
        );
        this.$shippingTableEnabler.on('change', () =>
            this.toggle(this.$shippingTableEnabler, this.$shippingTable)
        );

        this.$productData.on('click', this.insertSelector, (e) =>
            this.insert(e.currentTarget)
        );
        this.$productData.on('click', this.removeSelector, (e) =>
            this.remove(e.currentTarget)
        );

        this.$pricingTableEnabler.trigger('change');
        this.$shippingTableEnabler.trigger('change');

        this.initHelpTips();
    }

    toggle($enabler, $element) {
        $enabler.is(':checked') ? $element.show() : $element.hide();
    }

    insert(button) {
        const $tr = jQuery(button).closest('tr').clone();
        jQuery(button).closest('tr').after(`<tr>${$tr.html()}</tr>`);

        return false;
    }

    remove(button) {
        jQuery(button).closest('tr').remove();

        return false;
    }

    initHelpTips() {
        jQuery(document).find('.woocommerce-help-tip').tipTip({
            attribute: 'data-tip',
            fadeIn: 50,
            fadeOut: 50,
            delay: 200,
            keepAlive: true,
        });
    }
}
