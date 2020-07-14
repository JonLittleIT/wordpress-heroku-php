<?php
/**
 * Buddypress xprofile field functions
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( ! function_exists( 'beehive_bp_add_xprofile_birth_date' ) ) :
	/**
	 * Adds date select list xprofile field
	 *
	 * @since 1.0.0
	 * @returns void
	 */
	function beehive_bp_add_xprofile_birth_date() {

		if ( ! xprofile_get_field_id_from_name( 'Date of Birth' ) ) {

			$args = array(
				'field_group_id' => 1,
				'name'           => 'Date of Birth',
				'can_delete'     => true,
				'field_order'    => 5,
				'is_required'    => true,
				'type'           => 'datebox',
				'order_by'       => 'custom',
			);

			xprofile_insert_field( $args );

		}
	}
endif;

if ( ! function_exists( 'beehive_bp_add_xprofile_sex' ) ) :
	/**
	 * Adds sex radio buttons xprofile field
	 *
	 * @since 1.0.0
	 * @returns void
	 */
	function beehive_bp_add_xprofile_sex() {

		if ( ! xprofile_get_field_id_from_name( 'Sex' ) ) {

			$args = array(
				'field_group_id' => 1,
				'name'           => 'Sex',
				'can_delete'     => true,
				'field_order'    => 10,
				'is_required'    => true,
				'type'           => 'radio',
				'order_by'       => 'custom',
			);

			$sex_list_id = xprofile_insert_field( $args );

			if ( $sex_list_id ) {
				$sex_list = array(
					'Male',
					'Female',
				);

				$i = 0;

				foreach ( $sex_list as $sex ) {
					xprofile_insert_field(
						array(
							'field_group_id'    => 1,
							'parent_id'         => $sex_list_id,
							'type'              => 'option',
							'name'              => $sex,
							'option_order'      => $i++,
							'is_default_option' => ( 'Male' === $sex ) ? true : false,
						)
					);
				}
			}
		}

	}
endif;

if ( ! function_exists( 'beehive_bp_add_xprofile_city' ) ) :
	/**
	 * Adds city textbox xprofile field
	 *
	 * @since 1.0.0
	 * @returns void
	 */
	function beehive_bp_add_xprofile_city() {

		if ( ! xprofile_get_field_id_from_name( 'City' ) ) {

			$args = array(
				'field_group_id' => 1,
				'name'           => 'City',
				'can_delete'     => true,
				'field_order'    => 15,
				'is_required'    => true,
				'type'           => 'textbox',
				'order_by'       => 'custom',
			);

			xprofile_insert_field( $args );

		}

	}
endif;

if ( ! function_exists( 'beehive_bp_add_xprofile_country_list' ) ) :
	/**
	 * Adds country list xprofile field
	 *
	 * @since 1.0.0
	 * @returns void
	 */
	function beehive_bp_add_xprofile_country_list() {

		if ( ! xprofile_get_field_id_from_name( 'Country' ) ) {

			$country_list_args = array(
				'field_group_id' => 1,
				'name'           => 'Country',
				'can_delete'     => true,
				'field_order'    => 20,
				'is_required'    => true,
				'type'           => 'selectbox',
				'order_by'       => 'custom',
			);

			$country_list_id = xprofile_insert_field( $country_list_args );

			if ( $country_list_id ) {

				$countries = array(
					'Afghanistan',
					'Albania',
					'Algeria',
					'Andorra',
					'Angola',
					'Antigua and Barbuda',
					'Argentina',
					'Armenia',
					'Australia',
					'Austria',
					'Azerbaijan',
					'Bahamas',
					'Bahrain',
					'Bangladesh',
					'Barbados',
					'Belarus',
					'Belgium',
					'Belize',
					'Benin',
					'Bhutan',
					'Bolivia',
					'Bosnia and Herzegovina',
					'Botswana',
					'Brazil',
					'Brunei',
					'Bulgaria',
					'Burkina Faso',
					'Burundi',
					'Cambodia',
					'Cameroon',
					'Canada',
					'Cape Verde',
					'Central African Republic',
					'Chad',
					'Chile',
					'China',
					'Colombi',
					'Comoros',
					'Congo (Brazzaville)',
					'Congo',
					'Costa Rica',
					"Cote d'Ivoire",
					'Croatia',
					'Cuba',
					'Cyprus',
					'Czech Republic',
					'Denmark',
					'Djibouti',
					'Dominica',
					'Dominican Republic',
					'East Timor (Timor Timur)',
					'Ecuador',
					'Egypt',
					'El Salvador',
					'Equatorial Guinea',
					'Eritrea',
					'Estonia',
					'Ethiopia',
					'Fiji',
					'Finland',
					'France',
					'Gabon',
					'Gambia, The',
					'Georgia',
					'Germany',
					'Ghana',
					'Greece',
					'Grenada',
					'Guatemala',
					'Guinea',
					'Guinea-Bissau',
					'Guyana',
					'Haiti',
					'Honduras',
					'Hungary',
					'Iceland',
					'India',
					'Indonesia',
					'Iran',
					'Iraq',
					'Ireland',
					'Israel',
					'Italy',
					'Jamaica',
					'Japan',
					'Jordan',
					'Kazakhstan',
					'Kenya',
					'Kiribati',
					'Korea, North',
					'Korea, South',
					'Kuwait',
					'Kyrgyzstan',
					'Laos',
					'Latvia',
					'Lebanon',
					'Lesotho',
					'Liberia',
					'Libya',
					'Liechtenstein',
					'Lithuania',
					'Luxembourg',
					'Macedonia',
					'Madagascar',
					'Malawi',
					'Malaysia',
					'Maldives',
					'Mali',
					'Malta',
					'Marshall Islands',
					'Mauritania',
					'Mauritius',
					'Mexico',
					'Micronesia',
					'Moldova',
					'Monaco',
					'Mongolia',
					'Morocco',
					'Mozambique',
					'Myanmar',
					'Namibia',
					'Nauru',
					'Nepal',
					'Netherlands',
					'New Zealand',
					'Nicaragua',
					'Niger',
					'Nigeria',
					'Norway',
					'Oman',
					'Pakistan',
					'Palau',
					'Panama',
					'Papua New Guinea',
					'Paraguay',
					'Peru',
					'Philippines',
					'Poland',
					'Portugal',
					'Qatar',
					'Romania',
					'Russia',
					'Rwanda',
					'Saint Kitts and Nevis',
					'Saint Lucia',
					'Saint Vincent',
					'Samoa',
					'San Marino',
					'Sao Tome and Principe',
					'Saudi Arabia',
					'Senegal',
					'Serbia and Montenegro',
					'Seychelles',
					'Sierra Leone',
					'Singapore',
					'Slovakia',
					'Slovenia',
					'Solomon Islands',
					'Somalia',
					'South Africa',
					'Spain',
					'Sri Lanka',
					'Sudan',
					'Suriname',
					'Swaziland',
					'Sweden',
					'Switzerland',
					'Syria',
					'Taiwan',
					'Tajikistan',
					'Tanzania',
					'Thailand',
					'Togo',
					'Tonga',
					'Trinidad and Tobago',
					'Tunisia',
					'Turkey',
					'Turkmenistan',
					'Tuvalu',
					'Uganda',
					'Ukraine',
					'United Arab Emirates',
					'United Kingdom',
					'United States',
					'Uruguay',
					'Uzbekistan',
					'Vanuatu',
					'Vatican City',
					'Venezuela',
					'Vietnam',
					'Yemen',
					'Zambia',
					'Zimbabwe',
				);

				$i = 0;
				foreach ( $countries as $country ) {
					xprofile_insert_field(
						array(
							'field_group_id' => 1,
							'parent_id'      => $country_list_id,
							'type'           => 'option',
							'name'           => $country,
							'option_order'   => $i++,
						)
					);
				}
			}
		}
	}
endif;
