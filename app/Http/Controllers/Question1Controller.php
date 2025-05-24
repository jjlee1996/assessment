<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Enums\MemberType;
use App\Enums\FileType;

class Question1Controller extends Controller
{
    public function checkDownload(MemberType $memberType, FileType $fileType)
    {

        $memberTypeValue = $memberType->value;
        $fileTypeValue = $fileType->value;
        $now = time();

        if (!session()->has('downloads')) {
            session(['downloads' => []]);
        }

        $downloads = session('downloads');

        if (!isset($downloads[$memberTypeValue])) {
            $downloads[$memberTypeValue] = [
                'last_time' => 0,
                'jpeg_count' => 0,
            ];
        }

        $lastTime = $downloads[$memberTypeValue]['last_time'];
        $jpegCount = $downloads[$memberTypeValue]['jpeg_count'];
        $diff = $now - $lastTime;

        if ($memberType === MemberType::NON_MEMBER) {
            if ($diff < 5) {
                $result = response("Too many downloads", 429);
            } else {
                $downloads[$memberTypeValue]['last_time'] = $now;
                session(['downloads' => $downloads]);

                $result = response("Your download is starting...");
            }
        } else if ($memberType === MemberType::MEMBER) {
            if ($fileType === FileType::JPEG) {
                if ($jpegCount < 2) {
                    $downloads[$memberTypeValue]['jpeg_count'] += 1;
                    $downloads[$memberTypeValue]['last_time'] = $now;
                    session(['downloads' => $downloads]);

                    $result = response("Your download is starting...");
                } else {
                    if ($diff < 5) {
                        $result = response("Too many downloads", 429);
                    } else {
                        $downloads[$memberTypeValue]['last_time'] = $now;
                        session(['downloads' => $downloads]);
                        $result = response("Your download is starting...");
                    }
                }
            } else {
                if ($diff < 5) {
                    $result = response("Too many downloads", 429);
                } else {
                    $downloads[$memberTypeValue]['last_time'] = $now;
                    session(['downloads' => $downloads]);

                    $result = response("Your download is starting...");
                }
            }
        } else {
            $result = response("Invalid member type", 400);
        }

        $timestamp = now()->format('H:i:s');
        Log::info("Timestamp: {$timestamp}, Member type: {$memberTypeValue}, File type: {$fileTypeValue}");
        Log::info("Outcome: {$result->getContent()}");

        return $result;
    }
}
