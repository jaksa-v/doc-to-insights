<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'document' => 'required|file|max:10240',
        ]);

        $path = $request->file('document')->store('documents');

        $request->user()->documents()->create([
            'name' => $request->file('document')->getClientOriginalName(),
            'url' => $path,
        ]);

        return to_route('dashboard');
    }
}
