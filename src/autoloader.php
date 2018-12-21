<?php
/**
 * Lightweight PSR-4 PHP Autoloader Class.
 *
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @version 1.0
 * @since 1.0
 * @link
 * @copyright 2018 Varun Sridharan
 * @license GPLV3 Or Greater (https://www.gnu.org/licenses/gpl-3.0.txt)
 */

namespace Varunsridharan\PHP;

/**
 * Class Autoloader
 *
 * @package Varunsridharan\PHP
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @since 1.0
 */
class Autoloader {
	/**
	 * Stores Subinstance.
	 *
	 * @var array
	 * @access protected.
	 */
	protected $sub_instance = array();

	/**
	 * @var null
	 * @access
	 */
	protected $namespace = null;

	/**
	 * @var null
	 * @access
	 */
	protected $base_path = null;

	/**
	 * @var null
	 * @access
	 */
	protected $remaps = null;

	/**
	 * Search And Stores All Subfolders in the base dir if required.
	 *
	 * @var array
	 * @access protected
	 */
	protected $subfolders = array();

	/**
	 * Stores Debug Information.
	 *
	 * @var array
	 * @access
	 */
	protected $debug = array();

	/**
	 * Autoloader constructor.
	 *
	 * @param string $namespaces
	 * @param string $base_path
	 * @param array  $remaps
	 * @param bool   $prepend_autoload
	 */
	public function __construct( $namespaces = '', $base_path = '', $remaps = array(), $prepend_autoload = false ) {
		if ( ! is_array( $namespaces ) ) {
			$this->namespace = $namespaces;
			$this->base_path = $this->trailingslashit( $base_path );
			$this->remaps    = $remaps;
			$this->register( $prepend_autoload );
		}
	}

	/**
	 * Registers Autoloader With PHP.
	 *
	 * @param bool $prepend
	 *
	 * @return $this
	 */
	public function register( $prepend = false ) {
		spl_autoload_register( array( &$this, 'load_class' ), true, $prepend );
		return $this;
	}

	/**
	 * De-Registers Autoloader In PHP.
	 *
	 * @return $this
	 */
	public function unregister() {
		spl_autoload_unregister( array( &$this, 'load_class' ) );
		return $this;
	}

	/**
	 * Removes trailing forward slashes and backslashes if they exist.
	 *
	 * The primary use of this is for paths and thus should be used for paths. It is
	 * not restricted to paths and offers no specific path support.
	 *
	 * @param string $string What to remove the trailing slashes from.
	 *
	 * @return string String without the trailing slashes.
	 */
	protected function untrailingslashit( $string ) {
		return rtrim( $string, '/\\' );
	}

	/**
	 * Appends a trailing slash.
	 *
	 * Will remove trailing forward and backslashes if it exists already before adding
	 * a trailing forward slash. This prevents double slashing a string or path.
	 *
	 * The primary use of this is for paths and thus should be used for paths. It is
	 * not restricted to paths and offers no specific path support.
	 *
	 * @param string $string What to add the trailing slash to.
	 *
	 * @return string String with trailing slash added.
	 */
	protected function trailingslashit( $string ) {
		return $this->untrailingslashit( $string ) . '/';
	}

	/**
	 * Stores Debug Message.
	 *
	 * @param $msg
	 *
	 * @return $this
	 */
	protected function debug( $msg ) {
		$this->debug[] = $msg;
		return $this;
	}

	/**
	 * Returns Debug Informations.
	 *
	 * @return array
	 */
	public function show_debug() {
		return $this->debug;
	}

	/**
	 * Works For PHP SPL Autoloader and loads class based on the requests.
	 *
	 * @param $org_class
	 */
	public function load_class( $org_class ) {
		if ( strpos( strtolower( $org_class ), strtolower( $this->namespace ) ) !== false ) {
			$filenames = array();
			$folders   = array();
			$is_loaded = false;

			$this->debug( 'Class Requested : ' . $org_class );
			$this->debug( 'Checking in Remaps Array' );

			if ( isset( $this->remaps[ $org_class ] ) && ( file_exists( $this->remaps[ $org_class ] ) || file_exists( $this->base_path . $this->remaps[ $org_class ] ) ) ) {
				$is_loaded = $this->load_file( $this->remaps[ $org_class ], $org_class );

				if ( false === $is_loaded ) {
					$is_loaded = $this->load_file( $this->base_path . $this->remaps[ $org_class ], $org_class );
				}
			}

			if ( false === $is_loaded ) {
				$filenames = $this->get_file_name( $org_class );
				$folders   = $this->get_folder_name( $org_class );
				$this->debug( 'Not Found In Remap Array' );
			}

			if ( false === $is_loaded ) {
				$this->debug( '' );
				$this->debug( 'Checking Using Requested Class Namespace' );
				if ( is_array( $filenames ) && is_array( $folders ) ) {
					foreach ( $folders as $folder ) {
						foreach ( $filenames as $file ) {
							$is_loaded = $this->load_file( $this->trailingslashit( $this->base_path . $folder ) . $file, $org_class );
							if ( $is_loaded ) {
								$this->debug( 'Class Found' );
								break;
							} else {
								$this->debug( 'File Not Found In : ' . $this->trailingslashit( $this->base_path . $folder ) . $file );
							}
						}
						if ( $is_loaded ) {
							break;
						}
					}
				}
			}

			if ( false === $is_loaded ) {
				$this->debug( '' );
				$this->debug( 'Checking In All subfolders Inside Base Path' );
				$folders = $this->get_folders( $this->base_path );
				foreach ( $folders as $folder ) {
					foreach ( $filenames as $file ) {
						$is_loaded = $this->load_file( $this->trailingslashit( $folder ) . $file, $org_class );
						if ( $is_loaded ) {
							$this->debug( 'Class Found' );
							break;
						} else {
							$this->debug( 'File Not Found In : ' . $this->trailingslashit( $folder ) . $file );
						}
					}
				}
			}

			$this->debug( '' );
		}
	}

	/**
	 * @param $path
	 * @param $class
	 *
	 * @return bool
	 */
	protected function load_file( $path, $class ) {
		if ( file_exists( $path ) ) {
			require_once $path;
			return ( class_exists( $class, false ) );
		}
		return false;
	}

	/**
	 * Saves & Returns Core Folders.
	 *
	 * @param $path
	 *
	 * @return mixed
	 */
	protected function get_folders( $path ) {
		if ( isset( $this->subfolders[ $path ] ) ) {
			return $this->subfolders[ $path ];
		}

		$this->subfolders[ $path ] = $this->search_folders( $path );
		return $this->subfolders[ $path ];
	}

	/**
	 * Search folders & subfolders inside a given folder and returns it.
	 *
	 * @param $path
	 *
	 * @return array|string
	 */
	protected function search_folders( $path ) {
		$return       = array();
		$base_folders = array_filter( glob( $this->trailingslashit( $path ) . '*' ), 'is_dir' );

		if ( is_array( $base_folders ) && ! empty( $base_folders ) ) {
			foreach ( $base_folders as $folder ) {
				$_sub = $this->search_folders( $this->untrailingslashit( $folder ) );

				if ( is_array( $_sub ) && ! empty( $_sub ) ) {
					$return = array_merge( $return, $_sub );
				} elseif ( is_string( $_sub ) ) {
					$return = array_merge( $return, array( $_sub ) );
					$return = array_merge( $return, array( $this->untrailingslashit( $path ) ) );
				}
			}
		} else {
			$return = $this->trailingslashit( $path );
		}

		return $return;
	}

	/**
	 * Creates File Names From Class Name.
	 *
	 * @param $class
	 *
	 * @return array|bool
	 */
	protected function get_file_name( $class ) {
		if ( $class ) {
			$file   = explode( '\\', $class );
			$file   = strtolower( end( $file ) );
			$file__ = str_replace( '_', '-', $file );
			$files  = array(
				$file . '.php', // File Name With _.
				$file__ . '.php', // File Name With - which is replaced by _.
				'class-' . $file__ . '.php', // File name With Class Prefixed.
				'class_' . $file__ . '.php', // File Name With - which is replaced by _.
			);
			return $files;
		}
		return false;
	}

	/**
	 * @param $class
	 *
	 * @return array|bool
	 */
	protected function get_folder_name( $class ) {
		if ( $class ) {
			$class = str_replace( $this->namespace, '', $class );
			$file  = explode( '\\', $class );
			$file  = end( $file );
			$class = str_replace( $file, '', $class );
			$class = strtolower( str_replace( '\\', '/', $class ) );

			return array(
				$class,
				str_replace( '_', '-', $class ),
			);
		}
		return false;
	}

	/**
	 * Adds Custom Remaps To Remaps Array.
	 *
	 * @param $class
	 * @param $file
	 *
	 * @return $this
	 */
	public function add( $class, $file ) {
		$this->remaps[ $class ] = $file;
		return $this;
	}

	/**
	 * Removes Custom Remaps To a Class in Remaps Array.
	 *
	 * @param $classs
	 *
	 * @return $this
	 */
	public function remove( $classs ) {
		if ( isset( $this->remaps[ $classs ] ) ) {
			unset( $this->remaps[ $classs ] );
		}
		return $this;
	}
}
