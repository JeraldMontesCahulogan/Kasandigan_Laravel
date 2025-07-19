<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        // Get the Base64 Image
        $imageData = $request->input('image');

        // Remove "data:image/png;base64,"
        $imageData = substr($imageData, strpos($imageData, ",") + 1);

        // Decode Base64
        $imageData = base64_decode($imageData);

        // Generate File Name
        $fileName = 'attachment_' . time() . '.png';

        // Store Image in storage/attachments
        Storage::disk('local')->put('attachments/' . $fileName, $imageData);

        return back()->with('message', 'Image saved successfully!');
    }
}
