<?php

// CHANGE THB SYMBOL
add_filter('woocommerce_currency_symbol', 'plant_woo_thb', 10, 2);
function plant_woo_thb($currency_symbol, $currency)
{
    switch ($currency) {
        case 'THB':
            $currency_symbol = 'บาท';
            break;
    }
    return $currency_symbol;
}

// THB SYMBOL POSITION
add_filter('woocommerce_price_format', 'plant_woo_thb_position', 999, 2);
function plant_woo_thb_position($format, $currency_pos)
{
    $format = '%2$s&nbsp;%1$s';
    return $format;
}

// REQUIRE THAI ADDRESS 2
function plant_address_2($address_fields)
{
    $address_fields['address_2']['required'] = true;
    return $address_fields;
}
if (get_theme_mod('shop_th_style', true)) {
    add_filter('woocommerce_default_address_fields', 'plant_address_2');
}

// THAI PROVINCE
add_filter('woocommerce_states', 'plant_woo_states');
function plant_woo_states($states)
{
    $states['TH'] = [
        'TH-81' => 'กระบี่',
        'TH-10' => 'กรุงเทพมหานคร',
        'TH-71' => 'กาญจนบุรี',
        'TH-46' => 'กาฬสินธุ์',
        'TH-62' => 'กำแพงเพชร',
        'TH-40' => 'ขอนแก่น',
        'TH-22' => 'จันทบุรี',
        'TH-24' => 'ฉะเชิงเทรา',
        'TH-20' => 'ชลบุรี',
        'TH-18' => 'ชัยนาท',
        'TH-36' => 'ชัยภูมิ',
        'TH-86' => 'ชุมพร',
        'TH-57' => 'เชียงราย',
        'TH-50' => 'เชียงใหม่',
        'TH-92' => 'ตรัง',
        'TH-23' => 'ตราด',
        'TH-63' => 'ตาก',
        'TH-26' => 'นครนายก',
        'TH-73' => 'นครปฐม',
        'TH-48' => 'นครพนม',
        'TH-30' => 'นครราชสีมา',
        'TH-80' => 'นครศรีธรรมราช',
        'TH-60' => 'นครสวรรค์',
        'TH-12' => 'นนทบุรี',
        'TH-96' => 'นราธิวาส',
        'TH-55' => 'น่าน',
        'TH-38' => 'บึงกาฬ',
        'TH-31' => 'บุรีรัมย์',
        'TH-13' => 'ปทุมธานี',
        'TH-77' => 'ประจวบคีรีขันธ์',
        'TH-25' => 'ปราจีนบุรี',
        'TH-94' => 'ปัตตานี',
        'TH-14' => 'พระนครศรีอยุธยา',
        'TH-56' => 'พะเยา',
        'TH-82' => 'พังงา',
        'TH-93' => 'พัทลุง',
        'TH-66' => 'พิจิตร',
        'TH-65' => 'พิษณุโลก',
        'TH-76' => 'เพชรบุรี',
        'TH-67' => 'เพชรบูรณ์',
        'TH-54' => 'แพร่',
        'TH-83' => 'ภูเก็ต',
        'TH-44' => 'มหาสารคาม',
        'TH-49' => 'มุกดาหาร',
        'TH-58' => 'แม่ฮ่องสอน',
        'TH-35' => 'ยโสธร',
        'TH-95' => 'ยะลา',
        'TH-45' => 'ร้อยเอ็ด',
        'TH-85' => 'ระนอง',
        'TH-21' => 'ระยอง',
        'TH-70' => 'ราชบุรี',
        'TH-16' => 'ลพบุรี',
        'TH-52' => 'ลำปาง',
        'TH-51' => 'ลำพูน',
        'TH-42' => 'เลย',
        'TH-33' => 'ศรีสะเกษ',
        'TH-47' => 'สกลนคร',
        'TH-90' => 'สงขลา',
        'TH-91' => 'สตูล',
        'TH-11' => 'สมุทรปราการ',
        'TH-75' => 'สมุทรสงคราม',
        'TH-74' => 'สมุทรสาคร',
        'TH-27' => 'สระแก้ว',
        'TH-19' => 'สระบุรี',
        'TH-17' => 'สิงห์บุรี',
        'TH-64' => 'สุโขทัย',
        'TH-72' => 'สุพรรณบุรี',
        'TH-84' => 'สุราษฎร์ธานี',
        'TH-32' => 'สุรินทร์',
        'TH-43' => 'หนองคาย',
        'TH-39' => 'หนองบัวลำภู',
        'TH-15' => 'อ่างทอง',
        'TH-37' => 'อำนาจเจริญ',
        'TH-41' => 'อุดรธานี',
        'TH-53' => 'อุตรดิตถ์',
        'TH-61' => 'อุทัยธานี',
        'TH-34' => 'อุบลราชธานี',
    ];
    return $states;
}
