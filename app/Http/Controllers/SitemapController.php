<?php

namespace App\Http\Controllers;

use App\Models\Coaching;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {

        $coachings = Coaching::where('status', 'approved')->select('slug', 'updated_at')->get();

        return response()->view('sitemap', ['coachings' => $coachings])->header('Content-Type', 'text/xml');
    }
}
