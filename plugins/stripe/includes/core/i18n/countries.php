<?php
/**
 * Internationalization: Countries
 *
 * @package SimplePay\Core
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.0.0
 */

namespace SimplePay\Core\i18n;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns a list of country codes and countries.
 *
 * @since 3.9.0
 *
 * @return array $countries A list of the available countries
 */
function get_countries() {
	$countries = array(
		'US' => __( 'United States', 'stripe' ),
		'CA' => __( 'Canada', 'stripe' ),
		'GB' => __( 'United Kingdom', 'stripe' ),
		'AD' => __( 'Andorra', 'stripe' ),
		'AF' => __( 'Afghanistan', 'stripe' ),
		'AX' => __( '&#197;land Islands', 'stripe' ),
		'AL' => __( 'Albania', 'stripe' ),
		'DZ' => __( 'Algeria', 'stripe' ),
		'AS' => __( 'American Samoa', 'stripe' ),
		'AD' => __( 'Andorra', 'stripe' ),
		'AO' => __( 'Angola', 'stripe' ),
		'AI' => __( 'Anguilla', 'stripe' ),
		'AQ' => __( 'Antarctica', 'stripe' ),
		'AG' => __( 'Antigua and Barbuda', 'stripe' ),
		'AR' => __( 'Argentina', 'stripe' ),
		'AM' => __( 'Armenia', 'stripe' ),
		'AW' => __( 'Aruba', 'stripe' ),
		'AU' => __( 'Australia', 'stripe' ),
		'AT' => __( 'Austria', 'stripe' ),
		'AZ' => __( 'Azerbaijan', 'stripe' ),
		'BS' => __( 'Bahamas', 'stripe' ),
		'BH' => __( 'Bahrain', 'stripe' ),
		'BD' => __( 'Bangladesh', 'stripe' ),
		'BB' => __( 'Barbados', 'stripe' ),
		'BY' => __( 'Belarus', 'stripe' ),
		'BE' => __( 'Belgium', 'stripe' ),
		'BZ' => __( 'Belize', 'stripe' ),
		'BJ' => __( 'Benin', 'stripe' ),
		'BM' => __( 'Bermuda', 'stripe' ),
		'BT' => __( 'Bhutan', 'stripe' ),
		'BO' => __( 'Bolivia', 'stripe' ),
		'BQ' => __( 'Bonaire, Saint Eustatius and Saba', 'stripe' ),
		'BA' => __( 'Bosnia and Herzegovina', 'stripe' ),
		'BW' => __( 'Botswana', 'stripe' ),
		'BV' => __( 'Bouvet Island', 'stripe' ),
		'BR' => __( 'Brazil', 'stripe' ),
		'IO' => __( 'British Indian Ocean Territory', 'stripe' ),
		'BN' => __( 'Brunei Darrussalam', 'stripe' ),
		'BG' => __( 'Bulgaria', 'stripe' ),
		'BF' => __( 'Burkina Faso', 'stripe' ),
		'BI' => __( 'Burundi', 'stripe' ),
		'KH' => __( 'Cambodia', 'stripe' ),
		'CM' => __( 'Cameroon', 'stripe' ),
		'CV' => __( 'Cape Verde', 'stripe' ),
		'KY' => __( 'Cayman Islands', 'stripe' ),
		'CF' => __( 'Central African Republic', 'stripe' ),
		'TD' => __( 'Chad', 'stripe' ),
		'CL' => __( 'Chile', 'stripe' ),
		'CN' => __( 'China', 'stripe' ),
		'CX' => __( 'Christmas Island', 'stripe' ),
		'CC' => __( 'Cocos Islands', 'stripe' ),
		'CO' => __( 'Colombia', 'stripe' ),
		'KM' => __( 'Comoros', 'stripe' ),
		'CD' => __( 'Congo, Democratic People\'s Republic', 'stripe' ),
		'CG' => __( 'Congo, Republic of', 'stripe' ),
		'CK' => __( 'Cook Islands', 'stripe' ),
		'CR' => __( 'Costa Rica', 'stripe' ),
		'CI' => __( 'Cote d\'Ivoire', 'stripe' ),
		'HR' => __( 'Croatia/Hrvatska', 'stripe' ),
		'CU' => __( 'Cuba', 'stripe' ),
		'CW' => __( 'Cura&Ccedil;ao', 'stripe' ),
		'CY' => __( 'Cyprus', 'stripe' ),
		'CZ' => __( 'Czech Republic', 'stripe' ),
		'DK' => __( 'Denmark', 'stripe' ),
		'DJ' => __( 'Djibouti', 'stripe' ),
		'DM' => __( 'Dominica', 'stripe' ),
		'DO' => __( 'Dominican Republic', 'stripe' ),
		'TP' => __( 'East Timor', 'stripe' ),
		'EC' => __( 'Ecuador', 'stripe' ),
		'EG' => __( 'Egypt', 'stripe' ),
		'GQ' => __( 'Equatorial Guinea', 'stripe' ),
		'SV' => __( 'El Salvador', 'stripe' ),
		'ER' => __( 'Eritrea', 'stripe' ),
		'EE' => __( 'Estonia', 'stripe' ),
		'ET' => __( 'Ethiopia', 'stripe' ),
		'FK' => __( 'Falkland Islands', 'stripe' ),
		'FO' => __( 'Faroe Islands', 'stripe' ),
		'FJ' => __( 'Fiji', 'stripe' ),
		'FI' => __( 'Finland', 'stripe' ),
		'FR' => __( 'France', 'stripe' ),
		'GF' => __( 'French Guiana', 'stripe' ),
		'PF' => __( 'French Polynesia', 'stripe' ),
		'TF' => __( 'French Southern Territories', 'stripe' ),
		'GA' => __( 'Gabon', 'stripe' ),
		'GM' => __( 'Gambia', 'stripe' ),
		'GE' => __( 'Georgia', 'stripe' ),
		'DE' => __( 'Germany', 'stripe' ),
		'GR' => __( 'Greece', 'stripe' ),
		'GH' => __( 'Ghana', 'stripe' ),
		'GI' => __( 'Gibraltar', 'stripe' ),
		'GL' => __( 'Greenland', 'stripe' ),
		'GD' => __( 'Grenada', 'stripe' ),
		'GP' => __( 'Guadeloupe', 'stripe' ),
		'GU' => __( 'Guam', 'stripe' ),
		'GT' => __( 'Guatemala', 'stripe' ),
		'GG' => __( 'Guernsey', 'stripe' ),
		'GN' => __( 'Guinea', 'stripe' ),
		'GW' => __( 'Guinea-Bissau', 'stripe' ),
		'GY' => __( 'Guyana', 'stripe' ),
		'HT' => __( 'Haiti', 'stripe' ),
		'HM' => __( 'Heard and McDonald Islands', 'stripe' ),
		'VA' => __( 'Holy See (City Vatican State)', 'stripe' ),
		'HN' => __( 'Honduras', 'stripe' ),
		'HK' => __( 'Hong Kong', 'stripe' ),
		'HU' => __( 'Hungary', 'stripe' ),
		'IS' => __( 'Iceland', 'stripe' ),
		'IN' => __( 'India', 'stripe' ),
		'ID' => __( 'Indonesia', 'stripe' ),
		'IR' => __( 'Iran', 'stripe' ),
		'IQ' => __( 'Iraq', 'stripe' ),
		'IE' => __( 'Ireland', 'stripe' ),
		'IM' => __( 'Isle of Man', 'stripe' ),
		'IL' => __( 'Israel', 'stripe' ),
		'IT' => __( 'Italy', 'stripe' ),
		'JM' => __( 'Jamaica', 'stripe' ),
		'JP' => __( 'Japan', 'stripe' ),
		'JE' => __( 'Jersey', 'stripe' ),
		'JO' => __( 'Jordan', 'stripe' ),
		'KZ' => __( 'Kazakhstan', 'stripe' ),
		'KE' => __( 'Kenya', 'stripe' ),
		'KI' => __( 'Kiribati', 'stripe' ),
		'KW' => __( 'Kuwait', 'stripe' ),
		'KG' => __( 'Kyrgyzstan', 'stripe' ),
		'LA' => __( 'Lao People\'s Democratic Republic', 'stripe' ),
		'LV' => __( 'Latvia', 'stripe' ),
		'LB' => __( 'Lebanon', 'stripe' ),
		'LS' => __( 'Lesotho', 'stripe' ),
		'LR' => __( 'Liberia', 'stripe' ),
		'LY' => __( 'Libyan Arab Jamahiriya', 'stripe' ),
		'LI' => __( 'Liechtenstein', 'stripe' ),
		'LT' => __( 'Lithuania', 'stripe' ),
		'LU' => __( 'Luxembourg', 'stripe' ),
		'MO' => __( 'Macau', 'stripe' ),
		'MK' => __( 'North Macedonia', 'stripe' ),
		'MG' => __( 'Madagascar', 'stripe' ),
		'MW' => __( 'Malawi', 'stripe' ),
		'MY' => __( 'Malaysia', 'stripe' ),
		'MV' => __( 'Maldives', 'stripe' ),
		'ML' => __( 'Mali', 'stripe' ),
		'MT' => __( 'Malta', 'stripe' ),
		'MH' => __( 'Marshall Islands', 'stripe' ),
		'MQ' => __( 'Martinique', 'stripe' ),
		'MR' => __( 'Mauritania', 'stripe' ),
		'MU' => __( 'Mauritius', 'stripe' ),
		'YT' => __( 'Mayotte', 'stripe' ),
		'MX' => __( 'Mexico', 'stripe' ),
		'FM' => __( 'Micronesia', 'stripe' ),
		'MD' => __( 'Moldova, Republic of', 'stripe' ),
		'MC' => __( 'Monaco', 'stripe' ),
		'MN' => __( 'Mongolia', 'stripe' ),
		'ME' => __( 'Montenegro', 'stripe' ),
		'MS' => __( 'Montserrat', 'stripe' ),
		'MA' => __( 'Morocco', 'stripe' ),
		'MZ' => __( 'Mozambique', 'stripe' ),
		'MM' => __( 'Myanmar', 'stripe' ),
		'NA' => __( 'Namibia', 'stripe' ),
		'NR' => __( 'Nauru', 'stripe' ),
		'NP' => __( 'Nepal', 'stripe' ),
		'NL' => __( 'Netherlands', 'stripe' ),
		'AN' => __( 'Netherlands Antilles', 'stripe' ),
		'NC' => __( 'New Caledonia', 'stripe' ),
		'NZ' => __( 'New Zealand', 'stripe' ),
		'NI' => __( 'Nicaragua', 'stripe' ),
		'NE' => __( 'Niger', 'stripe' ),
		'NG' => __( 'Nigeria', 'stripe' ),
		'NU' => __( 'Niue', 'stripe' ),
		'NF' => __( 'Norfolk Island', 'stripe' ),
		'KP' => __( 'North Korea', 'stripe' ),
		'MP' => __( 'Northern Mariana Islands', 'stripe' ),
		'NO' => __( 'Norway', 'stripe' ),
		'OM' => __( 'Oman', 'stripe' ),
		'PK' => __( 'Pakistan', 'stripe' ),
		'PW' => __( 'Palau', 'stripe' ),
		'PS' => __( 'Palestinian Territories', 'stripe' ),
		'PA' => __( 'Panama', 'stripe' ),
		'PG' => __( 'Papua New Guinea', 'stripe' ),
		'PY' => __( 'Paraguay', 'stripe' ),
		'PE' => __( 'Peru', 'stripe' ),
		'PH' => __( 'Philippines', 'stripe' ),
		'PN' => __( 'Pitcairn Island', 'stripe' ),
		'PL' => __( 'Poland', 'stripe' ),
		'PT' => __( 'Portugal', 'stripe' ),
		'PR' => __( 'Puerto Rico', 'stripe' ),
		'QA' => __( 'Qatar', 'stripe' ),
		'XK' => __( 'Republic of Kosovo', 'stripe' ),
		'RE' => __( 'Reunion Island', 'stripe' ),
		'RO' => __( 'Romania', 'stripe' ),
		'RU' => __( 'Russian Federation', 'stripe' ),
		'RW' => __( 'Rwanda', 'stripe' ),
		'BL' => __( 'Saint Barth&eacute;lemy', 'stripe' ),
		'SH' => __( 'Saint Helena', 'stripe' ),
		'KN' => __( 'Saint Kitts and Nevis', 'stripe' ),
		'LC' => __( 'Saint Lucia', 'stripe' ),
		'MF' => __( 'Saint Martin (French)', 'stripe' ),
		'SX' => __( 'Saint Martin (Dutch)', 'stripe' ),
		'PM' => __( 'Saint Pierre and Miquelon', 'stripe' ),
		'VC' => __( 'Saint Vincent and the Grenadines', 'stripe' ),
		'SM' => __( 'San Marino', 'stripe' ),
		'ST' => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'stripe' ),
		'SA' => __( 'Saudi Arabia', 'stripe' ),
		'SN' => __( 'Senegal', 'stripe' ),
		'RS' => __( 'Serbia', 'stripe' ),
		'SC' => __( 'Seychelles', 'stripe' ),
		'SL' => __( 'Sierra Leone', 'stripe' ),
		'SG' => __( 'Singapore', 'stripe' ),
		'SK' => __( 'Slovakia', 'stripe' ),
		'SI' => __( 'Slovenia', 'stripe' ),
		'SB' => __( 'Solomon Islands', 'stripe' ),
		'SO' => __( 'Somalia', 'stripe' ),
		'ZA' => __( 'South Africa', 'stripe' ),
		'GS' => __( 'South Georgia', 'stripe' ),
		'KR' => __( 'South Korea', 'stripe' ),
		'SS' => __( 'South Sudan', 'stripe' ),
		'ES' => __( 'Spain', 'stripe' ),
		'LK' => __( 'Sri Lanka', 'stripe' ),
		'SD' => __( 'Sudan', 'stripe' ),
		'SR' => __( 'Suriname', 'stripe' ),
		'SJ' => __( 'Svalbard and Jan Mayen Islands', 'stripe' ),
		'SZ' => __( 'Swaziland', 'stripe' ),
		'SE' => __( 'Sweden', 'stripe' ),
		'CH' => __( 'Switzerland', 'stripe' ),
		'SY' => __( 'Syrian Arab Republic', 'stripe' ),
		'TA' => __( 'Tajikistan', 'stripe' ),
		'TW' => __( 'Taiwan', 'stripe' ),
		'TJ' => __( 'Tajikistan', 'stripe' ),
		'TZ' => __( 'Tanzania', 'stripe' ),
		'TH' => __( 'Thailand', 'stripe' ),
		'TL' => __( 'Timor-Leste', 'stripe' ),
		'TG' => __( 'Togo', 'stripe' ),
		'TK' => __( 'Tokelau', 'stripe' ),
		'TO' => __( 'Tonga', 'stripe' ),
		'TT' => __( 'Trinidad and Tobago', 'stripe' ),
		'TN' => __( 'Tunisia', 'stripe' ),
		'TR' => __( 'Turkey', 'stripe' ),
		'TM' => __( 'Turkmenistan', 'stripe' ),
		'TC' => __( 'Turks and Caicos Islands', 'stripe' ),
		'TV' => __( 'Tuvalu', 'stripe' ),
		'UG' => __( 'Uganda', 'stripe' ),
		'UA' => __( 'Ukraine', 'stripe' ),
		'AE' => __( 'United Arab Emirates', 'stripe' ),
		'UY' => __( 'Uruguay', 'stripe' ),
		'UM' => __( 'US Minor Outlying Islands', 'stripe' ),
		'UZ' => __( 'Uzbekistan', 'stripe' ),
		'VU' => __( 'Vanuatu', 'stripe' ),
		'VE' => __( 'Venezuela', 'stripe' ),
		'VN' => __( 'Vietnam', 'stripe' ),
		'VG' => __( 'Virgin Islands (British)', 'stripe' ),
		'VI' => __( 'Virgin Islands (USA)', 'stripe' ),
		'WF' => __( 'Wallis and Futuna Islands', 'stripe' ),
		'EH' => __( 'Western Sahara', 'stripe' ),
		'WS' => __( 'Western Samoa', 'stripe' ),
		'YE' => __( 'Yemen', 'stripe' ),
		'ZM' => __( 'Zambia', 'stripe' ),
		'ZW' => __( 'Zimbabwe', 'stripe' ),
	);

	return apply_filters( 'simpay_countries', $countries );
}
