<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Subscriber;

class MailingListController extends Controller
{

	public function subscriberToMailingList(Request $request)
	{
		$subscriber = Subscriber::where('email', $request->email)->get()->first();

		// dd($subscriber);

		if ($subscriber)
		{
			return response()->json(
                [
                    "status" =>
                        [
                            "message" => "already added to mailing list",
                            "code" => 200
                        ],
                    "errors" => false,
                    "data" =>
                        []
                ]
            );
		}
		else
		{
			$subscriber = new Subscriber();
			$subscriber->email = $request->email;

			$subscriber->save();

			return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Added to mailing list",
                            "code" => 200
                        ],
                    "errors" => false,
                    "data" =>
                        []
                ]
            );
		}
	}
}
