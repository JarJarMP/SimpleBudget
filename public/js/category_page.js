$(function () { 
	function init_category_tree(category_type){
		var $category_tree = $('#' + category_type + '_tree');
		var default_post_data = {'expense_or_income' : category_type};

		if ($category_tree.length) {
			
			// Page load - init both trees
			$.post(
				post_urls.categories,
				default_post_data,
				function (data) {
					$category_tree.empty();

					if (typeof(data.result) != 'undefined' && typeof(data.result_msg) != 'undefined') {
						if (data.result != false) {
							$category_tree.jstree({ 
								'plugins' : [ 'types', 'contextmenu', 'dnd', 'unique' ],
								'core' : {
									'data' : data.result,
									'check_callback' : function (operation, node, node_parent, node_position, more) {
										// Prevent moving node from one tree to the other
										if (typeof(more) != 'undefined' && more && more.dnd && more.is_multi) { 
											return false;
										}

										// Confirm before delete
										if (operation == 'delete_node') {
											var delete_msg = 'Do you want to delete the "' + node.text + '" category?';
											if (!confirm(delete_msg)) {
												return false;
											}
										}
									}
								},
								'types' : {
									'default' : {
										'icon' : false
									}
								},
								'contextmenu' : {
									'items' : function (node) {
										var current_tree = $category_tree.jstree(true);
										return {
											'Create': {
												'label': 'Create',
												'action': function (obj) {
													node = current_tree.create_node(node);
													current_tree.edit(node);
												}
											},
											'Rename': {
												'label': 'Rename',
												'action': function (obj) {
													current_tree.edit(node);
												}
											},
											'Delete': {
												'label': 'Delete',
												'action': function (obj) {
													current_tree.delete_node(node);
												}
											}
										};
									}
								}
							});

						} else {
							$category_tree.html(data.result_msg);
						}
					} else {
						$category_tree.html('AJAX request failed!');
					}
				},
				'json'
			);

			// Node action - create_node
			$category_tree.on('create_node.jstree', function (e, data){
				var post_data = default_post_data;
				var $current_node = data.node;

				post_data.node_action = 'create_node';
				post_data.node_data = {
					'node' : data.node,
					'parent' : data.parent,
					'position' : data.position
				};

				$.post(post_urls.category_edit, post_data, function (data) {
					$category_tree.jstree(true).set_id($current_node, data.result.new_id);
				});
			});

			// Node action - rename_node
			$category_tree.on('rename_node.jstree', function (e, data){
				var post_data = default_post_data;

				post_data.node_action = 'rename_node';
				post_data.node_data = {
					'node' : data.node,
					'text' : data.text,
					'old' : data.old
				};

				$.post(post_urls.category_edit, post_data);
			});

			// Node action - delete_node
			$category_tree.on('delete_node.jstree', function (e, data){
				var post_data = default_post_data;

				post_data.node_action = 'delete_node';
				post_data.node_data = {
					'node' : data.node,
					'parent' : data.parent
				};

				$.post(post_urls.category_edit, post_data);
			});

			// Node action - move_node
			$category_tree.on('move_node.jstree', function (e, data){
				var post_data = default_post_data;

				post_data.node_action = 'move_node';
				post_data.node_data = {
					//'node' : data.node // dark magic... don't use the whole node object.. if you find the bug, I'll buy you a beer/chocolate
					'node_id' : data.node.id,
					'parent' : data.parent,
					'position' : data.position
				};

				$.post(post_urls.category_edit, post_data);
			});
		}
	}
	
	init_category_tree('expense');
	init_category_tree('income');
});