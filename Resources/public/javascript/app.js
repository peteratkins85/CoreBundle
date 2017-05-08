// (function ($, undefined) {
//     "use strict";
//     $.jstree.defaults.conditionalselect = function () { return true; };
//     $.jstree.plugins.conditionalselect = function (options, parent) {
//         this.activate_node = function (obj, e) {
//             if(this.settings.conditionalselect.call(this, this.get_node(obj))) {
//                 parent.activate_node.call(this, obj, e);
//             }
//         };
//     };
// })(jQuery);
// $("#tree").jstree({
//     "conditionalselect" : function (node) {
//         return node.text === "Root node" ? false : true;
//     },
//     "plugins" : ["conditionalselect"]
// });


var ONI_APP = Class.create();

ONI_APP.prototype = {
    env: null,
    devMode: false,
    ui: {
        initEvents: function () {
            $(document).on('click', '.oni-delete-action', function (e) {
                var url = $(this).attr('delete-url');
                var msg = $(this).attr('delete-msg');
                var modal = $($(this).attr('href'));

                if (url && msg) {
                    modal.find('.modal-body').html(msg);
                    modal.find('.oni-action-btn').attr('href', url);
                }
            });
        }
    },
    initialize: function () {
        if ($("input[data-oni-environment]").length) {
            this.env = $("input[data-oni-environment]").val();

            if (this.env == 'dev') {
                this.devMode = true;
            }
        } else {
            throw "oni-environment element not set, environment cannot be deciphered";
        }

        this.ui.initEvents();

    },
};


var ONI = new ONI_APP();


