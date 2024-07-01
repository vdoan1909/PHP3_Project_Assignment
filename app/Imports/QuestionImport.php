<?php
namespace App\Imports;

use App\Models\Question;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class QuestionImport implements ToCollection
{
    private $exam_id;

    public function __construct(int $exam_id)
    {
        $this->exam_id = $exam_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            $name = isset($row[0]) ? trim($row[0]) : null;
            $option_a = isset($row[1]) ? trim($row[1]) : null;
            $option_b = isset($row[2]) ? trim($row[2]) : null;
            $option_c = isset($row[3]) ? trim($row[3]) : null;
            $option_d = isset($row[4]) ? trim($row[4]) : null;
            $correct_answer = isset($row[5]) ? trim($row[5]) : null;

            $data = [
                'name' => $name,
                'option_a' => $option_a,
                'option_b' => $option_b,
                'option_c' => $option_c,
                'option_d' => $option_d,
                'correct_answer' => $correct_answer,
                'exam_id' => $this->exam_id,
            ];

            try {
                Question::create($data);
            } catch (\Exception $e) {
                Log::error('Error inserting row at index ' . $key . ': ' . json_encode($row) . ' Error: ' . $e->getMessage());
            }
        }
    }
}
