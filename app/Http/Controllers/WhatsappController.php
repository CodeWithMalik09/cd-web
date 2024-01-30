<?php

namespace App\Http\Controllers;

use App\Models\Coaching;
use App\Models\SalesLead;
use App\Models\WhatsappMessage;
use Carbon\Carbon;
use Netflie\WhatsAppCloudApi\Message\Contact\ContactName;
use Netflie\WhatsAppCloudApi\Message\Contact\Phone;
use Netflie\WhatsAppCloudApi\Message\Contact\PhoneType;
use Netflie\WhatsAppCloudApi\Message\OptionsList\Action;
use Netflie\WhatsAppCloudApi\Message\OptionsList\Row;
use Netflie\WhatsAppCloudApi\Message\OptionsList\Section;
use Netflie\WhatsAppCloudApi\WebHook;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsappController extends Controller
{
    private $apikey = "EAAMyYqnZAXkwBAELYDXP1lG56pPE0MYZBSNrRhCEQGmM1CVdmZBGePBPxYZBZA8LvVPpFDrMfnhlT0jgD29DyZAjyss4nsTZApIBcxX2PwJCdtMhdLDPST0KHiVcZBlZBZCqLZA6FbZA9zPtjbXErbeFvyl96QCeV1MDsp17FZBhZAXJgqOWK3zc7ayvFW";
    private $phone_number_id = "112959128447235";

    public function sendMessage()
    {
        $whatsapp = new WhatsAppCloudApi(
            [
                'from_phone_number_id' => $this->phone_number_id,
                'access_token' => $this->apikey
            ]
        );

        $rows = [
            new Row('1', '⭐️', "Experience wasn't good enough"),
            new Row('2', '⭐⭐️', "Experience could be better"),
            new Row('3', '⭐⭐⭐️', "Experience was ok"),
            new Row('4', '⭐⭐️⭐⭐', "Experience was good"),
            new Row('5', '⭐⭐️⭐⭐⭐️', "Experience was excellent"),
        ];
        $sections = [new Section('Stars', $rows)];
        $action = new Action('Submit', $sections);

        $whatsapp->sendList(
            '7255892507',
            'Rate your experience',
            'Please consider rating your shopping experience in our website',
            'Thanks for your time',
            $action
        );
    }

    public function sendTextMessage($phone, $message)
    {
        $whatsapp = new WhatsAppCloudApi(
            [
                'from_phone_number_id' => $this->phone_number_id,
                'access_token' => $this->apikey
            ]
        );

        $whatsapp->sendTextMessage($phone, $message);
    }

    public function sendLocationMessage($phone)
    {
        $whatsapp = new WhatsAppCloudApi(
            [
                'from_phone_number_id' => $this->phone_number_id,
                'access_token' => $this->apikey
            ]
        );

        $whatsapp->sendLocation($phone, 25.59909630925126, 85.03806283231397, 'Tiruvantpuram City', 'Danapur, Patna');
    }

    public function sendContactMessage($phone)
    {
        $whatsapp = new WhatsAppCloudApi(
            [
                'from_phone_number_id' => $this->phone_number_id,
                'access_token' => $this->apikey
            ]
        );
        $contact_name = new ContactName('Tiruvantpuram', 'City');
        $phone_number = new Phone('08045888497', PhoneType::CELL());
        $whatsapp->sendContact($phone, $contact_name, $phone_number);
    }

    public function markAsRead($messageid)
    {
        $whatsapp = new WhatsAppCloudApi(
            [
                'from_phone_number_id' => $this->phone_number_id,
                'access_token' => $this->apikey
            ]
        );

        $whatsapp->markMessageAsRead($messageid);
    }



    public function webhookCallback()
    {

        $payload = file_get_contents('php://input');
        $webhook = new WebHook();
        // echo $webhook->verify($_GET,'verifithistoken');

        $message = $webhook->read(json_decode($payload, true));
        $received = json_decode($payload);



        if (isset($received->entry[0]->changes[0]->value->contacts)) {
            $received_from_phone_number = $received->entry[0]->changes[0]->value->contacts[0]->wa_id;
            $received_from_name = $received->entry[0]->changes[0]->value->contacts[0]->profile->name;
            $received_message = $received->entry[0]->changes[0]->value->messages[0];

            // $this->sendTextMessage($received_from_phone_number, $received_from_name . ' ' . $received_message->text->body);
            $this->markAsRead($received_message->id);

            // WhatsappMessage::create(
            //     [
            //         'message_id' => $received_message->id,
            //         'from_phone' => $received_from_phone_number,
            //         "message" => $received_message->text->body
            //     ]
            // );

            // $phone_number =  $received_from_phone_number;
            // if (strlen($phone_number) > 10) {
            //     $phone_number =  substr($phone_number, strlen($phone_number) - 10);
            // }

            // if (SalesLead::where('phone_number', $phone_number)->get()->count() == 0) {
            //     SalesLead::create(
            //         [
            //             'name' => $received_from_name,
            //             'phone_number' => $phone_number,
            //             'source' => 'Whatsapp',
            //         ]
            //     );
            // }


            $this->bot($received_message->text->body, $received_from_phone_number);
        }

        return response()->json(['message' => 'success'], 200);
    }

    public function bot($command, $waid)
    {
        if (str_contains($command, ',')) {
            $cmd = explode(',', $command);
            $name = $cmd[0];
            $district = $cmd[1];
            $coaching = Coaching::where('name', 'like', '%' . $name . '%')->where('district', 'like', '%' . $district . '%')->get()->first();
        } else {
            $coaching = Coaching::where('name', 'like', '%' . $command . '%')->get()->first();
        }

        if (!$coaching || strlen($command) < 3) {
            $this->sendTextMessage($waid, "
            Oops! no any coaching found.
*Visit Our Website to search:* https://coachingdetail.com
            ");
            return 0;
        }

        $course = $coaching->mainCourse->name;
        $streams = $coaching->streams;
        $address =  ucwords(strtolower($coaching->address)) . "," .
            ucwords(strtolower($coaching->district)) . "," . ucwords(strtolower($coaching->state)) . "," .
            $coaching->country . "," .
            $coaching->pincode;

        $phone = $coaching->phone ?? "N/A";
        $email = $coaching->email ?? "N/A";
        $website_link = "https://coachingdetail.com/coaching/$coaching->slug";

        $this->sendTextMessage($waid, "
            _*$coaching->name*_

*Course:* $course
*Streams:* $streams
*Email:* $email
*Phone Number:*  $phone
*View Full Detail*: $website_link   
        ");
    }


    // public function dashboardIndex()
    // {
    //     $messages = WhatsappMessage::where('deleted_at', null)->orderBy('id', 'desc')->get();
    //     foreach ($messages as $key => $message) {
    //         $check_lead = SalesLead::where('phone_number', substr($message->from_phone, 2))->get();
    //         if ($check_lead->count() == 1) {
    //             $message->{'lead_name'} = $check_lead->first()->name;
    //             $message->{'lead_id'} = $check_lead->first()->id;
    //         }
    //     }
    //     return view('screen.logs.whatsapp', ['messages' => $messages]);
    // }

    // public function deleteMessage($id)
    // {
    //     WhatsappMessage::find($id)->update(
    //         [
    //             'deleted_at' => Carbon::now()
    //         ]
    //     );
    //     return redirect()->back()->with('message', 'Message deleted successfully.');
    // }
}
