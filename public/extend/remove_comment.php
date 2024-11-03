<?php

if ( ! class_exists( 'Dq_delete_all_comments' ) ) {
	add_action( 'init', array( 'Dq_delete_all_comments', 'get_object' ) );

	class Dq_delete_all_comments {

		private static $classobj;

		private static $comment_pages = array(
			'comment.php',
			'edit-comments.php',
			'moderation.php',
			'options-discussion.php',
		);

		public function __construct() {
			add_filter( 'site_transient_update_plugins', array( $this, 'remove_update_nag' ) );
			add_filter( 'the_posts', array( $this, 'set_comment_status' ) );
			add_filter( 'comments_open', array( $this, 'close_comments' ), 20, 2 );
			add_filter( 'pings_open', array( $this, 'close_comments' ), 20, 2 );
			add_action( 'admin_init', array( $this, 'remove_comments' ) );
			add_action( 'admin_menu', array( $this, 'remove_menu_items' ) );
			add_filter( 'add_menu_classes', array( $this, 'add_menu_classes' ) );
			add_action( 'admin_footer-index.php', array( $this, 'remove_dashboard_comments_areas' ) );
			add_action( 'admin_bar_menu', array( $this, 'remove_admin_bar_comment_items' ), 999 );
			add_action( 'admin_bar_menu', array( $this, 'remove_network_comment_items' ), 999 );
			add_filter( 'comments_template', array( $this, 'comments_template' ) );
			remove_action( 'wp_head', 'feed_links', 2 );
			remove_action( 'wp_head', 'feed_links_extra', 3 );
			//add_action( 'wp_head', array( $this, 'feed_links' ), 2 );
			//add_action( 'wp_head', array( $this, 'feed_links_extra' ), 3 );
			add_action( 'template_redirect', array( $this, 'filter_query' ), 9 );
			add_filter( 'wp_headers', array( $this, 'filter_wp_headers' ) );
			add_action( 'widgets_init', array( $this, 'unregister_default_wp_widgets' ), 1 );
			add_action( 'personal_options', array( $this, 'remove_profile_items' ) );
			add_filter( 'xmlrpc_methods', array( $this, 'xmlrpc_replace_methods' ) );
			add_filter( 'post_comments_feed_link', '__return_empty_string' );
			add_filter( 'get_comments_number', '__return_empty_string' );
			add_filter( 'get_comments_link', '__return_empty_string' );
			add_filter( 'query_vars', array( $this, 'filter_query_vars' ) );
			add_action( 'admin_head-post.php', array( $this, 'remove_help_tabs' ), 10, 3 );
			add_filter( 'comments_rewrite_rules', '__return_empty_array', 99 );
			add_filter( 'rewrite_rules_array', array( $this, 'filter_rewrite_rules_array' ), 99 );
			add_filter( 'wp_count_comments', array( $this, 'filter_count_comments' ) );
		}

		public static function get_object() {
			if ( null === self::$classobj ) {
				self::$classobj = new self;
			}

			return self::$classobj;
		}

		public function remove_update_nag( $value ) {
			if ( isset( $value->response[ plugin_basename( __FILE__ ) ] )
				&& ! empty( $value->response[ plugin_basename( __FILE__ ) ] )
			) {
				unset( $value->response[ plugin_basename( __FILE__ ) ] );
			}

			return $value;
		}

		public function set_comment_status( $posts ) {
			if ( ! empty( $posts ) && is_singular() ) {
				$posts[ 0 ]->comment_status = 'closed';
				$posts[ 0 ]->ping_status = 'closed';
			}

			return $posts;
		}

		public function close_comments( $open, $post_id ) {

			if ( ! $open ) {
				return $open;
			}

			$post = get_post( $post_id );

			if ( $post->post_type ) {
				return false;
			}

			return $open;
		}

		public function return_closed() {
			return 'closed';
		}

		public function remove_comments() {
			global $pagenow;

			foreach ( array( 'comments_notify', 'default_pingback_flag' ) as $option ) {
				add_filter( 'pre_option_' . $option, '__return_zero' );
			}

			foreach ( array( 'default_comment_status', 'default_ping_status' ) as $option ) {
				add_filter( 'pre_option_' . $option, array( $this, 'return_closed' ) );
			}

			foreach ( get_post_types() as $post_type ) {
				remove_meta_box( 'commentstatusdiv', $post_type, 'normal' );
				remove_meta_box( 'commentsdiv', $post_type, 'normal' );
				remove_meta_box( 'trackbacksdiv', $post_type, 'normal' );

				if ( post_type_supports( $post_type, 'comments' ) ) {
					remove_post_type_support( $post_type, 'comments' );
					remove_post_type_support( $post_type, 'trackbacks' );
				}
			}

			if ( in_array( $pagenow, self::$comment_pages, false ) ) {
				wp_die(
					esc_html__( '此网站上的评论被禁用，如需开启，请到「后台-网站优化-WP优化」中开启', 'dq_delete_all_comments' ),
					'',
					array( 'response' => 403 )
				);
				exit();
			}

			remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		}

		public function remove_menu_items() {
			remove_menu_page( 'edit-comments.php' );
			remove_submenu_page( 'options-general.php', 'options-discussion.php' );
		}

		public function add_menu_classes( $menu ) {
			if ( isset( $menu[ 20 ][ 4 ] ) ) {
				$menu[ 20 ][ 4 ] .= ' menu-top-last';
			}

			return $menu;
		}

		public function remove_dashboard_comments_areas() {
			?>
			<script type="text/javascript">
				jQuery( document ).ready( function( $ ) {
					$( '.welcome-comments' ).parent().remove();
					$( 'div.table_discussion:first' ).remove();
					$( 'div#dash-right-now, #dashboard_right_now' ).find( '.comment-count' ).remove();
					$( 'div#dashboard_activity' ).find( '#latest-comments' ).remove();
				} );
			</script>
			<?php
		}

		public function remove_admin_bar_comment_items( $wp_admin_bar ) {
			if ( ! is_admin_bar_showing() ) {
				return null;
			}

			if ( isset( $GLOBALS['blog_id'] ) ) {
				$wp_admin_bar->remove_node( 'blog-' . $GLOBALS['blog_id'] . '-c' );
			}

			$wp_admin_bar->remove_node( 'comments' );
		}

		public function remove_network_comment_items() {
			if ( ! is_admin_bar_showing() ) {
				return null;
			}

			global $wp_admin_bar;

			if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
				require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
			}

			if ( is_multisite() && is_plugin_active_for_network( plugin_basename( __FILE__ ) ) ) {
				foreach ( (array) $wp_admin_bar->user->blogs as $blog ) {
					$wp_admin_bar->remove_node( 'blog-' . $blog->userblog_id . '-c' );
				}
			}
		}

		public function feed_links( $args ) {
			if ( ! current_theme_supports( 'automatic-feed-links' ) ) {
				return null;
			}

			$defaults = array(
				'separator' => _x(
					'&raquo;',
					'feed link',
					'dq_delete_all_comments'
				),
				'feedtitle' => __( '%1$s %2$s Feed', 'dq_delete_all_comments' ),
			);

			$args = wp_parse_args( $args, $defaults );

			echo '<link rel="alternate" type="' . esc_attr( feed_content_type() ) . '" title="' .
				esc_attr(
					sprintf(
						$args['feedtitle' ],
						get_bloginfo( 'name' ),
						$args['separator']
					)
				) . '" href="' . esc_attr( get_feed_link() ) . '"/>' . "\n";
		}

		public function feed_links_extra( $args ) {
			$defaults = array(
				'separator' => _x( '&raquo;', 'feed link' ),
				'cattitle' => __( '%1$s %2$s %3$s Category Feed' ),
				'tagtitle' => __( '%1$s %2$s %3$s Tag Feed' ),
				'authortitle' => __( '%1$s %2$s Posts by %3$s Feed' ),
				'searchtitle' => __( '%1$s %2$s Search Results for &#8220;%3$s&#8221; Feed' ),
				'posttypetitle' => __( '%1$s %2$s %3$s Feed' ),
			);

			$args = wp_parse_args( $args, $defaults );

			if ( is_category() ) {
				$term = get_queried_object();

				$title = sprintf( $args['cattitle' ], get_bloginfo( 'name' ), $args['separator' ], $term->name );
				$href = get_category_feed_link( $term->term_id );
			} elseif ( is_tag() ) {
				$term = get_queried_object();

				$title = sprintf( $args['tagtitle' ], get_bloginfo( 'name' ), $args['separator' ], $term->name );
				$href = get_tag_feed_link( $term->term_id );
			} elseif ( is_author() ) {
				$author_id = (int) get_query_var( 'author' );

				$title = sprintf(
					$args['authortitle' ], get_bloginfo( 'name' ), $args['separator' ],
					get_the_author_meta( 'display_name', $author_id )
				);
				$href = get_author_feed_link( $author_id );
			} elseif ( is_search() ) {
				$title = sprintf(
					$args['searchtitle' ], get_bloginfo( 'name' ), $args['separator' ], get_search_query( false )
				);
				$href = get_search_feed_link();
			} elseif ( is_post_type_archive() ) {
				$title = sprintf(
					$args['posttypetitle' ], get_bloginfo( 'name' ), $args['separator' ],
					post_type_archive_title( '', false )
				);
				$href = get_post_type_archive_feed_link( get_queried_object()->name );
			}

			if ( isset( $title, $href ) ) {
				echo '<link rel="alternate" type="' . esc_attr( feed_content_type() ) . '" title="' . esc_attr(
						$title
					) . '" href="' . esc_url( $href ) . '" />' . "\n";
			}
		}

		public function filter_query() {
			if ( ! is_comment_feed() ) {
				return null;
			}

			if ( isset( $_GET['feed'] ) ) {
				wp_safe_redirect( remove_query_arg( 'feed' ), 301 );
				exit();
			}
			set_query_var( 'feed', '' );
		}

		public function filter_wp_headers( $headers ) {
			unset( $headers['X-Pingback'] );

			return $headers;
		}

		public function unregister_default_wp_widgets() {
			unregister_widget( 'WP_Widget_Recent_Comments' );
		}

		public function remove_profile_items() {
			?>
			<script type="text/javascript">
				jQuery( document ).ready( function( $ ) {
					$( '#your-profile' ).find( '.form-table' ).first().find( 'tr:nth-child(3)' ).remove();
				} );
			</script>
			<?php
		}

		public function comments_template() {
			return plugin_dir_path( __FILE__ ) . 'comments.php';
		}

		public function xmlrpc_replace_methods( $methods ) {
			$comment_methods = array(
				'wp.getCommentCount',
				'wp.getComment',
				'wp.getComments',
				'wp.deleteComment',
				'wp.editComment',
				'wp.newComment',
				'wp.getCommentStatusList',
			);

			foreach ( $comment_methods as $method_name ) {
				if ( isset( $methods[ $method_name ] ) ) {
					$methods[ $method_name ] = array( $this, 'xmlrpc_placeholder_method' );
				}
			}

			return $methods;
		}

		public function xmlrpc_placeholder_method() {
			return new IXR_Error(
				403,
				esc_attr__( '此网站上的评论被禁用，如需开启，请到「后台-网站优化-WP优化」中开启', 'dq_delete_all_comments' )
			);
		}

		public function filter_query_vars( $public_query_vars ) {
			$key = array_search( 'comments_popup', $public_query_vars, false );
			if ( false !== $key ) {
				unset( $public_query_vars[ $key ] );
			}

			return $public_query_vars;
		}

		public function remove_help_tabs() {
			$current_screen = get_current_screen();

			if ( $current_screen->get_help_tab( 'discussion-settings' ) ) {
				$current_screen->remove_help_tab( 'discussion-settings' );
			}
		}

		public function filter_rewrite_rules_array( $rules ) {
			if ( is_array( $rules ) ) {

				foreach ( $rules as $k => $v ) {
					if ( false !== strpos( $k, '|commentsrss2' ) ) {
						$new_k = str_replace( '|commentsrss2', '', $k );
						unset( $rules[ $k ] );
						$rules[ $new_k ] = $v;
					}
				}

				foreach ( $rules as $k => $v ) {
					if ( false !== strpos( $k, 'comment-page-' ) ) {
						unset( $rules[ $k ] );
					}
				}
			}

			return $rules;
		}

		public function filter_count_comments() {
			return (object) array( 'approved' => 0,
				'spam' => 0,
				'trash' => 0,
				'post-trashed' => 0,
				'total_comments' => 0,
				'all' => 0,
				'moderated' => 0,
			);
		}
	}
}
