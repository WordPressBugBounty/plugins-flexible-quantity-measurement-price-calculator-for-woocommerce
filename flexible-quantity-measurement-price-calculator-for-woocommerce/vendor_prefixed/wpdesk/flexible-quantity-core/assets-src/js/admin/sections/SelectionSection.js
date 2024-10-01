export default class SelectionSection {
    $selectionCategoryField = jQuery('#fq_selection_category');

    $selectionField = jQuery('#fq_selections');

    init() {
        this.initSelect2();
        // attach events
        this.$selectionCategoryField.on('change', () =>
            this.templateCategorySelected()
        );
        // trigger initial events
        this.$selectionCategoryField.trigger('change');
    }

    initSelect2() {
        this.$selectionCategoryField.select2({
            placeholder: wp.i18n.__(
                'Template category',
                'flexible-quantity-core'
            ),
            minimumResultsForSearch: Infinity, // hide search box
        });
        this.$selectionField.select2({
            minimumInputLength: 0,
            placeholder: '',
            allowClear: true,
            ajax: {
                url: fq_admin_params.ajax_url,
                dataType: 'json',
                delay: 300,
                data: (params) => ({
                    category: this.$selectionCategoryField.val(),
                    action: fq_admin_params.action_get_options,
                    nonce: fq_admin_params.selection_nonce,
                    search: params.term, // search term
                    page: params.page || 1, // pagination page
                }),
                processResults: (result, params) => {
                    params.page = params.page || 1;
                    return {
                        results: result.data.options,
                        pagination: result.data.pagination,
                    };
                },
                cache: true,
            },
        });
    }

    loadSelected(selectedCategory) {
        // This method is now responsible for preselecting options only
        jQuery.ajax({
            type: 'POST',
            url: fq_admin_params.ajax_url,
            dataType: 'json',
            delay: 250,
            data: {
                category: selectedCategory,
                action: fq_admin_params.action_get_selected,
                template_id: fq_admin_params.template_id,
                pre_select_product_id: this.$selectionField.data(
                    'pre-select-product-id'
                ),
                nonce: fq_admin_params.selection_nonce,
            },
            success: (response) => {
                if (response.success === true) {
                    // Clear existing options
                    this.$selectionField.empty();

                    // Append new options based on the response
                    response.data.forEach((option) => {
                        const opt = new Option(
                            option.text,
                            option.id,
                            true,
                            true
                        );
                        this.$selectionField.append(opt).trigger('change');
                    });
                } else {
                    console.error('Error fetching options', response.data);
                }
            },
            error: (xhr, status, error) => {
                console.error('Error fetching options', error);
            },
        });
    }

    templateCategorySelected() {
        const selectedCategory = this.$selectionCategoryField.val();
        selectedCategory
            ? this.loadSelected(selectedCategory)
            : this.$selectionField.empty();
    }
}
