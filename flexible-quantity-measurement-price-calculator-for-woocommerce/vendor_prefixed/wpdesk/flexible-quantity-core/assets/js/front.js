(()=>{"use strict";class e{calculatorSelector="#wc-variation-price-calculator";calculatorInputSelector="#price_calculator input";pricePlaceholderSelector="span.product_price";currentVariationSelector='input[type="hidden"][name^="variation_id"]';totalAmmountSelector=".wc-measurement-price-calculator-total-amount";measurementNeededSelector='input[type="hidden"][name^="_measurement_needed"]';measurementNeededUnitSelector='input[type="hidden"][name^="_measurement_needed_unit"]';init(){jQuery(document.body).on("init_calculator",(()=>this.calculatePrice())),jQuery(document.body).on("woocommerce_variation_has_changed",(()=>this.getCalculatorForm())),jQuery(document.body).on("found_variation",(()=>this.getCalculatorForm())),jQuery(document.body).on("reset_data",(()=>this.clearCalculatorForm())),jQuery(document.body).on("input",this.calculatorInputSelector,this.debounce((()=>{this.calculatePrice()}),250)),"simple"===fq_price_calculator_params.product_type&&jQuery(document.body).trigger("init_calculator")}calculatePrice(){const e=jQuery(this.currentVariationSelector).val(),r=jQuery("#price_calculator").find("input").serialize(),a=jQuery(this.pricePlaceholderSelector),t=jQuery(this.totalAmmountSelector),c=jQuery(this.measurementNeededSelector),o=jQuery(this.measurementNeededUnitSelector);jQuery.ajax({type:"POST",url:fq_price_calculator_params.ajax_url,data:{action:"price_calculation",action:"price_calculation",product_id:e||fq_price_calculator_params.product_id,form_data:r,nonce:fq_price_calculator_params.nonce},success:e=>{!0===e.success?(a.html(e.data.price_html),t.html(e.data.measurement_needed),c.val(e.data.measurement_needed),o.val(e.data.measurement_needed_unit),a.trigger("wc-measurement-price-calculator-total-price-change")):(a.html(""),t.html(""),console.error("Price calculation ajax error",e.data))},error:(e,r,a)=>{console.error("Price calculation ajax error",a)}})}getCalculatorForm(){const e=jQuery(this.currentVariationSelector).val();if(!e)return;const r=jQuery(this.calculatorSelector),a=jQuery('select[name^="attribute"]').serialize();r.html(""),jQuery.ajax({type:"POST",url:fq_price_calculator_params.ajax_url,data:{action:"calculator_form",variation_id:e,variation_data:a,nonce:fq_price_calculator_params.nonce},success:e=>{!0===e.success?(r.html(e.data),jQuery(document.body).trigger("init_calculator")):console.error("Calculator form ajax error",e.data)},error:(e,r,a)=>{console.error("Calculator form ajax error",a)}})}clearCalculatorForm(){jQuery(this.calculatorSelector).html("")}debounce(e,r){let a;return function(...t){clearTimeout(a),a=setTimeout((()=>e.apply(this,t)),r)}}}jQuery((()=>{if("undefined"==typeof fq_price_calculator_params)return!1;(new e).init()}))})();