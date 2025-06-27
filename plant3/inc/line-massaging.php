<?php

/**
 * Send Line Massaging
 */
function sp_send_line_messaging($data = [], $page_id = '')
{
    if(!$page_id) {
        $page_id = get_the_ID();
    }
    $token 		= get_field('access_token', $page_id);
    $group_id 	= get_field('group_id', $page_id);
    $banner_id 	= get_field('cover_d', $page_id) ? get_field('cover_d', $page_id) : (get_field('logo', $page_id) ? get_field('logo', $page_id) : '');

    $send_data = [
        "to" => $group_id,
        "messages" => [
            [
                "type" => "flex",
                "altText" => "แจ้งเตือนรายการชำระเงิน",
                "contents" => [ 
                    "type" => "bubble",
                ]
            ]
        ]
    ];
    
    if($banner_id) {
        $banner_url = wp_get_attachment_url( $banner_id );
        $send_data['messages'][0]['contents']['hero'] = [
            "type" => "image",
            "url" => $banner_url,
            "size" => "full",
            "aspectRatio" => "20:13",
            "aspectMode" => "cover",
        ];
    }

    $send_data['messages'][0]['contents']['body'] = [
        "type" => "box",
        "layout" => "vertical",
        "contents" => $data
    ];

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token
    ];
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.line.me/v2/bot/message/push',
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => json_encode($send_data),
        CURLOPT_HTTPHEADER => $headers,
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
}



/**
 * Send Line after submission
 */

add_action('forminator_form_after_handle_submit', 'sp_send_line', 10, 2);
add_action('forminator_form_after_save_entry', 'sp_send_line', 10, 2);
function sp_send_line($form_id, $response)
{

    if (!$response['success']) {
        return;
    }

    // เริ่มเก็บข้อมูล
    $vars 		= filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $page_id 	= $vars['page_id'];

    $fields 	= explode(',', get_field('fields', $page_id));
    $fields 	= array_map('trim', $fields);
    $labels 	= explode(',', get_field('labels', $page_id));
    $labels 	= array_map('trim', $labels);

    if (!$fields) {
        $fields = ['textarea-1', 'radio-1', 'name-1', 'email-1', 'number-2', 'upload-1', 'textarea-2'];
    }
    if (!$labels) {
        $labels = ['คำสั่งซื้อ', 'ช่องทางการชำระเงิน', 'ชื่อ', 'อีเมล', 'เบอร์โทร', 'สลิป', 'ที่อยู่'];
    }

    $entries = Forminator_API::get_entries($form_id);
    $count = 0;

    $data = [];
    $webhook_data = [];
    foreach($entries as $entry):

        $count++;
        $meta = (array) $entry->meta_data;

        // เช็คว่าข้อมูลที่ Post ตรงกับรายการสั่งซื้อใน Entry นี้
        if ($vars['email-1'] == $meta['email-1']['value'] &&  $vars['number-2'] == $meta['number-2']['value']) {
            $data[] = [
                "type" => "text",
                "text" => "Order #" . $entry->entry_id,
                "weight" => "bold",
                "size" => "lg",
                "color" => "#333333",
                "margin" => "sm"
            ];

            $webhook_data['entry_id'] = $entry->entry_id;
            
            foreach($meta as $key => $value) {
                if(in_array($key, $fields)) {
                    $label = $labels[array_search($key, $fields)];
                    if (isset($key)) {
                        if($key != 'upload-1') {
                            // ไม่ใช่ไฟล์
                            $data[] =  [
                                "type" => "box",
                                "layout" => "baseline",
                                "margin" => "md",
                                "contents" => [
                                    [
                                        "type" => "text",
                                        "text" => $label .": " . $value['value'],
                                        "color" => "#666666",
                                        "size" => "sm",
                                        "wrap" => true,
                                    ]
                                ]
                            ];

                            $webhook_data[$key] = $value['value'];
                        } else {
                            // เป้นไฟล์แนบ
                            $file_path =  $value['value']['file']['file_path'];
                            $file_info = finfo_open(FILEINFO_MIME_TYPE);
                            $file_type = finfo_file($file_info, $file_path);
                            finfo_close($file_info);
                            
                            $image_url = $value['value']['file']['file_url'];
                            if ($file_type === 'image/jpeg' || $file_type === 'image/jpg' || $file_type === 'image/png') {
                                // เป็นรูปภาพ
                                $data[] =  [
                                    "type" => "separator",
                                    "margin" => "xl"
                                ];
                                $data[] = [
                                    "type" => "image",
                                    "url" => $image_url,
                                    "size" => "full",
                                    "margin" => "md",
                                    "aspectMode" => "cover",
                                ];
                                $data[] =  [
                                    "type" => "separator",
                                    "margin" => "xl"
                                ];

                                $webhook_data[$key] = $image_url;
                            } else {
                                // เป็นไฟล์ชนิดอื่น เช่น PDF
                                $data[] = [
                                    "type" => "box",
                                    "layout" => "baseline",
                                    "margin" => "md",
                                    "contents" => [
                                        [
                                            "type" => "text",
                                            "text" => $label .": " . $image_url,
                                            "color" => "#666666",
                                            "size" => "sm",
                                            "wrap" => true,
                                        ]
                                    ]   
                                ];

                                $webhook_data[$key] = $image_url;
                            }
                        }
                    }
                }
            }
            break;
        }

        // ค้นหาแค่ 5 รายการล่าสุดเท่านั้น เพื่อไม่ให้ระบบโหลดเกินไป
        if($count > 5) {
            break;
        }    
    endforeach;

    // ส่งไลน์
    sp_send_line_messaging($data, $page_id); 

    // ส่ง Webhook
    $webhook_enabled = get_field('enable_webhook', $page_id);   
    $webhook_url = get_field('webhook_url', $page_id);

    if($webhook_enabled && $webhook_url) {
        sp_trigger_webhook($entry->entry_id, $webhook_data, $webhook_url);
    }
}