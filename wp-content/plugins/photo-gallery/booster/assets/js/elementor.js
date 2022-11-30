/* Adding button in Elementor edit panel navigation view */
function twb_add_elementor_button() {
  window.elementor.modules.layouts.panel.pages.menu.Menu.addItem({
    name: twb.title,
    icon: "twb-element-menu-icon",
    title: twb.title,
    type: "page",
    callback: () => {
      try {
        window.$e.route("panel/page-settings/twb_optimize")
      } catch (e) {
        window.$e.route("panel/page-settings/settings"), window.$e.route("panel/page-settings/twb_optimize")
      }
    }
  }, "more")
}

jQuery(window).on("elementor:init", () => {
  window.elementor.on("panel:init", () => {
    setTimeout(twb_add_elementor_button)
  })
});
