<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        // $products = Product::oldest()->get();
        // $count = 1;
        // foreach ($products as $product) {
        //     $product->item_code = str_pad($count, 6, '0', STR_PAD_LEFT);
        //     $product->save();
        //     $count++;
        // }
        return view('Pages.dashboard');
    }
}
