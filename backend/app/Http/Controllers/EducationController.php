<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use Illuminate\Support\Facades\Auth; // 1. Jangan lupa tambahkan baris ini!

class EducationController extends Controller
{
    public function index()
    {
        $data = Education::latest()->get();
        return view('edukasi.index', compact('data'));
    }

    public function create()
    {
        return view('edukasi.create');
    }

    public function store(Request $request)
    {
        // 2. Tambahkan created_by agar sesuai dengan database
        Education::create([
            'title' => $request->title,
            'content' => $request->content,
            'created_by' => Auth::id() 
        ]);

        return redirect('/edukasi')->with('success', 'Edukasi ditambahkan');
    }
}