<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelCollection;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function getDataRs()
    {
        $channel = Channel::all();
        return response()->json(['data' => $channel]);
    }
}
