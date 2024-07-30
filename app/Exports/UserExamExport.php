<?php

namespace App\Exports;

use App\Models\UserExam;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExamExport implements FromCollection, WithHeadings, WithMapping
{
    protected $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function collection()
    {
        return UserExam::where('user_id', $this->user_id)->get();
    }

    public function map($userExam): array
    {
        return [
            $userExam->user->name,
            $userExam->exam->name,
            $userExam->score,
            $userExam->created_at,
            $userExam->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'User Name',
            'Exam Name',
            'Score',
            'Start at',
            'Redo at',
        ];
    }
}
