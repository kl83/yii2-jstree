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

    // Update list of selected elements
    var updateSelectedText = function () {
        var nodes = jstree.get_selected(true);
        var text = '';
        for ( var i in nodes ) {
            text += nodes[i].text + ", ";
        }
        selectedEl.text(text.replace(/,\s$/, ''));
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
            if ( options.popup ) {
                updateSelectedText();
            }
        })
        .jstree(options.jstree).jstree();

    // Appends the hidden inputs to the form befor her will be sent
    form.bind('beforeSubmit', function(){
        if ( options.multiple ) {
            hiddenWrapper.html('');
            var nodes = jstree.get_checked();
            for ( var i in nodes ) {
                hiddenWrapper.append('<input type="hidden" name="'+options.inputName+'[]" value="'+nodes[i]+'">');
            }
        } else {
            var nodes = jstree.get_checked();
            if ( nodes.length ) {
                rootEl.find('[type="hidden"]').val(nodes[0]);
            } else {
                rootEl.find('[type="hidden"]').val('');
            }
        }
    });
}
