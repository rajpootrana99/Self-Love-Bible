<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Token;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notification.index');
    }

    public function fetchNotifications()
    {
        $notifications = Notification::all();
        return response()->json([
            'notifications' => $notifications,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = '';

        $SERVER_API_KEY = 'AAAAH13Wawo:APA91bE61OXDrCbPrhfsXw91djC-QKAfgqVBfFaL3ta9pexkMuTmOTfa_xgryZwN45KrFgM-G_VVN8zpbdAfWrIXEEKClwMY3eImdYGUzsx7hFo_HXUxTlDJ0GhXShOxW9y-D5SB4kFI';

        $tokens = Token::all();
        foreach ($tokens as $token){
            $token_1 = $token->token;

            $data = [

                "registration_ids" => [
                    $token_1
                ],

                "notification" => [

                    "title" => $request->input('title'),

                    "body" => $request->input('body'),

                    "sound" => "default" // required for sound on ios

                ],

            ];

            $dataString = json_encode($data);

            $headers = [

                'Authorization: key=' . $SERVER_API_KEY,

                'Content-Type: application/json',

            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
        }

        if ($response) {
            Notification::create([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
            ]);
            return response()->json(['status' => 1, 'message' => 'Notification Send Successfully']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Notification Not Send']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit($notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($notification)
    {
        $notification = Notification::find($notification);
        if (!$notification){
            return response()->json([
                'status' => false,
                'messaqe' => 'Notification not exist'
            ]);
        }
        $notification->delete();
        return response()->json([
            'status' => true,
            'message' => 'Notification Deleted Successfully'
        ]);
    }
}
