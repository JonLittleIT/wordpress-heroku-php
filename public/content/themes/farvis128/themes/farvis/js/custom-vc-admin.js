
jQuery(function($){
	"use strict";

	window.VcPixContainerView = window.VcTabView.extend({
		events: {
			"click > .vc_controls .vc_control-btn-delete": "deleteShortcode",
			"click > .vc_controls .vc_control-btn-prepend": "addElement",
			"click > .vc_controls .vc_control-btn-edit": "editElement",
			"click > .vc_controls .vc_control-btn-clone": "clone",
			"click > .wpb_element_wrapper > .vc_empty-container": "addToEmpty"
		}, deleteShortcode: function (e) {
			var parent, parent_id = this.model.get("parent_id");
			_.isObject(e) && e.preventDefault();
			var answer = confirm(window.i18nLocale.press_ok_to_delete_section);
			return !0 !== answer ? !1 : (this.model.destroy(), void(parent_id && !vc.shortcodes.where({parent_id: parent_id}).length ? (parent = vc.shortcodes.get(parent_id), _.contains(["vc_column", "vc_column_inner"], parent.get("shortcode")) || parent.destroy()) : parent_id && (parent = vc.shortcodes.get(parent_id), parent && parent.view && parent.view.setActiveLayoutButton && parent.view.setActiveLayoutButton())))
		}
	})

	window.VcPixTabView = window.VcColumnView.extend({
		events: {
			"click > .vc_controls .vc_control-btn-delete": "deleteShortcode",
			"click > .vc_controls .vc_control-btn-prepend": "addElement",
			"click > .vc_controls .vc_control-btn-edit": "editElement",
			"click > .vc_controls .vc_control-btn-clone": "clone",
			"click > .wpb_element_wrapper > .vc_empty-container": "addToEmpty"
		}, render: function () {
			var params = this.model.get("params");
			return window.VcPixTabView.__super__.render.call(this), params.tab_id || (params.tab_id = Date.now() + "-" + Math.floor(11 * Math.random()), this.model.save("params", params)), this.id = "tab-" + params.tab_id, this.$el.attr("id", this.id), this
		}, ready: function (e) {
			window.VcPixTabView.__super__.ready.call(this, e), this.$tabs = this.$el.closest(".wpb_tabs_holder");
			this.model.get("params");
			return this
		}, cloneModel: function (model, parent_id, save_order) {
			var new_order, model_clone, params, tag;
			return new_order = _.isBoolean(save_order) && !0 === save_order ? model.get("order") : parseFloat(model.get("order")) + vc.clone_index, params = _.extend({}, model.get("params")), tag = model.get("shortcode"), "vc_tab" === tag && _.extend(params, {tab_id: Date.now() + "-" + this.$tabs.find("[data-element_type=vc_tab]").length + "-" + Math.floor(11 * Math.random())}), model_clone = Shortcodes.create({
				shortcode: tag,
				parent_id: parent_id,
				order: new_order,
				cloned: !0,
				cloned_from: model.toJSON(),
				params: params
			}), _.each(Shortcodes.where({parent_id: model.id}), function (shortcode) {
				this.cloneModel(shortcode, model_clone.get("id"), !0)
			}, this), model_clone
		}
	})

});



