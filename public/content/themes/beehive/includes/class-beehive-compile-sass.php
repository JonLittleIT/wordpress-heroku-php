<?php
/**
 * Beehive scssphp
 *
 * @author     thunder-team
 * @copyright  (c) Copyright by Thunder Team
 * @link       https://themeforest.net/user/thunder-team/
 * @package    WordPress
 * @subpackage beehive
 * @since      1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); }

/**
 * Include scssphp library
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/sass-compiler/scss.inc.php';
use Leafo\ScssPhp\Compiler;

/**
 * Beehive_Compile_Sass class.
 *
 * @since 1.0.0
 */
class Beehive_Compile_Sass {

	/**
	 * Scss file path full
	 *
	 * @access public
	 * @var string
	 */
	public $scss_file;

	/**
	 * Css directory
	 *
	 * @access protected
	 * @var string
	 */
	protected $css_dir;

	/**
	 * File name
	 *
	 * @access public
	 * @var string
	 */
	public $file_name;

	/**
	 * Scss variables
	 *
	 * @access public
	 * @var array
	 */
	public $variables;

	/**
	 * Scss formatter
	 *
	 * @access private
	 * @var string
	 */
	private $formatter;

	/**
	 * Source map
	 *
	 * @access private
	 * @var string
	 */
	private $sourcemap;

	/**
	 * Scssphp compiler
	 *
	 * @access public
	 * @var object
	 */
	public $compiler;

	/**
	 * Class constractor
	 *
	 * @access public
	 * @param string $scss_file scss file path.
	 * @param string $css_dir   css dir path.
	 * @param array  $variables scss variables.
	 * @param string $formatter css formatter.
	 * @param string $sourcemap scss sourcemap.
	 * @throws \LogicException  Scss file path should be valid.
	 * @var null|object
	 * @since 1.0.0
	 */
	public function __construct( $scss_file, $css_dir = '', $variables = array(), $formatter = 'compressed', $sourcemap = 'none' ) {

		// Return if scssphp doesn't exist.
		if ( ! class_exists( 'Leafo\ScssPhp\Compiler' ) ) {
			return;
		}

		// The scss file.
		$scss_file = untrailingslashit( $scss_file );
		if ( file_exists( $scss_file ) && is_readable( $scss_file ) && 'scss' === pathinfo( $scss_file, PATHINFO_EXTENSION ) ) {
			$this->scss_file = $scss_file;
			$this->file_name = basename( $this->scss_file, '.scss' );
		} else {
			throw new Exception( '.scss file not found' );
		}

		// Return if scss file is not set.
		if ( empty( $this->scss_file ) ) {
			return;
		}

		// css dir.
		if ( is_string( $css_dir ) && ! empty( $css_dir ) ) {
			$this->css_dir = $css_dir;
		} else {
			$this->css_dir = trailingslashit( BEEHIVE_ROOT ) . 'assets/css';
		}

		// Return if not a valid css directory.
		if ( null === $this->css_dir ) {
			return;
		}

		// Set scss variables.
		$this->variables = $variables;
		// Set formatter.
		$this->set_formatter( $formatter );
		// Set sourcemap.
		$this->set_sourcemap( $sourcemap );

		// instantiate compiler.
		$this->compiler = new Compiler();

	}

	/**
	 * Set formatter
	 *
	 * @access private
	 * @param string $formatter css format.
	 * @return void
	 * @since 1.0.0
	 */
	private function set_formatter( $formatter ) {
		if ( 'expanded' === $formatter ) {
			$this->formatter = 'Leafo\ScssPhp\Formatter\Expanded';
		} elseif ( 'nested' === $formatter ) {
			$this->formatter = 'Leafo\ScssPhp\Formatter\Nested';
		} elseif ( 'compact' === $formatter ) {
			$this->formatter = 'Leafo\ScssPhp\Formatter\Compact';
		} elseif ( 'crunched' === $formatter ) {
			$this->formatter = 'Leafo\ScssPhp\Formatter\Crunched';
		} else {
			$this->formatter = 'Leafo\ScssPhp\Formatter\Compressed';
		}
	}

	/**
	 * Set sourcemap
	 *
	 * @access private
	 * @param string $sourcemap compiled css mapping.
	 * @return void
	 * @since 1.0.0
	 */
	private function set_sourcemap( $sourcemap ) {
		if ( 'inline' === $sourcemap ) {
			$this->sourcemap = 'SOURCE_MAP_INLINE';
		} elseif ( 'file' === $sourcemap ) {
			$this->sourcemap = 'SOURCE_MAP_FILE';
		} else {
			$this->sourcemap = 'SOURCE_MAP_NONE';
		}
	}

	/**
	 * Check if css dir is writable
	 *
	 * @access public
	 * @return bool
	 * @since 1.0.0
	 */
	public function is_css_dir_writable() {
		if ( is_writable( $this->css_dir ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Returns ompiled scss
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function get_compiled_css() {

		// The Compiler.
		$compiler = $this->compiler;

		// return early if compiler is empty.
		if ( empty( $compiler ) ) {
			return;
		}

		// Scss dir name.
		$dir_name = pathinfo( $this->scss_file, PATHINFO_DIRNAME );

		// Set compiler import path.
		$compiler->setImportPaths( $dir_name );
		// Set compiler formatter.
		$compiler->setFormatter( $this->formatter );
		// Set compiler variables.
		if ( ! empty( $this->variables ) && is_array( $this->variables ) ) {
			$compiler->setVariables( $this->variables );
		}
		// Set source map.
		$map = $this->file_name . '.css.map';
		$compiler->setSourceMap( constant( 'Leafo\ScssPhp\Compiler::' . $this->sourcemap ) );
		$compiler->setSourceMapOptions(
			array(
				'sourceMapWriteTo'  => trailingslashit( $this->css_dir ) . $map,
				'sourceMapURL'      => $map,
				'sourceMapBasepath' => rtrim( ABSPATH, '/' ),
				'sourceRoot'        => '/',
			)
		);

		// Compiled css.
		$css = $compiler->compile( '@import "' . $this->file_name . '";' );

		// Return css.
		return $css;

	}

	/**
	 * Compile css file
	 *
	 * @access public
	 * @throws \LogicException Css directory should be writable.
	 * @return void
	 * @since 1.0.0
	 */
	public function compile_file() {

		// Check if css dir exists.
		try {
			if ( is_dir( $this->css_dir ) && true === $this->is_css_dir_writable() ) {
				beehive_file_put_contents( $this->get_css_file_path(), $this->get_compiled_css() );
			} else {
				throw new Exception( 'CSS directory is not valid or not writable.' );
			}
		} catch ( Exception $e ) {
			echo esc_html( $e->getMessage() );
		}
	}

	/**
	 * Get file name
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function get_file_name() {
		return $this->file_name;
	}

	/**
	 * Get css file path
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function get_css_file_path() {
		if ( null !== $this->file_name ) {
			return trailingslashit( $this->css_dir ) . $this->file_name . '.css';
		}
	}

}
