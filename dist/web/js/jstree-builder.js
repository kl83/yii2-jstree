var kl83InitJsTreeBuilder;
(function($){

    /**
     * Checks node id existance
     * @param {type} id
     * @param {type} nodes
     * @returns {Boolean}
     */
    var checkId = function ( id, nodes ) {
        for ( var i in nodes ) {
            if ( nodes[i].id === id.toString() ) {
                return true;
            }
        }
        return false;
    };

    /**
     * Returns the id for new node
     * @param {type} jsTree
     * @returns {Number}
     */
    var getNewId = function ( jsTree ) {
        var nodes = jsTree.get_json('#', { flat: true });
        if ( nodes ) {
            var i = 1;
            while ( checkId(i, nodes) ) {
                i++;
            }
            return i;
        } else {
            return 1;
        }
    }

    /**
     * Creates node
     * @param {type} jsTree
     * @param {type} prmpt
     * @param {type} text
     * @returns {null}
     */
    var addNode = function ( jsTree, prmpt, text ) {
        var parentNode = jsTree.get_selected(true)[0];
        var parentId = parentNode ? parentNode.id : '#';
        var text = prompt(prmpt, text);
        if ( text ) {
            jsTree._open_to(jsTree.create_node(parentId, { id: getNewId(jsTree), text: text }));
        }
    };

    /**
     * Renames node
     * @param {type} jsTree
     * @param {type} prmpt
     * @returns {null}
     */
    var renameNode = function ( jsTree, prmpt ) {
        var node = jsTree.get_selected(true)[0];
        if ( node ) {
            var newText = prompt(prmpt, node.text);
            if ( newText ) {
                jsTree.rename_node(node, newText);
            }
        }
    };

    /**
     * Removes node
     * @param {type} jsTree
     * @returns null
     */
    var removeNode = function ( jsTree ) {
        var nodes = jsTree.get_selected();
        if ( nodes.length ) {
            jsTree.delete_node(nodes);
        }
    };

    /**
     * Update input with json-data
     * @param {type} jsTree
     * @param {type} input
     * @returns {undefined}
     */
    var updateValue = function ( jsTree, input ) {
        var nodes = jsTree.get_json('#', {
            no_state: true,
            no_li_attr: true,
            no_a_attr: true
        });
        input.val(JSON.stringify(nodes));
    };

    /**
     * Update node data from form
     * @param {type} jsTree
     * @param {type} nodeId
     * @param {type} formSelector
     * @returns {undefined}
     */
    var readNodeData = function ( jsTree, nodeId, formSelector ) {
        var node = jsTree.get_node(nodeId);
        if ( typeof node.data !== 'object' || node.data.length !== undefined ) {
            node.data = {};
        }
        $(formSelector + ' input').each(function(){
            if ( $(this).prop('type') === 'checkbox' ) {
                node.data[$(this).prop('name')] = $(this).prop('checked');
            } else {
                node.data[$(this).prop('name')] = $(this).val();
            }
        });
        $(formSelector + ' select').each(function(){
            node.data[$(this).prop('name')] = $(this).val();
        });
    };

    /**
     * Update form from node data
     * @param {type} jsTree
     * @param {type} nodeId
     * @param {type} formSelector
     * @returns {undefined}
     */
    var fillForm = function ( jsTree, nodeId, formSelector ) {
        clearForm(formSelector);
        var node = jsTree.get_node(nodeId);
        for ( var i in node.data ) {
            var el = $(formSelector + ' [name="'+i+'"]');
            if ( el.prop('type') === 'checkbox' ) {
                el.prop('checked', node.data[i]);
            } else {
                el.val(node.data[i]);
            }
        }
    };

    /**
     * Clear form
     * @param {type} formSelector
     * @returns {undefined}
     */
    var clearForm = function ( formSelector ) {
        $(formSelector + ' input').each(function(){
            if ( $(this).prop('type') === 'checkbox' ) {
                $(this).prop('checked', false);
            } else {
                $(this).val('');
            }
        });
        $(formSelector + ' option:selected').prop('selected', false);
    };

    /**
     * Initializes the widget
     * @param {type} options
     * @returns {undefined}
     */
    kl83InitJsTreeBuilder = function ( options ) {

        var rootEl = $('#'+options.id);
        var form = rootEl.closest('form');
        var hiddenInput = rootEl.find('[type="hidden"]');
        var jsTreeEl = rootEl.find('.jstree');

        options.jstree = {
            plugins: [ 'dnd', 'changed' ],
            core: {
                check_callback: true,
                data: hiddenInput.val() ? JSON.parse(hiddenInput.val()) : []
            }
        };

        $(document).on('dnd_stop.vakata', function(){
            updateValue(jstree, hiddenInput);
        });

        // Initialize JsTree
        if ( options.linkForm ) {
            $(options.linkForm).addClass('kl83-jstree-builder-form');
            jsTreeEl.on('changed.jstree', function ( e, data ) {
                if ( data.changed.deselected.length === 1 ) {
                    readNodeData ( jstree, data.changed.deselected[0], options.linkForm ) ;
                    updateValue(jstree, hiddenInput);
                }
                if ( data.changed.selected.length === 1 ) {
                    $(options.linkForm).addClass('kl83-enabled');
                    fillForm ( jstree, data.changed.selected[0], options.linkForm ) ;
                } else {
                    $(options.linkForm).removeClass('kl83-enabled');
                    clearForm ( options.linkForm ) ;
                }
            });
            form.submit(function(){
                var node = jstree.get_selected();
                if ( node.length === 1 ) {
                    readNodeData ( jstree, node[0], options.linkForm ) ;
                    updateValue(jstree, hiddenInput);
                }
            });
        }
        var jstree = jsTreeEl
            .on('dblclick', function(){
                renameNode(jstree, options.renamePrompt);
                updateValue(jstree, hiddenInput);
            })
            .jstree(options.jstree).jstree(true);

        rootEl.find('button.add-node').click(function(){
            addNode(jstree, options.addPrompt, options.addText);
            updateValue(jstree, hiddenInput);
        });

        rootEl.find('button.rename-node').click(function(){
            renameNode(jstree, options.renamePrompt);
            updateValue(jstree, hiddenInput);
        });

        rootEl.find('button.remove-node').click(function(){
            removeNode(jstree);
            updateValue(jstree, hiddenInput);
        });
    };
})(jQuery);
