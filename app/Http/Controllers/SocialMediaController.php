<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as SMClient;

class SocialMediaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified']);
    }

    public function index()
    {
        return view('social_media.index');
    }

    public function sm_post(Request $request)
    {
        $client = new SMClient();

        $apiKey = '5TH5SAM-DNG4JDP-HWPAYDP-GP68FCS';

        $postTitle = $request->title;

        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move('uploads/posts/', $filename);
        $imageUrl = asset('uploads/posts/' . $filename);

        $response = $client->post('https://app.ayrshare.com/api/post', [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
            ],
            'json' => [
                'post' => $postTitle,
                'platforms' => ['facebook', 'instagram', 'tiktok'],
                'mediaUrls' => [$imageUrl],
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            return redirect()->back()->with('success', 'Post successfully posted...');
        } else {
            return redirect()->back()->with('danger', 'Something went wrong...');
        }
    }
}