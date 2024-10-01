import '../../scss/admin.scss';

import SelectionSection from './sections/SelectionSection';
import DimensionsSection from './sections/DimensionsSection';
import TemplateSection from './sections/TemplateSection';

jQuery(() => {
	/* global fq_admin_params */
    if (typeof fq_admin_params === 'undefined') {
		return false;
    }

    const selectionSection = new SelectionSection();
    const dimensionsSection = new DimensionsSection();
    const templateSection = new TemplateSection();

    selectionSection.init();
    dimensionsSection.init();
    templateSection.init();
});
