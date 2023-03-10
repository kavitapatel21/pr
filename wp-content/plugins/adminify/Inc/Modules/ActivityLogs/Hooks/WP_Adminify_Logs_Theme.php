<?php

namespace WPAdminify\Inc\Modules\ActivityLogs\Hooks;

use  WPAdminify\Inc\Modules\ActivityLogs\Inc\Hooks_Base;

// no direct access allowed
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WP_Adminify_Logs_Theme extends Hooks_Base {

	public function __construct() {
		parent::__construct();

		add_filter( 'wp_redirect', [ $this, 'hooks_theme_modify' ], 10, 2 );
		add_action( 'switch_theme', [ $this, 'hooks_switch_theme' ], 10, 2 );
		add_action( 'delete_site_transient_update_themes', [ $this, 'hooks_theme_deleted' ] );
		add_action( 'upgrader_process_complete', [ $this, 'hooks_theme_install_or_update' ], 10, 2 );

		// Theme customizer
		add_action( 'customize_save', [ $this, 'hooks_theme_customizer_modified' ] );
		// add_action( 'customize_preview_init', array( &$this, 'hooks_theme_customizer_modified' ) );
	}


	public function hooks_theme_modify( $location, $status ) {
		if ( false !== strpos( $location, 'theme-editor.php?file=' ) ) {
			if ( ! empty( $_POST ) && 'update' === $_POST['action'] ) {
				$aal_args = [
					'action'         => 'file_updated',
					'object_type'    => 'Theme',
					'object_subtype' => 'theme_unknown',
					'object_id'      => 0,
					'object_name'    => 'file_unknown',
				];

				if ( ! empty( $_POST['file'] ) ) {
					$aal_args['object_name'] = sanitize_text_field( wp_unslash( $_POST['file'] ) );
				}

				if ( ! empty( $_POST['theme'] ) ) {
					$aal_args['object_subtype'] = sanitize_text_field( wp_unslash( $_POST['theme'] ) );
				}

				adminify_activity_logs( $aal_args );
			}
		}

		// We are need return the instance, for complete the filter.
		return $location;
	}

	public function hooks_switch_theme( $new_name, \WP_Theme $new_theme ) {
		adminify_activity_logs(
			[
				'action'         => 'activated',
				'object_type'    => 'Theme',
				'object_subtype' => $new_theme->get_stylesheet(),
				'object_id'      => 0,
				'object_name'    => $new_name,
			]
		);
	}

	public function hooks_theme_customizer_modified( \WP_Customize_Manager $obj ) {
		$aal_args = [
			'action'         => 'updated',
			'object_type'    => 'Theme',
			'object_subtype' => $obj->theme()->display( 'Name' ),
			'object_id'      => 0,
			'object_name'    => 'Theme Customizer',
		];

		if ( 'customize_preview_init' === current_filter() ) {
			$aal_args['action'] = 'accessed';
		}

		adminify_activity_logs( $aal_args );
	}

	public function hooks_theme_deleted() {
		$backtrace_history = debug_backtrace();

		$delete_theme_call = null;
		foreach ( $backtrace_history as $call ) {
			if ( isset( $call['function'] ) && 'delete_theme' === $call['function'] ) {
				$delete_theme_call = $call;
				break;
			}
		}

		if ( empty( $delete_theme_call ) ) {
			return;
		}

		$name = $delete_theme_call['args'][0];

		adminify_activity_logs(
			[
				'action'      => 'deleted',
				'object_type' => 'Theme',
				'object_name' => $name,
			]
		);
	}

	/**
	 * @param Theme_Upgrader $upgrader
	 * @param array          $extra
	 */
	public function hooks_theme_install_or_update( $upgrader, $extra ) {
		if ( ! isset( $extra['type'] ) || 'theme' !== $extra['type'] ) {
			return;
		}

		if ( 'install' === $extra['action'] ) {
			$slug = $upgrader->theme_info();
			if ( ! $slug ) {
				return;
			}

			wp_clean_themes_cache();
			$theme   = wp_get_theme( $slug );
			$name    = $theme->name;
			$version = $theme->version;

			adminify_activity_logs(
				[
					'action'         => 'installed',
					'object_type'    => 'Theme',
					'object_name'    => esc_html( $name ),
					'object_subtype' => esc_html( $version ),
				]
			);
		}

		if ( 'update' === $extra['action'] ) {
			if ( isset( $extra['bulk'] ) && true == $extra['bulk'] ) {
				$slugs = $extra['themes'];
			} else {
				$slugs = [ $upgrader->skin->theme ];
			}

			foreach ( $slugs as $slug ) {
				$theme      = wp_get_theme( $slug );
				$stylesheet = $theme['Stylesheet Dir'] . '/style.css';
				$theme_data = get_file_data( $stylesheet, [ 'Version' => 'Version' ] );

				$name    = $theme['Name'];
				$version = $theme_data['Version'];

				adminify_activity_logs(
					[
						'action'         => 'updated',
						'object_type'    => 'Theme',
						'object_name'    => $name,
						'object_subtype' => $version,
					]
				);
			}
		}
	}
}
