<?php

namespace App\Http\Controllers\Backend;

use DB;
use App\Models\Event;
use Plivo\RestClient;
use App\Models\EventDetails;
use Illuminate\Http\Request;
use App\Models\PhoneTemplate;
use App\Models\EventEmailTemplate;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function message(Request $request, $event_id)
    {

		$plivoAuthId = getenv('PLIVO_AUTH_ID');
		$plivoAuthToken = getenv('PLIVO_AUTH_TOKEN');

    	$gender    = $request->get('gender');
		$age_range = $request->get('age_range');
		$age_range = explode(';', $age_range);
		$users     = $request->get('users');
		$message   = $request->get('message');
		if($users)
		{
			$users = DB::table('users')->join('dating_profiles', 'dating_profiles.user_id', 'users.id')->whereIn('users.id',$users)->where('gender', $gender)->get();
			$phonesnumbers = array();
			foreach ($users as $user) {
				$age = \Carbon\Carbon::parse($user->dob)->diff(\Carbon\Carbon::now())->format('%y');
				if($age > $age_range[0] && $age <= $age_range[1])
				{
					$phonesnumbers[]=$user->phone;
				}
			}
		}
		if (isset($phonesnumbers) && $phonesnumbers !=null) {
		
			foreach ($phonesnumbers as $phone) {
				$phone = str_replace('-', '', $phone);
				$phone_number = substr( $phone, 0, strlen( '+1' ));
					if ($phone_number != '+1') {
						$phone_number = '+1'.$phone;
					}
				$client = new RestClient($plivoAuthId, $plivoAuthToken);
					$message_created = $client->messages->create(
				    '+15873339873',
				    [$phone_number],
				    $message);

				    dump($message_created);
			}
		}
		dd($client = new RestClient($plivoAuthId, $plivoAuthToken));
		return back()->withFlashSuccess('Message sent');
		
    }

    public function showTemplate()
    {
    	return view('backend.events.automatedTextMessage');
    }
    public function savetemplate(Request $request)
    {
    	$phone_template = new PhoneTemplate();
    	$phone_template->event_type = $request->get('event_type');
		$phone_template->template_name = $request->get('template_name');
		$phone_template->message_body = $request->get('message_body');
		$phone_template->save();
		return back()->withFlashSuccess('Template created');
    }
    public function showEmailTemplate()
	{
		$emailTemplates = EventEmailTemplate::all();
    	return view('backend.events.emailTemplates', compact('emailTemplates'));
	}
	public function saveEmailTemplate(Request $request)
	{
		$emailTemplates = EventEmailTemplate::whereId($request->id)->first();
		$emailTemplates->description = $request->description;
		$emailTemplates->save();
		return back()->withFlashSuccess('Updated Successfully!');
	}
	public function emailTemplateDetail($id)
	{
		$emailTemplates = EventEmailTemplate::whereId($id)->first();
    	return view('backend.events.emailTemplateDetail', compact('emailTemplates'));
	}
}
