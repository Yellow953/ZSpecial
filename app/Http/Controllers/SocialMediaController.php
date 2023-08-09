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
        // $client = new SMClient();

        // // Facebook API request
        // $facebookPostUrl = 'https://graph.facebook.com/v17.0/100089876063961/media'; // Replace {user-id or page-id} with the target user or page ID.
        // $facebookAccessToken = '{facebook-access-token}'; // Replace with your Facebook access token.
        // $facebookMediaUrl = $request->image; // Make sure you have the image URL available in your $request.
        // $facebookCaption = $request->title;

        // $facebookResponse = $client->post($facebookPostUrl, [
        //     'query' => ['access_token' => $facebookAccessToken],
        //     'form_params' => [
        //         'media_url' => $facebookMediaUrl,
        //         // It should be 'media_url' instead of 'image_url'.
        //         'caption' => $facebookCaption
        //     ]
        // ]);

        // // You can check $facebookResponse for the API response, handle any errors, or get the post ID for later reference.
        // // For example:
        // $facebookData = json_decode($facebookResponse->getBody()->getContents(), true);
        // $facebookPostId = $facebookData['id'];

        // // Now, for Instagram API request
        // $instagramPostUrl = 'https://graph.facebook.com/v12.0/{instagram-user-id}/media'; // Replace {instagram-user-id} with the target Instagram user ID.
        // $instagramAccessToken = '{instagram-access-token}'; // Replace with your Instagram access token.
        // $instagramMediaUrl = $request->image;
        // $instagramCaption = $request->title;

        // $instagramResponse = $client->post($instagramPostUrl, [
        //     'query' => ['access_token' => $instagramAccessToken],
        //     'form_params' => [
        //         'url' => $instagramMediaUrl,
        //         // It should be 'url' instead of 'image_url'.
        //         'caption' => $instagramCaption
        //     ]
        // ]);

        // // Similar to Facebook, handle the Instagram API response and get the post ID if needed.
        // $instagramData = json_decode($instagramResponse->getBody()->getContents(), true);
        // $instagramPostId = $instagramData['id'];

        // return "Successfully posted to Facebook (Post ID: {$facebookPostId}) and Instagram (Post ID: {$instagramPostId}).";

        $client = new SMClient();

        $apiKey = '5TH5SAM-DNG4JDP-HWPAYDP-GP68FCS';
        $facebookPageId = '104373565911628';
        $instagramBusinessId = '17841457896538891';

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
                'platforms' => ['facebook', 'instagram'],
                'message' => $postTitle,
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