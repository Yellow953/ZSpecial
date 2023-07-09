<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as SMClient;

class SocialMediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('social_media.index');
    }

    public function sm_post()
    {
        $client = new SMClient();

        // Facebook API request
        $facebookPostUrl = 'https://graph.facebook.com/v17.0/17841400008460056/media';
        $facebookAccessToken = '{access-token}';
        $facebookMediaUrl = 'https://s3-media0.fl.yelpcdn.com/bphoto/lzYN6I4QllWbNNcI4boAww/348s.jpg';
        $facebookCaption = 'Hello, Facebook!';
        $facebookResponse = $client->post($facebookPostUrl, [
            'query' => ['access_token' => $facebookAccessToken],
            'form_params' => [
                'image_url' => $facebookMediaUrl,
                'caption' => $facebookCaption
            ]
        ]);

        return $facebookResponse;
    }
}