<?php

/*
* Function for post duplication. Duplicator Duplicator Duplicator 

*/
function rd_duplicate_post_as_draft()
{
	global $wpdb;
	if (!(isset($_GET['post']) || isset($_POST['post']) || (isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action']))) {
		wp_die('No post to duplicate has been supplied!');
	}

	/*
	* Nonce verification
	*/
	if (!isset($_GET['duplicate_nonce']) || !wp_verify_nonce($_GET['duplicate_nonce'], basename(__FILE__)))
		return;

	/*
	* get the original post id
	*/
	$post_id = (isset($_GET['post']) ? absint($_GET['post']) : absint($_POST['post']));
	/*
	* and all the original post data then
	*/
	$post = get_post($post_id);

	/*
	* if you don't want current user to be the new post author,
	* then change next couple of lines to this: $new_post_author = $post->post_author;
	*/
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;

	/*
	* if post data exists, create the post duplicate
	*/
	if (isset($post) && $post != null) {

		/*
	* new post data array
	*/
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status' => $post->ping_status,
			'post_author' => $new_post_author,
			'post_content' => $post->post_content,
			'post_excerpt' => $post->post_excerpt,
			'post_name' => $post->post_name,
			'post_parent' => $post->post_parent,
			'post_password' => $post->post_password,
			'post_status' => 'draft',
			'post_title' => $post->post_title,
			'post_type' => $post->post_type,
			'to_ping' => $post->to_ping,
			'menu_order' => $post->menu_order
		);

		/*
	* insert the post by wp_insert_post() function
	*/
		$new_post_id = wp_insert_post($args);

		/*
	* get all current post terms ad set them to the new post draft
	*/
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}

		/*
	* duplicate all post meta just in two SQL queries
	*/
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos) != 0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if ($meta_key == '_wp_old_slug') continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query .= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}

		/*
	* finally, redirect to the edit post screen for the new draft
	*/
		wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action('admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft');

/*
	* Add the duplicate link to action list for post_row_actions
	*/
function rd_duplicate_post_link($actions, $post)
{
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce') . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}

add_filter('post_row_actions', 'rd_duplicate_post_link', 10, 2);

add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);

//==============================================================================================================

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('style.min', get_template_directory_uri() . '/assets/css/style.min.css');
	wp_enqueue_style('styles', get_template_directory_uri() . '/assets/css/style.css');

	wp_enqueue_script('app.min', get_template_directory_uri() . '/assets/js/app.min.js', array(), '1.0.0', true);
});

add_theme_support('post-thumbnails');


register_nav_menus([
	'header_menu' => 'Top menu',
	'footer_menu' => 'Footer menu'
]);



/**************************** image size ***********************/

// add_image_size('avatar', 243, 243, false);
// add_image_size('work-skrin', 246, 180, true);


## Отключает Гутенберг (новый редактор блоков в WordPress).
## ver: 1.2
if ('disable_gutenberg') {
	remove_theme_support('core-block-patterns'); // WP 5.5

	add_filter('use_block_editor_for_post_type', '__return_false', 100);

	// отключим подключение базовых css стилей для блоков
	// ВАЖНО! когда выйдут виджеты на блоках или что-то еще, эту строку нужно будет комментировать
	remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');

	// Move the Privacy Policy help notice back under the title field.
	add_action('admin_init', function () {
		remove_action('admin_notices', ['WP_Privacy_Policy_Content', 'notice']);
		add_action('edit_form_after_title', ['WP_Privacy_Policy_Content', 'notice']);
	});
}


function do_excerpt($string, $word_limit)
{
	$words = explode(' ', $string, ($word_limit + 1));
	if (count($words) > $word_limit)
		array_pop($words);
	echo implode(' ', $words) . ' ...';
}



// ACF Pro Options Page

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	));
}
function my_pagenavi()
{
	global $wp_query;

	$big = 999999999; // уникальное число для замены

	$args = array(
		'base' => get_pagenum_link(1) . '%_%',
		'format' => '/page/%#%',
		'current' => max(1, get_query_var('paged')),
		'total'   => $wp_query->max_num_pages,
		'prev_text'    => __('« prev'),
		'next_text'    => __('next »'),
	);

	$result = paginate_links($args);

	// удаляем добавку к пагинации для первой страницы
	$result = preg_replace('~/page/1/?([\'"])~', '', $result);

	echo $result;
}
