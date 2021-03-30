<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPTelebot;

class BotController extends Controller
{
    public function index(Request $request)
    {
        $bot = new PHPTelebot(env('TELEGRAM_BOT_TOKEN'), env('TELEGRAM_USERNAME'));

        $bot->command();

        $bot->run();
    }
}
