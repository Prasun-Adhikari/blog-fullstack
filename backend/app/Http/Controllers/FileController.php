<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class FileController extends Controller
{
    public function uploadImage(Request $request) {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $file  = $request->file('image');
        $name  = Str::uuid().'.'.$file->extension();
        $path  = $file->storeAs('Images', $name, 'uploads');

        return response()->json([
            'imageUrl' => Storage::disk('uploads')->url($path),
        ], 201);
    }
}
