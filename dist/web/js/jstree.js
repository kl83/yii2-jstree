function kl83InitJsTree ( $, options ) {
    var rootEl = $('#'+options.id);
    var form = rootEl.closest('form');
    var jstreeEl = rootEl.find('.jstree');
    var hiddenWrapper = rootEl.find('.hidden-wrapper');
    var selectedEl = rootEl.find('.selected-items');

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
        var text = '';
        for ( var i in nodes ) {
            text += nodes[i].text + ", ";
        }
        selectedEl.text(text.replace(/,\s$/, ''));
    };

    /**
     * Update hidden inputs
     * @returns null
     */
    var updateHiddenItems = function () {
        var nodes = jstree.get_checked();
        if ( options.multiple ) {
            hiddenWrapper.html('');
            for ( var i in nodes ) {
                hiddenWrapper.append('<input type="hidden" name="'+options.inputName+'[]" value="'+nodes[i]+'">');
            }
        } else {
            if ( nodes.length ) {
                rootEl.find('[type="hidden"]').val(nodes[0]);
            } else {
                rootEl.find('[type="hidden"]').val('');
            }
        }
    };

    // Initialize widget
    var jstree = jstreeEl
        .on('ready.jstree', function(){
            if ( options.multiple ) {
                hiddenWrapper.find('input').each(function(){
                    var nodeId = $(this).val();
                    jstree.check_node(nodeId);
                    jstree._open_to(nodeId);
                });
            } else {
                var nodeId = rootEl.find('[type="hidden"]').val();
                jstree.check_node(nodeId);
                jstree._open_to(nodeId);
            }
            if ( options.popup ) {
                updateSelectedText();
            }
        })
        .on('changed.jstree', function(){
            updateHiddenItems();
            if ( options.popup ) {
                updateSelectedText();
            }
        })
        .jstree(options.jstree).jstree();
}
