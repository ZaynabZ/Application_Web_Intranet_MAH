<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    //
    public static function parse() {

        $fileNames = [];
        $path = public_path('uploads');
        $files = \File::allFiles($path);

        foreach ($files as $file) {
            $temp = pathinfo($file);
            array_push($fileNames , $temp['filename'].'.'.$temp['extension']);

        };
        return $fileNames;

    }

    public static function parse_cv(){
        $cvs_emplacements = [];
        $path = public_path('cvs');
        $cvs = \File::allFiles($path);

        foreach ($cvs as $cv) {
            $temp = pathinfo($cv);
            array_push($cvs_emplacements , $temp['filename'].'.'.$temp['extension']);
        };

        return $cvs_emplacements;

    }
}
