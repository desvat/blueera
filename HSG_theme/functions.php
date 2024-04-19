<?php
class customheaderMetabox
{
	private $screen = array(
		'post',
		'page',
		'blogs',
		'projects',
	);
	private $meta_fields = array(
		array(
			'label' => 'Add Image Header',
			'id' => 'addimageheader',
			'type' => 'media',
		),
	);
	public function __construct()
	{
		add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
		add_action('admin_footer', array($this, 'media_fields'));
		add_action('save_post', array($this, 'save_fields'));
	}
	public function add_meta_boxes()
	{
		foreach ($this->screen as $single_screen) {
			add_meta_box(
				'customheader',
				__('Custom Header', 'textdomain'),
				array($this, 'meta_box_callback'),
				$single_screen,
				'advanced',
				'default'
			);
		}
	}
	public function meta_box_callback($post)
	{
		wp_nonce_field('customheader_data', 'customheader_nonce');
		echo 'Allow you to add custom header in every page';
		$this->field_generator($post);
	}
	public function media_fields()
	{
		?>
		<script>
			jQuery(document).ready(function ($) {
				if (typeof wp.media !== 'undefined') {
					var _custom_media = true,
						_orig_send_attachment = wp.media.editor.send.attachment;
					$('.customheader-media').click(function (e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
						wp.media.editor.send.attachment = function (props, attachment) {
							if (_custom_media) {
								$('input#' + id).val(attachment.url);
							} else {
								return _orig_send_attachment.apply(this, [props, attachment]);
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function () {
						_custom_media = false;
					});
				}
			});
		</script>
		<?php
	}
	public function field_generator($post)
	{
		$output = '';
		foreach ($this->meta_fields as $meta_field) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta($post->ID, $meta_field['id'], true);
			if (empty($meta_value)) {
				$meta_value = $meta_field['default'];
			}
			switch ($meta_field['type']) {
				case 'media':
					$input = sprintf(
						'<input style="width: 80%%" id="%s" name="%s" type="text" value="%s"> <input style="width: 19%%" class="button customheader-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value,
						$meta_field['id'],
						$meta_field['id']
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows($label, $input);
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows($label, $input)
	{
		return '<tr><th>' . $label . '</th><td>' . $input . '</td></tr>';
	}
	public function save_fields($post_id)
	{
		if (!isset($_POST['customheader_nonce']))
			return $post_id;
		$nonce = $_POST['customheader_nonce'];
		if (!wp_verify_nonce($nonce, 'customheader_data'))
			return $post_id;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
		foreach ($this->meta_fields as $meta_field) {
			if (isset($_POST[$meta_field['id']])) {
				switch ($meta_field['type']) {
					case 'email':
						$_POST[$meta_field['id']] = sanitize_email($_POST[$meta_field['id']]);
						break;
					case 'text':
						$_POST[$meta_field['id']] = sanitize_text_field($_POST[$meta_field['id']]);
						break;
				}
				update_post_meta($post_id, $meta_field['id'], $_POST[$meta_field['id']]);
			} else if ($meta_field['type'] === 'checkbox') {
				update_post_meta($post_id, $meta_field['id'], '0');
			}
		}
	}
}
if (class_exists('customheaderMetabox')) {
	new customheaderMetabox;
}

// add hook
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2);

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu($sorted_menu_items, $args)
{
	if (isset($args->sub_menu)) {
		$root_id = 0;

		// find the current menu item
		foreach ($sorted_menu_items as $menu_item) {
			if ($menu_item->current) {
				// set the root id based on whether the current menu item has a parent or not
				$root_id = ($menu_item->menu_item_parent) ? $menu_item->menu_item_parent : $menu_item->ID;
				break;
			}
		}

		// find the top level parent
		if (!isset($args->direct_parent)) {
			$prev_root_id = $root_id;
			while ($prev_root_id != 0) {
				foreach ($sorted_menu_items as $menu_item) {
					if ($menu_item->ID == $prev_root_id) {
						$prev_root_id = $menu_item->menu_item_parent;
						// don't set the root_id to 0 if we've reached the top of the menu
						if ($prev_root_id != 0)
							$root_id = $menu_item->menu_item_parent;
						break;
					}
				}
			}
		}

		$menu_item_parents = array();
		foreach ($sorted_menu_items as $key => $item) {
			// init menu_item_parents
			if ($item->ID == $root_id)
				$menu_item_parents[] = $item->ID;

			if (in_array($item->menu_item_parent, $menu_item_parents)) {
				// part of sub-tree: keep!
				$menu_item_parents[] = $item->ID;
			} else if (!(isset($args->show_parent) && in_array($item->ID, $menu_item_parents))) {
				// not part of sub-tree: away with it!
				unset($sorted_menu_items[$key]);
			}
		}

		return $sorted_menu_items;
	} else {
		return $sorted_menu_items;
	}
}

// Removes from admin menu
add_action('admin_menu', 'my_remove_admin_menus');
function my_remove_admin_menus()
{
	remove_menu_page('edit-comments.php');
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support()
{
	remove_post_type_support('post', 'comments');
	remove_post_type_support('page', 'comments');
}
// Removes from admin bar
function mytheme_admin_bar_render()
{
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');

add_theme_support('post-thumbnails');

function create_posttype_blogs()
{

	$supports = ['title', 'editor', 'thumbnail'];

	register_post_type(
		'blogs',
		array(
			'labels' => array(
				'name' => __('Blogy', 'hsg'),
				'singular_name' => __('Blogs', 'hsg')
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'blogs'),
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-book',
			'supports' => $supports, // Apply supports
		)
	);
}
add_action('init', 'create_posttype_blogs');

function create_posttype_projects()
{

	register_post_type(
		'projects',
		array(
			'labels' => array(
				'name' => __('Projekty', 'hsg'),
				'singular_name' => __('Projects', 'hsg')
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'projects'),
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-welcome-add-page',
		)
	);
}
add_action('init', 'create_posttype_projects');

/**
 *  Zobrazi ID v adminovi
 */
function add_column($columns)
{
	$columns['post_id_clmn'] = 'ID';
	return $columns;
}
add_filter('manage_posts_columns', 'add_column', 5);

function column_content($column, $id)
{
	if ($column === 'post_id_clmn')
		echo "<div class=\"aaa\">" . $id . "</div>";
}
add_action('manage_posts_custom_column', 'column_content', 5, 2);

function navaron_menus()
{

	$locations = array(
		'main-menu' => __('Hlavné menu', 'hsg'),
		'products-menu' => __('Produktové menu', 'hsg'),
		'footer-menu' => __('Footer Menu', 'hsg'),
		'social-menu' => __('Sociálne siete', 'hsg')
	);

	register_nav_menus($locations);
}
add_action('init', 'navaron_menus');

/**
 * breadcrumbs menu
 * <div class="breadcrumb"><?php get_breadcrumb(); ?></div>
 */
function get_breadcrumb()
{
	echo '<a href="' . home_url() . '" rel="nofollow">Úvod</a>';
	if (is_category() || is_single()) {
		echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;a";
		the_category(' &bull; ');
		if (is_single()) {
			echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;b ";
			the_title();
		}
	} elseif (is_page()) {
		echo "<img src=\"/wp-content/themes/HSG/assets/images/breadcrumb-arrow.svg\" alt=\"\" />";

		echo "<span class=\"title\">";
		echo the_title();
		echo "</span>";
	}
	// elseif (is_search()) {
	//     echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
	//     echo '"<em>';
	//     echo the_search_query();
	//     echo '</em>"';
	// }
}

/**
 * Custom admin menu and styles
 */
function my_admin_menu()
{
	add_menu_page(
		__('Sample page', 'my-textdomain'),
		__('Theme Settings', 'my-textdomain'),
		'manage_options',
		'sample-page',
		'my_admin_page_contents',
		plugins_url('../themes/demo-theme/assets/images/theme-menu-icon.png'),
		1
	);
}
add_action('admin_menu', 'my_admin_menu');

function my_admin_page_contents()
{
	require_once get_template_directory() . '/admin/test.php';
}

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function wpdocs_enqueue_custom_admin_js()
{
	wp_register_script('custom_wp_admin_css', get_template_directory_uri() . '/admin/js/main.js', false, rand());
	wp_enqueue_script('custom_wp_admin_css');
}
add_action('admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_js');

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function wpdocs_enqueue_custom_admin_style()
{
	wp_register_style('custom_wp_admin_css', get_template_directory_uri() . '/admin/admin-style.css', false, rand());
	wp_enqueue_style('custom_wp_admin_css');
}
add_action('admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style');

/**
 * Theme functions
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Theme options
 */
require_once get_template_directory() . '/inc/theme-options.php';

/**
 * Page options
 */
require_once get_template_directory() . '/inc/page-options.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';
?>