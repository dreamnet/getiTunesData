<?php

// Simple script for get JSON data from an iTunes store
// Made by dreamnet (GKI) on 2013-02-26 

function getiTunesData($id, $ret=false) { // cycles trough stores and returns JSON data array for given iTunes ID if found, else returns false

	$stores = array( // array with iTunes stores (that I know) and there country codes
		// Main english stores
		array("", "International"),				// International (English)
		array("us", "United States"),			// United States (English)
		array("gb", "United Kingdom"),			// United Kingdom (English)
		array("hk", "Hong Kong"),				// Hong Kong (English)
		array("au", "Australia"),				// Australia (English)
		array("ca", "Canada"),					// Canada (English)
		array("ie", "Ireland"),					// Ireland (English)
		// Europe stores
		array("de", "Germany"),					// Germany
		array("at", "Austria"),					// Austria
		array("ch", "Switzerland"),				// Switzerland
		array("fr", "France"),					// France
		array("cz", "Czech Republic"),			// Czech Republic
		// Latin America
		array("mx", "Mexico"),					// Mexico
		// Asian stores
		array("cn", "China"),					// China
		array("jp", "Japan"),					// Japan
		array("th", "Thailand"),				// Thailand
		array("ph", "Philippines"),				// Philippines
		array("tw", "Taiwan"),					// Taiwan
		array("vn", "Vietnam"),					// Vietnam
		// the rest of the world
		array("ag", "Antigua & Barbuda"),		// Antigua & Barbuda
		array("ai", "Anguilla"),				// Anguilla
		array("ar", "Argentina"),				// Argentina
		array("am", "Armenia"),					// Armenia
		array("ao", "Angola"),					// Angola
		array("dz", "Algeria"),					// Algeria
		array("az", "Azerbaijan"),				// Azerbaijan
		array("al", "Albania"),					// Albania
		array("bs", "Bahamas"),					// Bahamas
		array("bh", "Bahrain"),					// Bahrain
		array("bb", "Barbados"),				// Barbados
		array("be", "Belgium"),					// Belgium
		array("bd", "Bangladesh"),				// Bangladesh
		array("by", "Belarus"),					// Belarus
		array("bz", "Belize"),					// Belize
		array("bm", "Bermuda"),					// Bermuda
		array("bj", "Benin"),					// Benin
		array("bt", "Bhutan"),					// Bhutan
		array("bw", "Botswana"),				// Botswana
		array("bo", "Bolivia"),					// Bolivia
		array("br", "Brazil"),					// Brazil
		array("vg", "British Virgin Islands"),	// British Virgin Islands
		array("bn", "Brunei Darussalam"),		// Brunei Darussalam
		array("bg", "Bulgaria"),				// Bulgaria
		array("bf", "Burkina Faso"),			// Burkina Faso
		array("kh", "Cambodia"),				// Cambodia
		array("cv", "Cape Verde"),				// Cape Verde
		array("ky", "Cayman Islands"),			// Cayman Islands
		array("co", "Colombia"),				// Colombia
		array("cl", "Chile"),					// Chile
		array("td", "Chad"),					// Chad
		array("cr", "Costa Rica"),				// Costa Rica
		array("cg", "Congo"),					// Congo
		array("cy", "Cyprus"),					// Cyprus
		array("ci", "Cote D Ivoire"),			// Cote D Ivoire
		array("hr", "Croatia"),					// Croatia
		array("dm", "Dominica"),				// Dominica
		array("ec", "Ecuador"),					// Ecuador
		array("dk", "Denmark"),					// Denmark
		array("sv", "El Salvador"),				// El Salvador
		array("do", "Dominican Republic"),		// Dominican Rep.
		array("ee", "Estonia"),					// Estonia
		array("fj", "Fiji"),					// Fiji
		array("fi", "Finland"),					// Finland
		array("eg", "Egypt"),					// Egypt
		array("gm", "Gambia"),					// Gambia
		array("gd", "Grenada"),					// Grenada
		array("gr", "Greece"),					// Greece
		array("gh", "Ghana"),					// Ghana
		array("gw", "Guinea-Bissau"),			// Guinea-Bissau
		array("gt", "Guatemala"),				// Guatemala
		array("hu", "Hungary"),					// Hungary
		array("hn", "Honduras"),				// Honduras
		array("gy", "Guyana"),					// Guyana
		array("in", "India"),					// India
		array("id", "Indonesia"),				// Indonesia
		array("it", "Italy"),					// Italy
		array("il", "Israel"),					// Israel
		array("jm", "Jamaica"),					// Jamaica
		array("kz", "Kazakstan"),				// Kazakstan
		array("ke", "Kenya"),					// Kenya
		array("jo", "Jordan"),					// Jordan
		array("kg", "Kyrgyzstan"),				// Kyrgyzstan
		array("la", "Lao People's D.R."),		// Lao People's Democratic Republic
		array("kw", "Kuwait"),					// Kuwait
		array("lv", "Latvia"),					// Latvia
		array("lb", "Lebanon"),					// Lebanon
		array("lt", "Lithuania"),				// Lithuania
		array("lr", "Liberia"),					// Liberia
		array("is", "Iceland"),					// Iceland
		array("mo", "Macao"),					// Macao
		array("li", "Liechtenstein"),			// Liechtenstein
		array("lu", "Luxembourg"),				// Luxembourg
		array("my", "Malaysia"),				// Malaysia
		array("mg", "Madagascar"),				// Madagascar
		array("mk", "Macedonia"),				// Macedonia
		array("mt", "Malta"),					// Malta
		array("mw", "Malawi"),					// Malawi
		array("mv", "Maldives"),				// Maldives
		array("ml", "Mali"),					// Mali
		array("mu", "Mauritius"),				// Mauritius
		array("mn", "Mongolia"),				// Mongolia
		array("fm", "Micronesi"),				// Micronesi
		array("mr", "Mauritania"),				// Mauritania
		array("mz", "Mozambique"),				// Mozambique
		array("np", "Nepal"),					// Nepal
		array("ms", "Montserrat"),				// Montserrat
		array("nz", "New Zealand"),				// New Zealand
		array("ni", "Nicaragua"),				// Nicaragua
		array("na", "Namibia"),					// Namibia
		array("nl", "Netherlands"),				// Netherlands
		array("ng", "Nigeria"),					// Nigeria
		array("ne", "Niger"),					// Niger
		array("no", "Norway"),					// Norway
		array("pk", "Pakistan"),				// Pakistan
		array("om", "Oman"),					// Oman
		array("pa", "Panama"),					// Panama
		array("pg", "Papua New Guinea"),		// Papua New Guinea
		array("py", "Paraguay"),				// Paraguay
		array("pe", "Peru"),					// Peru
		array("pw", "Palau"),					// Palau
		array("pt", "Portugal"),				// Portugal
		array("qa", "Qatar"),					// Qatar
		array("kr", "Republic of Korea"),		// Republic of Korea
		array("md", "Republic of Moldova"),		// Republic of Moldova
		array("ru", "Russia"),					// Russia
		array("pl", "Poland"),					// Poland
		array("ro", "Romania"),					// Romania
		array("sa", "Saudi Arabia"),			// Saudi Arabia
		array("st", "Sao Tome and Principe"),	// Sao Tome and Principe
		array("rs", "Serbia"),					// Serbia
		array("sk", "Slovakia"),				// Slovakia
		array("sg", "Singapore"),				// Singapore
		array("sn", "Senegal"),					// Senegal
		array("es", "Spain"),					// Spain
		array("si", "Slovenia"),				// Slovenia
		array("za", "South Africa"),			// South Africa
		array("lk", "Sri Lanka"),				// Sri Lanka
		array("sc", "Seychelles"),				// Seychelles
		array("sb", "Solomon Islands"),			// Solomon Islands
		array("sr", "Suriname"),				// Suriname
		array("sz", "Swaziland"),				// Swaziland
		array("sl", "Sierra Leone"),			// Sierra Leone
		array("vc", "St. Vincent & T. G."),		// St. Vincent & The Grenadines
		array("se", "Sweden"),					// Sweden
		array("lc", "St. Lucia"),				// St. Lucia
		array("tj", "Tajikistan"),				// Tajikistan
		array("kn", "St. Kitts & Nevis"),		// St. Kitts & Nevis
		array("tz", "Tanzania"),				// Tanzania
		array("tt", "Trinidad & Tobago"),		// Trinidad & Tobago
		array("tn", "Tunisia"),					// Tunisia
		array("tr", "Turkey"),					// Turkey
		array("tm", "Turkmenistan"),			// Turkmenistan
		array("ug", "Uganda"),					// Uganda
		array("ua", "Ukraine"),					// Ukraine
		array("ae", "United Arab Emirates"),	// United Arab Emirates
		array("uz", "Uzbekistan"),				// Uzbekistan
		array("ve", "Venezuela"),				// Venezuela
		array("uy", "Uruguay"),					// Uruguay
		array("ye", "Yemen"),					// Yemen
		array("zw", "Zimbabwe"),				// Zimbabwe
		array("tc", "Turks & Caicos")			// Turks & Caicos
	);

	foreach ($stores as $store) // cycle trough stores array until one of them returns valid data
	{
		if($store != '') // the international iTunes store has no country code
		{
			$url = 'https://itunes.apple.com/'.$store[0].'/lookup?id='.$id;
		} else {
			$url = 'https://itunes.apple.com/lookup?id='.$id;
		}
		$json = file_get_contents($url, 0, null, null);
		$data = json_decode($json, true);
		if (($data['resultCount'] == 1) && ($data['results'][0]['kind'] == 'software')) // make sure we are getting data for an app
		{
			$ret = $data; break; // valid data found
		} else {
			$ret = false; // no valid data found
		}
	}
	return $ret;
}
