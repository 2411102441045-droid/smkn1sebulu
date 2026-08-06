<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pakar\Question;
use App\Models\Pakar\KnowledgeBase;
use App\Models\Pakar\Rule;

// Contoh sistem pakar: rekomendasi jurusan SMK berdasarkan minat/gejala (bisa disesuaikan)
class PakarSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            'G01' => 'Saya suka merakit dan memperbaiki perangkat elektronik/komputer',
            'G02' => 'Saya senang menggambar desain dan tata letak',
            'G03' => 'Saya tertarik pada logika pemrograman dan algoritma',
            'G04' => 'Saya suka bekerja dengan mesin dan alat berat',
            'G05' => 'Saya senang berhitung dan mengelola data keuangan',
        ];

        $questionModels = [];
        foreach ($questions as $code => $text) {
            $questionModels[$code] = Question::firstOrCreate(['code' => $code], ['question_text' => $text]);
        }

        $knowledgeBases = [
            'P01' => ['name' => 'Rekayasa Perangkat Lunak', 'solution' => 'Direkomendasikan mengambil jurusan RPL.'],
            'P02' => ['name' => 'Teknik Komputer dan Jaringan', 'solution' => 'Direkomendasikan mengambil jurusan TKJ.'],
            'P03' => ['name' => 'Desain Komunikasi Visual', 'solution' => 'Direkomendasikan mengambil jurusan DKV.'],
            'P04' => ['name' => 'Teknik Kendaraan Ringan', 'solution' => 'Direkomendasikan mengambil jurusan TKR.'],
            'P05' => ['name' => 'Akuntansi', 'solution' => 'Direkomendasikan mengambil jurusan Akuntansi.'],
        ];

        $kbModels = [];
        foreach ($knowledgeBases as $code => $attrs) {
            $kbModels[$code] = KnowledgeBase::firstOrCreate(['code' => $code], $attrs);
        }

        $rules = [
            ['P01', 'G03', 0.8],
            ['P01', 'G01', 0.4],
            ['P02', 'G01', 0.8],
            ['P02', 'G03', 0.4],
            ['P03', 'G02', 0.9],
            ['P04', 'G04', 0.9],
            ['P05', 'G05', 0.9],
        ];

        foreach ($rules as [$kbCode, $qCode, $cf]) {
            Rule::firstOrCreate([
                'knowledge_base_id' => $kbModels[$kbCode]->id,
                'question_id' => $questionModels[$qCode]->id,
            ], ['cf_value' => $cf]);
        }
    }
}
