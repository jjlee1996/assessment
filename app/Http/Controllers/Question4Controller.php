<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Question4Controller extends Controller
{

    public function simulate(Request $request)
    {
        $itemRarity = $request->input('rarities', []);
        $vipRanks = $request->input('vips', []);
        $roll =  $request->input('roll', []);

        $itemRarity = array_map('intval', $itemRarity);
        $vipRanks = array_map('strval', $vipRanks);

        $result = [];

        foreach ($vipRanks as $vip) {
            $result[$vip] = array_fill_keys($itemRarity, 0);

            for ($i = 0; $i < $roll; $i++) {
                $rarity = $this->rollItem($vip, $vipRanks, $itemRarity);
                $result[$vip][$rarity]++;
            }
        }

        return response()->json($result);
    }

    private function rollItem(string $vipRank, array $vipRanks, array $itemRarity): int
    {
        $vipIndex = array_search($vipRank, $vipRanks);

        $maxVip = count($vipRanks) - 1;

        $weights = [];
        $rarityCount = count($itemRarity);

        // Log::info("vipIndex: {$vipIndex}");
        // Log::info("maxVip: {$maxVip}");
        // Log::info("rarityCount: {$rarityCount}");

        foreach ($itemRarity as $rarity) {

            // Log::info("rarity: {$rarity}");

            // Reverse rarity to favor lower rarities by default, adjusted by vip level
            $vipFactor = $vipIndex / max(1, $maxVip); // 0 for lowest VIP

            // Log::info("vipFactor: {$vipIndex} / max(1, $maxVip)");
            // Log::info("vipFactor: {$vipFactor}");

            $reversedRarity = $rarityCount + 1 - $rarity;
            // Log::info("reversedRarity: {$rarityCount} + 1 - {$rarity}");
            // Log::info("reversedRarity: {$reversedRarity}");

            $weight = pow($reversedRarity, 1 + (1 - $vipFactor));

            // Log::info("weight: pow({$rarityCount}, 1 + (1 - {$vipFactor})");
            // Log::info("weight: {$weight}");


            $weights[] = $weight;
        }

        $total = array_sum($weights);

        // Log::info("total: {$total}");

        $mtRand = mt_rand();
        $mtRandMax = mt_getrandmax();

        $rand = $mtRand / $mtRandMax * $total;

        // Log::info("rand: {$mtRand} / {$mtRandMax} * {$total}");

        // Log::info("rand: {$rand}");


        $cumulative = 0;
        foreach ($weights as $index => $weight) {
            $cumulative += $weight;
            // Log::info("cumulative: {$cumulative}");

            if ($rand <= $cumulative) {
                return $itemRarity[$index];
            }
        }

        return end($itemRarity);
    }
}
