<?php

use App\Models\Category;
use App\Models\Genre;
use App\Models\Setting;
use Harimayco\Menu\Facades\Menu;
use App\Models\OrderDetails; 



if (!function_exists('purchaseDutation')) {
    function purchaseDutation()
    {
        return [
            '1' => '1 Month',
            '3' => '6 Months',
            '6' => '6 Months',
            '12' => '1 Year',
            '24' => '2 Years',
            '36' => '3 Years',

        ];
    }
}
if (!function_exists('cz_video_api')) {
    function cz_video_api($vid)
    {
        $key = 'XkQNPnMw2z1e3YfRrOsDNbEScbJqAJK6akwbNn70hOHd37pwvEf15LeUcidPVGX6';
        $vid = $vid;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://dev.vdocipher.com/api/videos/" . $vid . "/otp",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                "ttl" => 300,
            ]),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Apisecret " . $key,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}

if (!function_exists('cz_menu')) {
    function cz_menu($key)
    {
        $menuList = Menu::getByName($key);
        return $menuList;
    }
}
if (!function_exists('Movies')) {
    function Movies()
    {
        return $category_nav = Category::where('category_nature', 1)->where('page_show', 1)->where('deleted_at', null)->get();
    }
}
if (!function_exists('TVShow')) {
    function TVShow()
    {
        return $category_nav = Category::where('category_nature', 2)->where('page_show', 1)->where('deleted_at', null)->get();
    }
}
if (!function_exists('Gener')) {
    function Gener()
    {
        return $gener_nav = Genre::where('is_active', 'Yes')->get();
    }
}

if (!function_exists('CountMyCart')) {
    function CountMyCart()
    {
        $cartCollection = Cart::getContent();
        return $cartCollection->count();
    }
}
if (!function_exists('MyCart')) {
    function MyCart()
    {
        return $cartCollection = Cart::getContent();
    }
}
if (!function_exists('MyCartTotal')) {
    function MyCartTotal()
    {
        return $cartCollection = Cart::getTotal();
    }
}
if (!function_exists('MyBucket')) {
    function MyBucket($media_id, $member)
    {
        return $mdata['checkCart'] = OrderDetails::where('member_id', $member)
            ->where('media_id', $media_id)
            ->first();
    }
}
if (!function_exists('PayCurrency')) {
    function PayCurrency($val = null)
    {
        if ($val) {
            return $mdata['currency'] = 'BDT' . ' ' . $val;
        } else {
            return $mdata['currency'] = 'BDT' . ' ';
        }
    }
}
if (!function_exists('FreeTag')) {
    function FreeTag()
    {
        return 'FREE';
    }
}
if (!function_exists('UpcomingTag')) {
    function UpcomingTag()
    {
        return 'UPCOMING';
    }
}
if (!function_exists('MovieDeadline')) {
    function MovieDeadline()
    {
        return $deaddline = '+ 24 hours';
    }
}
if (!function_exists('CountryCode')) {
    function CountryCode()
    {
        return [
            [
                'contry_code'       => 'BN',
                'contry'            => 'Bangladesh',
                'phone_code'        => '88',
                'phone_code_length' => '11'
            ],
            [
                'contry_code'       => 'DZ',
                'contry'            => 'Algeria',
                'phone_code'        => '213',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'AFG',
                'contry'            => 'Afghanistan',
                'phone_code'        => '93',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ALB',
                'contry'            => 'Albania',
                'phone_code'        => '355',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'AS',
                'contry'            => 'American Samoa',
                'phone_code'        => '1684',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'AN',
                'contry'            => 'Andorra',
                'phone_code'        => '376',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'AGO',
                'contry'            => 'Angola',
                'phone_code'        => '244',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'AIA',
                'contry'            => 'Anguilla',
                'phone_code'        => '1264',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ATA',
                'contry'            => 'Antarctica',
                'phone_code'        => '672',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ATG',
                'contry'            => 'Antigua and Barbuda',
                'phone_code'        => '1268',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ARG',
                'contry'            => 'Argentina',
                'phone_code'        => '54',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ARM',
                'contry'            => 'Armenia',
                'phone_code'        => '374',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ABW',
                'contry'            => 'Aruba',
                'phone_code'        => '297',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'AUS',
                'contry'            => 'Australia',
                'phone_code'        => '61',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'AUT',
                'contry'            => 'Austria',
                'phone_code'        => '43',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'AZE',
                'contry'            => 'Azerbaijan',
                'phone_code'        => '994',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BS',
                'contry'            => 'Bahamas',
                'phone_code'        => '1242',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BH',
                'contry'            => 'Bahrain',
                'phone_code'        => '973',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BB',
                'contry'            => 'Barbados',
                'phone_code'        => '1246',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BY',
                'contry'            => 'Belarus',
                'phone_code'        => '375',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BE',
                'contry'            => 'Belgium ',
                'phone_code'        => '32',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BZ',
                'contry'            => 'Belize  ',
                'phone_code'        => '501',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BJ',
                'contry'            => 'Benin',
                'phone_code'        => '229',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BM',
                'contry'            => 'Bermuda',
                'phone_code'        => '1441',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BT',
                'contry'            => 'Bhutan',
                'phone_code'        => '975',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BO',
                'contry'            => 'Bolivia',
                'phone_code'        => '591',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BA',
                'contry'            => 'Bosnia Herzegovina',
                'phone_code'        => '387',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BW',
                'contry'            => 'Botswana',
                'phone_code'        => '267',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BR',
                'contry'            => 'Brazil ',
                'phone_code'        => '55',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BN',
                'contry'            => 'Brunei',
                'phone_code'        => '373',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BG',
                'contry'            => 'Bulgaria',
                'phone_code'        => '359',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BF',
                'contry'            => 'Burkina Faso',
                'phone_code'        => '226',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'BI',
                'contry'            => 'Burundi',
                'phone_code'        => '257',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'KH',
                'contry'            => 'Cambodia',
                'phone_code'        => '855',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CM',
                'contry'            => 'Cameroon',
                'phone_code'        => '237',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CA',
                'contry'            => 'Canada',
                'phone_code'        => '1',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CV',
                'contry'            => 'Cape Verde Islands',
                'phone_code'        => '238',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'KY',
                'contry'            => 'Cayman Islands',
                'phone_code'        => '1345',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CF',
                'contry'            => 'Central African Republic',
                'phone_code'        => '236',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CL',
                'contry'            => 'Chile',
                'phone_code'        => '56',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CN',
                'contry'            => 'China',
                'phone_code'        => '86',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CO',
                'contry'            => 'Colombia',
                'phone_code'        => '57',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CK',
                'contry'            => 'Cook Islands',
                'phone_code'        => '682',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CR',
                'contry'            => 'Costa Rica',
                'phone_code'        => '506',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CU',
                'contry'            => 'Cuba',
                'phone_code'        => '53',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CY',
                'contry'            => 'Cyprus North',
                'phone_code'        => '90392',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CY',
                'contry'            => 'Cyprus South',
                'phone_code'        => '357',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CZ',
                'contry'            => 'Czech Republic',
                'phone_code'        => '42',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'DK',
                'contry'            => 'Denmark',
                'phone_code'        => '45',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'DJ',
                'contry'            => 'Djibouti',
                'phone_code'        => '253',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'DM',
                'contry'            => 'Dominica',
                'phone_code'        => '1809',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'DO',
                'contry'            => 'Dominican Republic',
                'phone_code'        => '1809',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'EC',
                'contry'            => 'Ecuador',
                'phone_code'        => '593',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'EG',
                'contry'            => 'Egypt',
                'phone_code'        => '20',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SV',
                'contry'            => 'El Salvador',
                'phone_code'        => '503',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GQ',
                'contry'            => 'Equatorial Guinea',
                'phone_code'        => '240',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ER',
                'contry'            => 'Eritrea',
                'phone_code'        => '291',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'EE',
                'contry'            => 'Estonia',
                'phone_code'        => '372',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ET',
                'contry'            => 'Ethiopia',
                'phone_code'        => '251',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'FK',
                'contry'            => 'Falkland Islands',
                'phone_code'        => '500',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'FO',
                'contry'            => 'Faroe Islands',
                'phone_code'        => '298',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'FJ',
                'contry'            => 'Fiji',
                'phone_code'        => '679',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'FI',
                'contry'            => 'Finland',
                'phone_code'        => '358',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'FR',
                'contry'            => 'France',
                'phone_code'        => '33',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GF',
                'contry'            => 'French Guiana',
                'phone_code'        => '594',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'PF',
                'contry'            => 'French Polynesia',
                'phone_code'        => '689',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GA',
                'contry'            => 'Gabon',
                'phone_code'        => '241',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GM',
                'contry'            => 'Gambia',
                'phone_code'        => '220',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GE',
                'contry'            => 'Georgia',
                'phone_code'        => '7880',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'DE',
                'contry'            => 'Germany',
                'phone_code'        => '49',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GH',
                'contry'            => 'Ghana',
                'phone_code'        => '233',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GI',
                'contry'            => 'Gibraltar',
                'phone_code'        => '350',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GR',
                'contry'            => 'Greece',
                'phone_code'        => '30',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GL',
                'contry'            => 'Greenland',
                'phone_code'        => '299',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GD',
                'contry'            => 'Grenada',
                'phone_code'        => '1473',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GP',
                'contry'            => 'Guadeloupe',
                'phone_code'        => '590',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GU',
                'contry'            => 'Guam',
                'phone_code'        => '671',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GT',
                'contry'            => 'Guatemala',
                'phone_code'        => '502',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GN',
                'contry'            => 'Guinea',
                'phone_code'        => '224',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GW',
                'contry'            => 'Guinea - Bissau',
                'phone_code'        => '245',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GY',
                'contry'            => 'Guyana',
                'phone_code'        => '592',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'HT',
                'contry'            => 'Haiti',
                'phone_code'        => '509',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'HN',
                'contry'            => 'Honduras',
                'phone_code'        => '504',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'HK',
                'contry'            => 'Hong Kong',
                'phone_code'        => '852',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'HU',
                'contry'            => 'Hungary',
                'phone_code'        => '36',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'IS',
                'contry'            => 'Iceland',
                'phone_code'        => '354',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'IN',
                'contry'            => 'India',
                'phone_code'        => '91',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'PK',
                'contry'            => 'Pakistan',
                'phone_code'        => '92',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ID',
                'contry'            => 'Indonesia',
                'phone_code'        => '62',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'IR',
                'contry'            => 'Iran',
                'phone_code'        => '98',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'IQ',
                'contry'            => 'Iraq',
                'phone_code'        => '964',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'IE',
                'contry'            => 'Ireland',
                'phone_code'        => '353',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'IL',
                'contry'            => 'Israel',
                'phone_code'        => '972',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'IT',
                'contry'            => 'Italy',
                'phone_code'        => '39',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'JM',
                'contry'            => 'Jamaica',
                'phone_code'        => '1876',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'JP',
                'contry'            => 'Japan',
                'phone_code'        => '81',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'JO',
                'contry'            => 'Jordan',
                'phone_code'        => '962',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'KZ',
                'contry'            => 'Kazakhstan',
                'phone_code'        => '7',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'KE',
                'contry'            => 'Kenya',
                'phone_code'        => '254',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'KI',
                'contry'            => 'Kiribati',
                'phone_code'        => '686',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'KP',
                'contry'            => 'Korea North',
                'phone_code'        => '850',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'KR',
                'contry'            => 'Korea South',
                'phone_code'        => '82',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'KW',
                'contry'            => 'Kuwait',
                'phone_code'        => '965',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'KG',
                'contry'            => 'Kyrgyzstan',
                'phone_code'        => '996',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'LA',
                'contry'            => 'Laos',
                'phone_code'        => '856',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'LV',
                'contry'            => 'Latvia',
                'phone_code'        => '371',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'LB',
                'contry'            => 'Lebanon',
                'phone_code'        => '961',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'LS',
                'contry'            => 'Lesotho',
                'phone_code'        => '266',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'LR',
                'contry'            => 'Liberia',
                'phone_code'        => '271',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'LY',
                'contry'            => 'Libya',
                'phone_code'        => '218',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'LI',
                'contry'            => 'Liechtenstein',
                'phone_code'        => '417',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'LT',
                'contry'            => 'Lithuania',
                'phone_code'        => '370',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'LU',
                'contry'            => 'Luxembourg',
                'phone_code'        => '352',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MO',
                'contry'            => 'Macao',
                'phone_code'        => '853',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MK',
                'contry'            => 'Macedonia',
                'phone_code'        => '389',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MG',
                'contry'            => 'Madagascar',
                'phone_code'        => '261',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MW',
                'contry'            => 'Malawi',
                'phone_code'        => '265',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MY',
                'contry'            => 'Malaysia',
                'phone_code'        => '60',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MV',
                'contry'            => 'Maldives',
                'phone_code'        => '960',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ML',
                'contry'            => 'Mali',
                'phone_code'        => '223',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MT',
                'contry'            => 'Malta ',
                'phone_code'        => '356',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MH',
                'contry'            => 'Marshall Islands',
                'phone_code'        => '692',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MQ',
                'contry'            => 'Martinique',
                'phone_code'        => '596',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MR',
                'contry'            => 'Mauritania',
                'phone_code'        => '222',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'YT',
                'contry'            => 'Mayotte',
                'phone_code'        => '269',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MX',
                'contry'            => 'Mexico',
                'phone_code'        => '52',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'FM',
                'contry'            => 'Micronesia',
                'phone_code'        => '691',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MD',
                'contry'            => 'Moldova',
                'phone_code'        => '373',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MC',
                'contry'            => 'Monaco',
                'phone_code'        => '377',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MN',
                'contry'            => 'Mongolia',
                'phone_code'        => '976',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MS',
                'contry'            => 'Montserrat',
                'phone_code'        => '1664',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MA',
                'contry'            => 'Morocco',
                'phone_code'        => '212',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MZ',
                'contry'            => 'Mozambique',
                'phone_code'        => '258',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'MN',
                'contry'            => 'Myanmar',
                'phone_code'        => '95',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NA',
                'contry'            => 'Namibia',
                'phone_code'        => '264',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NR',
                'contry'            => 'Nauru',
                'phone_code'        => '674',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NP',
                'contry'            => 'Nepal',
                'phone_code'        => '977',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NL',
                'contry'            => 'Netherlands',
                'phone_code'        => '31',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NC',
                'contry'            => 'New Caledonia',
                'phone_code'        => '687',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NZ',
                'contry'            => 'New Zealand',
                'phone_code'        => '64',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NI',
                'contry'            => 'Nicaragua',
                'phone_code'        => '505',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NE',
                'contry'            => 'Nige',
                'phone_code'        => '227',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NG',
                'contry'            => 'Nigeria',
                'phone_code'        => '234',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NU',
                'contry'            => 'Niue',
                'phone_code'        => '683',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NF',
                'contry'            => 'Norfolk Islands',
                'phone_code'        => '672',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NP',
                'contry'            => 'Northern Marianas',
                'phone_code'        => '670',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'NO',
                'contry'            => 'Norway',
                'phone_code'        => '47',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'OM',
                'contry'            => 'Oman',
                'phone_code'        => '968',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'PW',
                'contry'            => 'Palau',
                'phone_code'        => '680',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'PA',
                'contry'            => 'Panama',
                'phone_code'        => '507',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'PG',
                'contry'            => 'Papua New Guinea',
                'phone_code'        => '675',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'PR',
                'contry'            => 'Puerto Rico',
                'phone_code'        => '1787',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'PY',
                'contry'            => 'Paraguay',
                'phone_code'        => '595',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'PE',
                'contry'            => 'Peru',
                'phone_code'        => '51',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'PH',
                'contry'            => 'Philippines ',
                'phone_code'        => '63',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'PL',
                'contry'            => 'Poland',
                'phone_code'        => '48',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'PT',
                'contry'            => 'Portugal',
                'phone_code'        => '351',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'RE',
                'contry'            => 'Reunion',
                'phone_code'        => '262',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'RO',
                'contry'            => 'Romania',
                'phone_code'        => '40',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'QA',
                'contry'            => 'Qatar',
                'phone_code'        => '974',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'RU',
                'contry'            => 'Russia',
                'phone_code'        => '7',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'RW',
                'contry'            => 'Rwanda',
                'phone_code'        => '250',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SM',
                'contry'            => 'San Marino',
                'phone_code'        => '378',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ST',
                'contry'            => 'Sao Tome &amp; Principe',
                'phone_code'        => '239',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SA',
                'contry'            => 'Saudi Arabia',
                'phone_code'        => '966',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SN',
                'contry'            => 'Senegal',
                'phone_code'        => '221',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CS',
                'contry'            => 'Serbia',
                'phone_code'        => '381',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SC',
                'contry'            => 'Seychelles',
                'phone_code'        => '248',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SL',
                'contry'            => 'Sierra Leone',
                'phone_code'        => '232',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SG',
                'contry'            => 'Singapore',
                'phone_code'        => '65',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SK',
                'contry'            => 'Slovak Republic',
                'phone_code'        => '421',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SI',
                'contry'            => 'Slovenia',
                'phone_code'        => '386',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SB',
                'contry'            => 'Solomon Islands',
                'phone_code'        => '677',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SO',
                'contry'            => 'Somalia',
                'phone_code'        => '252',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ZA',
                'contry'            => 'South Africa',
                'phone_code'        => '27',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ES',
                'contry'            => 'Spain',
                'phone_code'        => '34',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'LK',
                'contry'            => 'Sri Lanka',
                'phone_code'        => '94',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SH',
                'contry'            => 'St. Helena',
                'phone_code'        => '290',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'KN',
                'contry'            => 'St. Kitts',
                'phone_code'        => '1869',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SC',
                'contry'            => 'St. Lucia',
                'phone_code'        => '1758',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SD',
                'contry'            => 'Sudan',
                'phone_code'        => '249',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SR',
                'contry'            => 'Suriname',
                'phone_code'        => '597',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SZ',
                'contry'            => 'Swaziland',
                'phone_code'        => '268',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SE',
                'contry'            => 'Sweden',
                'phone_code'        => '46',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'CH',
                'contry'            => 'Switzerland',
                'phone_code'        => '41',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'SI',
                'contry'            => 'Syria',
                'phone_code'        => '963',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TW',
                'contry'            => 'Taiwan',
                'phone_code'        => '886',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TJ',
                'contry'            => 'Tajikstan',
                'phone_code'        => '7',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TH',
                'contry'            => 'Thailand',
                'phone_code'        => '66',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TG',
                'contry'            => 'Togo',
                'phone_code'        => '228',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TO',
                'contry'            => 'Tonga',
                'phone_code'        => '676',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TT',
                'contry'            => 'Trinidad &amp; Tobago',
                'phone_code'        => '1868',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TU',
                'contry'            => 'Tunisia ',
                'phone_code'        => '216',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TR',
                'contry'            => 'Turkey  ',
                'phone_code'        => '90',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TM',
                'contry'            => 'Turkmenistan',
                'phone_code'        => '7',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TM',
                'contry'            => 'Turkmenistan',
                'phone_code'        => '993',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TC',
                'contry'            => 'Turks &amp; Caicos Islands',
                'phone_code'        => '1649',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'TV',
                'contry'            => 'Tuvalu',
                'phone_code'        => '688',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'UG',
                'contry'            => 'Uganda',
                'phone_code'        => '256',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'GB',
                'contry'            => 'UK',
                'phone_code'        => '44',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'UA',
                'contry'            => 'Ukraine ',
                'phone_code'        => '380',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'AE',
                'contry'            => 'United Arab Emirates ',
                'phone_code'        => '971',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'UY',
                'contry'            => 'Uruguay',
                'phone_code'        => '598',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'US',
                'contry'            => 'USA',
                'phone_code'        => '1',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'UZ',
                'contry'            => 'Uzbekistan ',
                'phone_code'        => '7',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'VU',
                'contry'            => 'Vanuatu',
                'phone_code'        => '678',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'VA',
                'contry'            => 'Vatican City',
                'phone_code'        => '379',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'VE',
                'contry'            => 'Venezuela ',
                'phone_code'        => '58',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'VN',
                'contry'            => 'Vietnam',
                'phone_code'        => '84',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'VG',
                'contry'            => 'Virgin Islands - British',
                'phone_code'        => '84',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'VI',
                'contry'            => 'Virgin Islands - US',
                'phone_code'        => '84',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'WF',
                'contry'            => 'Wallis &amp; Futuna',
                'phone_code'        => '681',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'YE',
                'contry'            => 'Yemen (North)',
                'phone_code'        => '969',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'YE',
                'contry'            => 'Yemen (South)',
                'phone_code'        => '967',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ZM',
                'contry'            => 'Zambia ',
                'phone_code'        => '260',
                'phone_code_length' => null
            ],
            [
                'contry_code'       => 'ZW',
                'contry'            => 'Zimbabwe  ',
                'phone_code'        => '263',
                'phone_code_length' => null
            ]

        ];
    }
}
