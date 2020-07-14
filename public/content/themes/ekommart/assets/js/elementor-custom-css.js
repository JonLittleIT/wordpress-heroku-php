(function () {
	'use strict';
	var addPageCustomCss = function () {
		var customCSS = elementor.settings.page.model.get('custom_css');

		if (customCSS) {
			customCSS = customCSS.replace(/selector/g, '.elementor-page-' + elementor.config.document.id);
			elementor.settings.page.controlsCSS.elements.$stylesheetElement.append(customCSS);
		}
	};

	var addCustomCss = function (css, view) {
		var model = view.getEditModel(),
			customCSS = model.get('settings').get('custom_css');

		if (customCSS) {
			css += customCSS.replace(/selector/g, '.elementor-element.elementor-element-' + view.model.id);
		}

		return css;
	};

	elementor.hooks.addFilter('editor/style/styleText', addCustomCss);
	elementor.settings.page.model.on('change', addPageCustomCss);
	elementor.on('preview:loaded', addPageCustomCss);

})();
