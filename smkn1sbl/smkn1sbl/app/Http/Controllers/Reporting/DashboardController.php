<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\PPDB\Applicant;
use App\Models\PPDB\Registration;
use App\Models\CMS\News;
use App\Models\CMS\Page;
use App\Models\Pakar\Consultation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Statistik ringkas utk dashboard admin
    public function index()
    {
        $stats = [
            'total_applicants' => Applicant::count(),
            'total_registrations_pending' => Registration::where('status', 'pending')->count(),
            'total_registrations_accepted' => Registration::where('status', 'accepted')->count(),
            'total_news' => News::published()->count(),
            'total_pages' => Page::published()->count(),
            'total_consultations' => Consultation::count(),
            'total_users' => User::count(),
        ];

        $registrationTrend = Registration::select(
            DB::raw("DATE_FORMAT(registration_date, '%Y-%m') as month"),
            DB::raw('count(*) as total')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $registrationByStatus = Registration::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('reporting.dashboard', compact('stats', 'registrationTrend', 'registrationByStatus'));
    }
}
