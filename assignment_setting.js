/**
 * This module is called in lib.php/get_form_elements_module()
 */

M.plagiarism_programming = M.plagiarism_programming || {};

M.plagiarism_programming.assignment_setting = {

    submit_date_num : 0,
    Y : null,

    init : function (Y, jplag_support, moss_support) {
        this.Y = Y;
        this.init_mandatory_field();
        this.init_disable_unsupported_tool(Y, jplag_support, moss_support);
        this.enable_disable_elements(Y, jplag_support, moss_support);
    },

    init_mandatory_field : function () {
        var Y = this.Y;
        var required_img = Y.one('.req');

        // Put the required class for the select and checkboxes.
        // The problem with the mform require rule is that they fail validation
        // even when not enabled.
        var config_block = Y.one('#programming_header');
        if (!config_block) {
            config_block = Y.one('#id_programming_header');
        }

        // Add delete buttons for each activatable scan date.
        var enabled_chk = config_block.all('[name*=scan_date\\[][name*=calendar');
        enabled_chk._nodes.forEach(function (item, index) {
            var deleteIcon = document.createElement('a');
            deleteIcon.innerHTML = ('<a class="d-inline-block col-form-label availability-delete p-x-1" href="" title="Delete" role="button">'
                    + '<img src="' + M.util.image_url('t/delete', 'core') + '" alt="Delete"></a>');
            item.parentNode.appendChild(deleteIcon);

            deleteIcon.onclick = function(e) {
                e.preventDefault();
                var node = this;
                // Iterate over all Nodes until the whole row is selected, then delete it.
                while (node.parentNode) {
                    if (node.parentNode.firstElementChild.id == "fgroup_id_similarity_checking") {
                        node.parentNode.removeChild(node);
                        break;
                    }
                    node = node.parentNode;
                }
            };
        });

        var skipClientValidation = false;

        Y.one('[id^=mform1]').on('submit', function (e) {
            if (skipClientValidation) {
                return;
            }
            var is_tool_selected = this.check_mandatory_form_field(Y);

            var is_date_valid = this.check_submit_date(Y);
            if (!is_tool_selected || !is_date_valid) {
                e.preventDefault();
            }
        }, this);

        // Do not need to validate when clicking no submit button.
        var new_date_button = config_block.one('input[name=add_new_date]');
        new_date_button.on('click', function (e) {
            skipClientValidation = true;
        });

        var add_date = Y.one('input[name=is_add_date]');
        if (add_date && add_date.getAttribute('value') == 1) {
            window.scrollTo(0, new_date_button.getY() - 150);
        }
    },

    /**
     * Check whether at least one tool is selected.
     *
     * @return true or false
     */
    check_mandatory_form_field : function (Y) {
        if (this.is_plugin_enabled()) {
            var config_block = Y.one('#programming_header');
            if (!config_block) {
                config_block = Y.one('#id_programming_header');
            }
            var selected_tool = config_block.one('input[name*=detection_tools]:checked');
            if (selected_tool == null) {
                // Whether exist an error message or not?
                var tool_checkbox = config_block.one('input[name*=detection_tools]');
                M.plagiarism_programming.assignment_setting.display_error_message(
                    Y,
                    tool_checkbox,
                    M.str.plagiarism_programming.no_tool_selected_error)
                return false;
            }
        }
        return true;
    },

    /**
     * Check to make sure all submit dates are not before the current date
     *
     * @return true or false
     */
    check_submit_date : function (Y) {
        if (!this.is_plugin_enabled()) { // Do not check if plugin is not enabled.
            return true;
        }
        var config_block = Y.one('#programming_header');
        if (!config_block) {
            config_block = Y.one('#id_programming_header');
        }

        var all_valid = true;
        var current_date = new Date();

        var count_date_time_pickers = config_block.all('[id^=fitem_id_scan_date]')._nodes.length;
        var count_finished_scan_dates = config_block.all('[id^=fitem_id_scan_date_finished]')._nodes.length;

        for (var i = count_finished_scan_dates; i < count_date_time_pickers; i++) {
            var enabled = config_block._node.elements.namedItem("scan_date\[" + i + "\]\[enabled\]").checked;
            if (enabled) {
                var day = config_block._node.elements.namedItem("scan_date\[" + i + "\]\[day\]").value;
                var hour = config_block._node.elements.namedItem("scan_date\[" + i + "\]\[hour\]").value;
                var minute = config_block._node.elements.namedItem("scan_date\[" + i + "\]\[minute\]").value;
                var month = config_block._node.elements.namedItem("scan_date\[" + i + "\]\[month\]").value;
                var year = config_block._node.elements.namedItem("scan_date\[" + i + "\]\[year\]").value;

                // Javascript starts counting in January with 0.
                var date = new Date(year, month - 1, day, hour, minute);

                if (date < current_date) {
                    M.plagiarism_programming.assignment_setting.display_error_message(
                        Y,
                        config_block.one('[id^=fitem_id_scan_date_'), // First elements of the unfinished scan dates.
                        M.str.plagiarism_programming.invalid_submit_date_error);
                    all_valid = false;
                }
            }
        }

        return all_valid;
    },

    display_error_message : function (Y, node, error_msg) {
        window.scrollTo(0, node.getY() - 100);
        alert("Plagiarism Plugin: At least one date is older than today's date. Please disable it or change the date.");

        /* TODO: Fieldset does not work because dataset is used differently now

         while (node!=null && node.get('tagName')!='FIELDSET') {
             node = node.get('parentNode');
         }
         if (node!=null && node.get('tagName')=='FIELDSET' && node.all('.error').isEmpty()) {
             // Insert the message.
             var msg_node = Y.Node.create('<span class="error">'+error_msg+'<br></span>');
             node.get('children').item(0).insert(msg_node,'before');
             window.scrollTo(0, msg_node.getY()-40);
         }
         */
    },

    init_disable_unsupported_tool : function (Y, jplag_lang, moss_lang) {
        Y.all('input[name=programmingYN]').on('click', function () {
            this.enable_disable_elements(Y, jplag_lang, moss_lang);
        }, this);
        Y.one('select[name=programming_language]').on('change', function () {
            this.enable_disable_elements(Y, jplag_lang, moss_lang);
        }, this);
    },

    enable_disable_elements : function (Y, jplag_lang, moss_lang) {
        var config_block = this.Y.one('#programming_header');
        if (!config_block) {
            config_block = this.Y.one('#id_programming_header');
        }
        if (!this.is_plugin_enabled()) {
            // Disable both MOSS and JPlag.
            config_block.all('input[name*=detection_tools]').set('disabled',
                    true);
        } else { // Disable each one of them.
            var value = Y.one('select[name=programming_language]').get('value');
            var jplag_disabled = true;
            var moss_disabled = true;
            if (jplag_lang && jplag_lang[value]) {
                jplag_disabled = false;
            }
            if (moss_lang && moss_lang[value]) {
                moss_disabled = false;
            }
            Y.one('input[type=checkbox][name=detection_tools\\[jplag\\]]').set('disabled', jplag_disabled);
            Y.one('input[type=checkbox][name=detection_tools\\[moss\\]]').set('disabled', moss_disabled);
        }
    },

    /**
     * Is at least one tool enabled?
     * @return true if at least one among jplag and moss is checked
     **/
    is_plugin_enabled : function () {
        var config_block = this.Y.one('#programming_header');
        if (!config_block) {
            config_block = this.Y.one('#id_programming_header');
        }
        return config_block.one('input[name=programmingYN]:checked').get('value') == '1';
    }
}
