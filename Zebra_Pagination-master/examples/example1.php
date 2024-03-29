<!doctype html>

<html>

    <head>

        <title>Zebra_Pagination, array example</title>

        <meta charset="utf-8">
<!-- requiriendo recursos de reset.css -->
        <link rel="stylesheet" href="reset.css" type="text/css">
<!-- requiriendo recursos de style.css -->
        <link rel="stylesheet" href="style.css" type="text/css">
<!-- requiriendo recursos de zebra_pagination.css -->
        <link rel="stylesheet" href="../public/css/zebra_pagination.css" type="text/css">

    </head>

    <body>

        <h2>Zebra_Pagination, array example</h2>

        <p>Show next/previous page links on the <a href="example1.php?navigation_position=left">left</a> or on the
        <a href="example1.php?navigation_position=right">right</a>. Or revert to the <a href="example1.php">default style</a></p>

        <?php

        // let's paginate data from an array...
        $countries = array(

            'Afghanistan', 'Aland Islands', 'Albania', 'Algeria', 'American Samoa', 'Andorra', 'Angola', 'Anguilla', 'Antarctica',
            'Antigua And Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain',
            'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnia And
            Herzegowina', 'Botswana', 'Bouvet Island', 'Brazil', 'British Indian Ocean Territory', 'Brunei Darussalam', 'Bulgaria',
            'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde', 'Cayman Islands', 'Central African
            Republic', 'Chad', 'Chile', 'China', 'Christmas Island', 'Cocos (Keeling) Islands', 'Colombia', 'Comoros', 'Congo',
            'Congo, The Democratic Republic Of The', 'Cook Islands', 'Costa Rica', 'Cote D\'Ivoire', 'Croatia', 'Cuba', 'Cyprus',
            'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador',
            'Equatorial Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Falkland Islands (Malvinas)', 'Faroe Islands', 'Fiji',
            'Finland', 'France', 'French Guiana', 'French Polynesia', 'French Southern Territories', 'Gabon', 'Gambia', 'Georgia',
            'Germany', 'Ghana', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guam', 'Guatemala', 'Guinea',
            'Guinea-Bissau', 'Guyana', 'Haiti', 'Heard And Mc Donald Islands', 'Holy See (Vatican City State)', 'Honduras', 'Hong
            Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran, Islamic Republic Of', 'Iraq', 'Ireland', 'Israel', 'Italy',
            'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Korea, Democratic People\'S Republic Of', 'Korea,
            Republic Of', 'Kuwait', 'Kyrgyzstan', 'Lao People\'S Democratic Republic', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia',
            'Libyan Arab Jamahiriya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macau', 'Macedonia, The Former Yugoslav
            Republic Of', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Martinique',
            'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Micronesia, Federated States Of', 'Moldova, Republic Of', 'Monaco',
            'Mongolia', 'Montserrat', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'Netherlands
            Antilles', 'New Caledonia', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Niue', 'Norfolk Island', 'Northern
            Mariana Islands', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestinian Territory, Occupied', 'Panama', 'Papua New
            Guinea', 'Paraguay', 'Peru', 'Philippines', 'Pitcairn', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Reunion',
            'Romania', 'Russian Federation', 'Rwanda', 'Saint Helena', 'Saint Kitts And Nevis', 'Saint Lucia', 'Saint Pierre And
            Miquelon', 'Saint Vincent And The Grenadines', 'Samoa', 'San Marino', 'Sao Tome And Principe', 'Saudi Arabia',
            'Senegal', 'Serbia And Montenegro', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon
            Islands', 'Somalia', 'South Africa', 'South Georgia And The South Sandwich Islands', 'Spain', 'Sri Lanka', 'Sudan',
            'Suriname', 'Svalbard And Jan Mayen Islands', 'Swaziland', 'Sweden', 'Switzerland', 'Syrian Arab Republic', 'Taiwan,
            Province Of China', 'Tajikistan', 'Tanzania, United Republic Of', 'Thailand', 'Timor-Leste', 'Togo', 'Tokelau',
            'Tonga', 'Trinidad And Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Turks And Caicos Islands', 'Tuvalu', 'Uganda',
            'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'United States Minor Outlying Islands',
            'Uruguay', 'Uzbekistan', 'Vanuatu', 'Venezuela', 'Viet Nam', 'Virgin Islands, British', 'Virgin Islands, U.S.',
            'Wallis And Futuna', 'Western Sahara', 'Yemen', 'Zambia', 'Zimbabwe',

        );

        //cuantos records necesita mostrar en la página
        $records_per_page = 10;

        // incluendo clase de paginacion
        require '../Zebra_Pagination.php';

        // instanciando el objeto de paginacion
        $pagination = new Zebra_Pagination();

        // asignando la posicion de siguiente link de la pagina
        $pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');

        // el numero total de records es el numero tottal en el arreglo
        $pagination->records(count($countries));

        // records per page
        $pagination->records_per_page($records_per_page);

        // here's the magick: we need to display *only* the records for the current page
        $countries = array_slice(
            $countries,                                             //  from the original array we extract
            (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records
            $records_per_page                                       //  this many records
        );

        ?>

        <table class="countries" border="1">

        	<tr><th>Country</th></tr>

            <?php foreach ($countries as $index => $country):?>

            <tr<?php echo $index % 2 ? ' class="even"' : ''?>>
                <td><?php echo $country?></td>
            </tr>

            <?php endforeach?>

        </table>

        <?php

        // renderizando links de paginacion
        $pagination->render();

        ?>

    </body>

</html>
