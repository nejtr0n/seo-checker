<?php
/**
 * Created by PhpStorm.
 * User: a6y
 * Date: 30.09.15
 * Time: 17:41
 */

error_reporting(E_ALL);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.comfplus.ru/shop/elektrokaminy/nastennye_kaminy/');

// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);
var_dump($response);
echo 'Ошибка curl: ' . curl_error($ch);