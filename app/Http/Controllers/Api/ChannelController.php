<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelCollection;
use App\Models\Channel;
use App\Models\UserAccessKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class ChannelController extends Controller
{
    public function getDataRs(Request $request)
    {
        $header = $request->header('API-KEY-TEST');

        if ($header == '') {
            return abort('403');
        } else {
            $key = "12345667890X";
            if ($header != $key) {
                return abort('403');
            } else {
                $channel = Channel::all();
                $response["GetDataRq"] = $channel;
                $response["status"] = 1;
                return response()->json($response);
            }
        }
    }

    public function filterData(Request $request)
    {
        $bodyContent = $request->getContent();
        $collection = json_decode($bodyContent, true);
        $channel = Channel::where('id_channel', $collection['GetDataRq']['IDCHANELL'])->where('created_at', $collection['GetDataRq']['TRNDATE'])->first();
        $result = [];
        if ($channel == null or $collection == null) {
            $result[] = [
                'STATUS' => "0",
                'ERR_MESSAGE' => "Data Kosong"
            ];
            $response["GetDataRs"] = $result;
            return response()->json($response);
        } else {
            $result[] = [
                'NAMECHANELL' => $channel['name_channel'],
                'CHANNELADDR' => $channel['channel_address'],
                'STATUS' => "1"
            ];
            $response["GetDataRs"] = $result;
            return response()->json($response);
        }
    }

    public function storeDataRs(Request $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        // ]);

        $header = $request->header('API-KEY-TEST');

        if ($header == '') {
            return abort('403');
        } else {
            $key = "12345667890X";
            if ($header != $key) {
                return abort('403');
            } else {
                try {
                    $channel = Channel::create([
                        'name_channel' => $request->NAMECHANELL,
                        'channel_address' => $request->CHANNELADDR,
                    ]);
                    $response["GetDataRs"] = $channel;
                    $response["status"] = 1;
                    return response()->json($response);
                } catch (\Throwable $e) {
                    $response["status"] = 0;
                    $response["ERR_MESSAGE"] = $e->getMessage();
                    return response()->json($response);
                }
            }
        }
    }

    // public function filterData(Request $request)
    // {

    // }
}
