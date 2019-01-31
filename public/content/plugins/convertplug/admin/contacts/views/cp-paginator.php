<?php
/**
 * Prohibit direct script loading.
 *
 * @package Convert_Plus.
 */

/**
 * Class CP_Paginator.
 */
class CP_Paginator {

	/**
	 * $_conn variable.
	 *
	 * @var string.
	 */
	private $_conn;

	/**
	 * $_limit variable.
	 *
	 * @var string.
	 */
	private $_limit;

	/**
	 * $_page no of pages dispaly.
	 *
	 * @var string
	 */
	private $_page;

	/**
	 * $contacts description.
	 *
	 * @var array.
	 */
	private $contacts;

	/**
	 * $_total var total.
	 *
	 * @var integer.
	 */
	private $_total;

	/**
	 * Constructor.
	 *
	 * @param mixed $contacts description.
	 */
	public function __construct( $contacts ) {

		$this->contacts = $contacts;
		$this->_total   = count( $contacts );
	}


	/**
	 * Function returns data to display.
	 *
	 * @param  integer $limit          limit.
	 * @param  integer $page           page no.
	 * @param  string  $orderby        Function returns data to display parameter.
	 * @param  string  $order          Function returns data to display parameter.
	 * @param  string  $search_key     Function returns data to display parameter.
	 * @param  string  $serach_in_params Function returns data to display parameter.
	 * @param  string  $maintain_keys  Function returns data to display parameter.
	 * @return array                  result array.
	 */
	public function get_data( $limit = 10, $page = 1, $orderby, $order, $search_key, $serach_in_params, $maintain_keys ) {
		$this->serach_in_params = '';
		$this->_limit           = $limit;
		$this->_page            = $page;
		$this->_offset          = ( ( $this->_page - 1 ) * $this->_limit );
		$this->_upto            = $this->_offset + $this->_limit;
		$this->orderby          = $orderby;
		$this->order            = $order;
		$this->serach_in_params = $serach_in_params;
		$this->maintainkeys     = $maintain_keys;

		$data = $this->contacts;
		if ( '' !== $search_key ) {

			$data = array_filter(
				$data,
				function ( $item ) use ( $search_key ) {

					$found = false;

					foreach ( $this->serach_in_params as $param ) {

						if ( array_key_exists( $param, $item ) ) {
							if ( false !== stripos( strtolower( urldecode( $item[ $param ] ) ), $search_key ) ) {
								$found = true;
							}
						}
					}
					if ( $found ) {
						return true;
					}
					return false;
				}
			);

			$this->_total = count( $data );
		}

		if ( $this->order ) {

			if ( ! $this->maintainkeys ) {
				$data = array_values( $data );
			}

			if ( 'asc' === $this->order ) {
				uasort(
					$data,
					function( $a, $b ) {

						if ( isset( $a[ $this->orderby ] ) && isset( $b[ $this->orderby ] ) ) {

							// If type of data is integer.
							if ( 'integer' === gettype( $a[ $this->orderby ] ) ) {
								return $this->cp_int_cmp( $a[ $this->orderby ], $b[ $this->orderby ] );
							}

							if ( 'date' === $this->orderby ) {
								return strcmp( strtotime( $a[ $this->orderby ] ), strtotime( $b[ $this->orderby ] ) );
							} else {
								return strcmp( strtolower( $a[ $this->orderby ] ), strtolower( $b[ $this->orderby ] ) );
							}
						}
					}
				);
			} else {
				uasort(
					$data,
					function( $b, $a ) {

						if ( isset( $a[ $this->orderby ] ) && isset( $b[ $this->orderby ] ) ) {

							// If type of data is integer.
							if ( 'integer' === gettype( $a[ $this->orderby ] ) ) {
								return $this->cp_int_cmp( $a[ $this->orderby ], $b[ $this->orderby ] );
							}

							if ( 'date' === $this->orderby ) {
								return strcmp( strtotime( $a[ $this->orderby ] ), strtotime( $b[ $this->orderby ] ) );
							} else {
								return strcmp( strtolower( $a[ $this->orderby ] ), strtolower( $b[ $this->orderby ] ) );
							}
						}
					}
				);
			}

			$data = array_slice( $data, $this->_offset, $this->_limit, true );

		} else {
			$data = array_slice( $data, $this->_offset, $this->_limit, true );
		}

		$result       = new stdClass();
		$result->data = $data;

		return $result;
	}

	/**
	 * Function compare two integers.
	 *
	 * @param  integer $a integer val.
	 * @param  integer $b integer val.
	 * @return integer    integer val.
	 */
	function cp_int_cmp( $a, $b ) {
		return ( $a - $b ) ? ( $a - $b ) / abs( $a - $b ) : 0;
	}

	/**
	 * Function create links for pagination.
	 *
	 * @param  string $links          string parameter.
	 * @param  string $list_class     string parameter.
	 * @param  string $list_id         string parameter.
	 * @param  string $sq             string parameter.
	 * @param  string $base_page_link string parameter.
	 * @return string                 string parameter.
	 */
	public function create_links( $links, $list_class, $list_id, $sq, $base_page_link ) {
		if ( 'all' === $this->_limit ) {
			return '';
		}

		if ( '' !== $list_id ) {
			$base_page_link .= '&list=' . $list_id;
		}

		$url_link = '';
		if ( isset( $_GET['orderby'] ) ) {
			$url_link .= '&orderby=' . esc_attr( $_GET['orderby'] );
		}

		if ( isset( $_GET['order'] ) ) {
			$url_link .= '&order=' . esc_attr( $_GET['order'] );
		}

		$last = ceil( $this->_total / $this->_limit );

		$start = ( 0 < ( $this->_page - $links ) ) ? $this->_page - $links : 1;
		$end   = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;

		$html = '<ul class="' . $list_class . '">';

		$class           = ( 1 === $this->_page ) ? 'disabled' : '';
		$prev_page_link  = ( 1 === $this->_page ) ? 'javascript:void(0)' : $base_page_link . '&limit=' . $this->_limit . '&sq=' . $sq . '&cont-page=' . ( $this->_page - 1 ) . $url_link;
		$first_page_link = $base_page_link . '&limit=' . $this->_limit . '&sq=' . $sq . '&cont-page=1' . $url_link;
		$html           .= '<li class="' . $class . '"><a href="' . $first_page_link . '"><span class="connects-icon-rewind"></span></a></li>';
		$html           .= '<li class="' . $class . '"><a href="' . $prev_page_link . '"><span class="dashicons dashicons-arrow-left-alt2"></span></a></li>';

		if ( 1 < $this->_page ) {
			$start = $this->_page - 1;
		} else {
			$start = 1;
		}

		for ( $i = $start; $i <= $end; $i++ ) {
			$class = ( $this->_page === $i ) ? 'active' : '';
			$html .= '<li class="' . $class . '"><a href="' . $base_page_link . '&limit=' . $this->_limit . '&sq=' . $sq . '&cont-page=' . $i . $url_link . '">' . $i . '</a></li>';
		}

		if ( $end < $last ) {
			$html .= '<li class="disabled"><span>...</span></li>';
			$html .= '<li><a href="' . $base_page_link . '&limit=' . $this->_limit . '&sq=' . $sq . '&cont-page=' . $last . $url_link . '">' . $last . '</a></li>';
		}

		$class          = ( $this->_page === $last ) ? 'disabled' : '';
		$next_page_link = ( $this->_page === $last ) ? 'javascript:void(0)' : $base_page_link . '&limit=' . $this->_limit . '&sq=' . $sq . '&cont-page=' . ( $this->_page + 1 ) . $url_link;
		$last_page_link = ( $this->_page === $last ) ? 'javascript:void(0)' : $base_page_link . '&limit=' . $this->_limit . '&sq=' . $sq . '&cont-page=' . ( $last ) . $url_link;
		$html          .= '<li class="' . $class . '"><a href="' . $next_page_link . '"><span class="dashicons dashicons-arrow-right-alt2"></span></a></li>';
		$html          .= '<li class="' . $class . '"><a href="' . $last_page_link . '"><span class="connects-icon-fast-forward"></span></a></li>';

		$html .= '</ul>';

		return $html;
	}
}
