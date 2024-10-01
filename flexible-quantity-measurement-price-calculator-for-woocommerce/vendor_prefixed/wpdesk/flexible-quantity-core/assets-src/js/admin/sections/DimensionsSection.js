export default class DimensionsSection {
    $unitLabelField = jQuery('#fq_label');

    $unitField = jQuery('#fq_unit');

    $enabler = jQuery('#fq_decimals_enabled');

    $section = jQuery('#fq-decimals-panel');

    typeSelector = '.fq_field_type_selector'; // fixed value or user input

    $selectionField = jQuery('#fq_selections');

    init() {
        // attach events
        this.$unitField.on('change', () => this.toggle());
        this.$enabler.on('click', () => this.toggle());

        jQuery(document).on('change', this.typeSelector, (e) =>
            this.changeDimensionInputType(e.currentTarget)
        );
        // trigger initial events
        this.$unitField.trigger('change');
    }

    loadDimensionFields() {
        this.$section.html(fq_admin_params.loader_img);
        const templateId =
            this.$selectionField.data('pre-select-product-id') ||
            fq_admin_params.template_id;

        jQuery.ajax({
            type: 'POST',
            cache: false,
            url: fq_admin_params.ajax_url,
            data: {
                action: fq_admin_params.action_get_dimensions,
                template_id: templateId,
                unit: this.$unitField.val(),
                nonce: fq_admin_params.dimensions_nonce,
            },
            success: (response) => {
                if (response.success === true) {
                    this.$section.html(response.data.content);
                    this.initDimensionFields();
                    this.$section
                        .find('.tips, .help_tip, .woocommerce-help-tip')
                        .tipTip({
                            attribute: 'data-tip',
                            fadeIn: 50,
                            fadeOut: 50,
                            delay: 200,
                            keepAlive: true,
                        });
                } else {
                    console.error(
                        'Error loading dimension table',
                        response.data
                    );
                }
            },
            error: (xhr, status, error) => {
                console.error('Error loading dimension table.', error);
            },
        });
    }

    toggle() {
        if (this.isEnabled()) {
            this.$section.show();
            this.$unitLabelField.attr('disabled', 'disabled');
            this.loadDimensionFields();
        } else {
            this.$section.hide();
            this.$unitLabelField.removeAttr('disabled');
        }
    }

    initDimensionFields() {
        jQuery(document)
            .find(this.typeSelector)
            .each((index, field) => {
                this.changeDimensionInputType(field);
            });
    }

    changeDimensionInputType(field) {
        const $field = jQuery(field);
        const optionType = $field.val();
        const $fieldType = $field.closest('.fq-field-type');

        $fieldType.find('.decimals-fields-with-labels').addClass('hidden');
        $fieldType.find(`.${optionType}-fields`).removeClass('hidden');
    }

    isEnabled() {
        return this.$enabler.is(':checked');
    }
}
