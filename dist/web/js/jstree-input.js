function kl83InitJsTreeInput ( $, options ) {
    var rootEl = $('#'+options.id);
    var hiddenInput = rootEl.find('[type="hidden"]');

    if ( options.selectOnlyLeaf ) {
        options.jstree.plugins.push('conditionalselect');
        options.jstree.conditionalselect = function ( node ) {
            return jstree.is_leaf(node);
        };
    }

    /**
     * Update list of selected elements
     * @returns null
     */
    var updateSelectedText = function () {
        var nodes = jstree.get_selected(true);
        if ( nodes.length ) {
            rootEl.find('.selected-items').removeClass('empty');
            var text = '';
            for ( var i in nodes ) {
                text += nodes[i].text + ", ";
            }
            rootEl.find('.selected-items .items-text').text(text.replace(/,\s$/, ''));
        } else {
            rootEl.find('.selected-items').addClass('empty');
            rootEl.find('.selected-items .items-text').text('');
        }
    };

    /**
     * Update hidden input
     * @returns null
     */
    var updateHiddenInput = function () {
        var nodes = jstree.get_checked();
        if ( nodes.length ) {
            if ( options.multiple ) {
                hiddenInput.val(JSON.stringify(nodes));
            } else {
                hiddenInput.val(nodes[0]);
            }
        } else {
            hiddenInput.val('');
        }
    };

    // Initialize widget
    var jstree = rootEl.find('.jstree')
        .on('ready.jstree', function(){
            if ( hiddenInput.val() ) {
                if ( options.multiple ) {
                    var value = JSON.parse(hiddenInput.val());
                } else {
                    value = [ hiddenInput.val() ];
                }
                for ( var i in value ) {
                    jstree.check_node(value[i]);
                    jstree._open_to(value[i]);
                }
            }
            if ( options.popup ) {
                updateSelectedText();
            }
        })
        .on('changed.jstree', function(){
            updateHiddenInput();
            if ( options.popup ) {
                updateSelectedText();
            }
        })
        .jstree(options.jstree).jstree();
}
