<?php
if ( ! function_exists( 'nirweb_ticket_count_all_ticket' ) ) {
	function nirweb_ticket_count_all_ticket() {
		global $wpdb;
		$count_all = intval( $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->prefix}nirweb_ticket_ticket WHERE %d", 1 ) ) );
		return esc_html( $count_all );
	}
}
if ( ! function_exists( 'nirweb_ticket_count_new_ticket' ) ) {
	function nirweb_ticket_count_new_ticket() {
		global $wpdb;
		$count_all = intval( $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->prefix}nirweb_ticket_ticket WHERE status=%d", 1 ) ) );
		return esc_html( $count_all );
	}
}
if ( ! function_exists( 'nirweb_ticket_count_new_ticket_posht' ) ) {
	function nirweb_ticket_count_new_ticket_posht( $id ) {
		global $wpdb;
		$count_all = intval(
			$wpdb->get_var(
				$wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->prefix}nirweb_ticket_ticket  WHERE (support_id = %d OR sender_id = %d) AND status=%d", $id, $id, 1 )
			)
		);
			return esc_html( $count_all );
	}
}
if ( ! function_exists( 'nirweb_ticket_count_process_ticket' ) ) {
	function nirweb_ticket_count_process_ticket() {
		global $wpdb;
		$count_all = intval( $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->prefix}nirweb_ticket_ticket  WHERE status= %d", 2 ) ) );
		return esc_html( $count_all );
	}
}
if ( ! function_exists( 'nirweb_ticket_count_answered_ticket' ) ) {
	function nirweb_ticket_count_answered_ticket() {
		global $wpdb;
		$count_all = intval( $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->prefix}nirweb_ticket_ticket  WHERE status= %d", 3 ) ) );

		return esc_html( $count_all );
	}
}
if ( ! function_exists( 'nirweb_ticket_count_closed_ticket' ) ) {
	function nirweb_ticket_count_closed_ticket() {
		global $wpdb;
		$count_all = intval( $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->prefix}nirweb_ticket_ticket  WHERE status= %d", 4 ) ) );

		return esc_html( $count_all );
	}
}

