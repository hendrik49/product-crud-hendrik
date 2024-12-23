<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $publishedCount = Product::where('is_publish', 1)->count();
        $notPublishedCount = Product::where('is_publish', 0)->count();

        $productsByDate = Product::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
             
        return view('dashboard', compact('publishedCount', 'notPublishedCount', 'productsByDate'));
    }
}
