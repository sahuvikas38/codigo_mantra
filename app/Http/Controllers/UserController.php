<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;

class UserController extends Controller
{
    public function getDashboard(Request $request){
        $blogs = Blog::where('user_id', Auth::user()->id)->latest()->paginate(5);
        return view('dashboard', compact('blogs'));
    }

    public function homePage(Request $request){
        $searchedKey = $request->input('key', '');
        // dd($searchedKey);
        $blogs = Blog::latest();

        if (!empty($searchedKey)) {
            $blogs->where('tags', 'LIKE', '%' . $searchedKey . '%');
        }
        
        $blogs = $blogs->paginate(5);

        return view('welcome', compact('blogs', 'searchedKey'));
    }
}
