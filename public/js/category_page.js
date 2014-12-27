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
								'core' : {
									'data' : data.result,
									'check_callback' : true
								},
								'types' : {
									'default' : {
										'icon' : false
									}
								},
								'plugins' : [ 'types', 'contextmenu', 'dnd', 'unique' ]
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

				post_data.node_action = 'create_node';
				post_data.node_data = {
					'node' : data.node,
					'parent' : data.parent,
					'position' : data.position
				};

				$.post(post_urls.category_edit, post_data);
			})

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
			})

			// Node action - delete_node
			$category_tree.on('delete_node.jstree', function (e, data){
				var post_data = default_post_data;

				post_data.node_action = 'delete_node';
				post_data.node_data = {
					'node' : data.node,
					'parent' : data.parent
				};

				$.post(post_urls.category_edit, post_data);
			})

			// Node action - move_node
			$category_tree.on('move_node.jstree', function (e, data){
				var post_data = default_post_data;

				post_data.node_action = 'move_node';
				post_data.node_data = {
					'node' : data.node,
					'parent' : data.parent,
					'position' : data.position,
					'old_parent' : data.old_parent,
					'old_position' : data.old_position,
					'is_multi' : data.is_multi
				};

				$.post(post_urls.category_edit, post_data);
			})

			// Node action - copy_node
			$category_tree.on('copy_node.jstree', function (e, data){
				var post_data = default_post_data;

				post_data.node_action = 'copy_node';
				post_data.node_data = {
					'node' : data.node,
					'original' : data.original,
					'parent' : data.parent,
					'position' : data.position,
					'old_parent' : data.old_parent,
					'old_position' : data.old_position,
					'is_multi' : data.is_multi
				};

				$.post(post_urls.category_edit, post_data);
			})

			// Node action - cut
			$category_tree.on('cut.jstree', function (e, data){
				var post_data = default_post_data;

				post_data.node_action = 'cut';
				post_data.node_data = {
					'node' : data.node
				};

				$.post(post_urls.category_edit, post_data);
			})

			// Node action - copy
			$category_tree.on('copy.jstree', function (e, data){
				var post_data = default_post_data;

				post_data.node_action = 'copy';
				post_data.node_data = {
					'node' : data.node
				};

				$.post(post_urls.category_edit, post_data);
			})

			// Node action - paste
			$category_tree.on('paste.jstree', function (e, data){
				var post_data = default_post_data;

				post_data.node_action = 'paste';
				post_data.node_data = {
					'node' : data.node,
					'parent' : data.parent,
					'mode' : data.mode
				};

				$.post(post_urls.category_edit, post_data);
			});
		}		
	}
	
	init_category_tree('expense');
	init_category_tree('income');
});