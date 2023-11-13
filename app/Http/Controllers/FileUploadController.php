<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UploadTemp;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function proccess(Request $request)
    {
        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();

            $folder = uniqid() . '-' . now()->timestamp;

            $file->storeAs('tmp/'.$folder, $filename);

            UploadTemp::create([
                'filename' => $filename,
                'folder' => $folder
            ]);

            return $folder;
        }

        return '';
    }
}
