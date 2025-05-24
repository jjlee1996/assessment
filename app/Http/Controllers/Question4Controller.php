<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class Question4Controller extends Controller
{

    public function simulate(Request $request)
    {
        $itemRarity = $request->input('rarities', []);
        $vipRanks = $request->input('vips', []);

        $itemRarity = array_map('intval', $itemRarity);
        $vipRanks = array_map('strval', $vipRanks);

        $result = [];

        foreach ($vipRanks as $vip) {
            $result[$vip] = array_fill_keys($itemRarity, 0);

            for ($i = 0; $i < 100; $i++) {
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

        foreach ($itemRarity as $rarity) {
            // Reverse rarity to favor lower rarities by default, adjusted by vip level
            $vipFactor = $vipIndex / max(1, $maxVip); // 0 for lowest VIP
            $reversedRarity = $rarityCount + 1 - $rarity;
            $weight = pow($reversedRarity, 1 + (1 - $vipFactor));
            $weights[] = $weight;
        }

        $total = array_sum($weights);
        $rand = mt_rand() / mt_getrandmax() * $total;

        $cumulative = 0;
        foreach ($weights as $index => $weight) {
            $cumulative += $weight;
            if ($rand <= $cumulative) {
                return $itemRarity[$index];
            }
        }

        return end($itemRarity);
    }
}