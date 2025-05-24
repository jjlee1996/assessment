<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\Gender;
use Illuminate\Support\Facades\Log;

class Question3Controller extends Controller
{
    public function insertData(Request $request)
    {
        $students = $request->input('students', []);
        $summaries = [];

        foreach ($students as $data) {
            $summaries[] = $this->testSummary([
                $data['name'],
                $data['gender'],
                (int)$data['math'],
                (int)$data['science']
            ]);
        }

        return redirect('/question3')->withInput()->with('summaries', $summaries);
    }

    private function testSummary($array)
    {
        [$name, $gender, $mathScore, $scienceScore] = $array;
        $average = ($mathScore + $scienceScore) / 2;

        $genderEnum = Gender::from($gender);

        $pronoun = $genderEnum === Gender::MALE ? '<b>he</b>' : '<b>she</b>';

        $weakSubjects = [];
        if ($mathScore < 50) $weakSubjects[] = '<b>Mathematics</b>';
        if ($scienceScore < 50) $weakSubjects[] = '<b>Science</b>';

        $summary = "<b>$name</b> has an average score of <b>" . intval($average) . "</b> from this test. ";

        if (empty($weakSubjects)) {
            $summary .= "Overall, $pronoun is performing very well in this test.";
        } else {
            $subjectList = implode(' and ', $weakSubjects);
            $summary .= "However, $pronoun is not doing well for $subjectList subject" . (count($weakSubjects) > 1 ? "s." : ".");
        }

        Log::info("summary: {$summary}");


        return $summary;
    }
}
