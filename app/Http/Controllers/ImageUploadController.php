<?php

namespace App\Http\Controllers;

use JD\Cloudder\Facades\Cloudder;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function uploadImages(Request $request)
    {
        $file = file_get_contents( 'coba.png' );
        $url = 'http://45.76.154.59:8081/wp-json/wp/v2/media/';
        $ch = curl_init();
        $username = 'gafriputra';
        $password = '08563117804';
        $filename = "gambarku.png";

        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $file );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, [
            'Content-Disposition: form-data; filename="'.$filename.'"',
            'Authorization: Basic ' . base64_encode( $username . ':' . $password ),
        ] );
        $result = curl_exec( $ch );
        curl_close( $ch );
        print_r( json_decode( $result ) );
    }
}
