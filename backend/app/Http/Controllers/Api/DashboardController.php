<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\News;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'news_count' => News::count(),
            'services_count' => Service::count(),
            'unread_contacts' => Contact::where('is_read', false)->count(),
            'total_contacts' => Contact::count(),
        ]);
    }
}
