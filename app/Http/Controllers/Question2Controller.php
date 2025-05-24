<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class Question2Controller extends Controller
{
    public function analyzeMsg(string $input, string $output)
    {

        if (!ctype_digit($input) || !ctype_digit($output)) {
            return response("Input and output must contain digits only.");
        }

        if (strlen($input) > 20) {
            return response("Input and output must not exceed 20 digits.");
        }

        if (strlen($input) !== strlen($output)) {
            return response("Input and output must be the same length.");
        }

        $sum = [];
        $diff = [];

        for ($i = 0; $i < strlen($input); $i++) {
            $a = (int)$input[$i];
            $b = (int)$output[$i];
            $sum[] = $a + $b;
            $diff[] = $b - $a;

            Log::info("Input {$i}: {$a}, Output {$i}: {$b}");
        }

        $sumText = implode(', ', $sum);

        Log::info("Sums: {$sum[0]}, Diffs: {$diff[0]}");

        Log::info("List of digit sum: {$sumText}");

        if (count(array_unique($sum)) === 1) {
            return response("Mike encrypts his message by summing up to {$sum[0]} to each original character.");
        }

        if (count(array_unique($diff)) === 1) {
            return response("Mike encrypts his message by adding {$diff[0]} to each original character.");
        }
        return response("No consistent encryption pattern detected.");
    }
}
