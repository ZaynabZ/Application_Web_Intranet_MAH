<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HelperController;
use App\Notifications\NewDocumentPosted;
use App\User;
use App\Candidat;

class FileUploadController extends Controller
{


    public function fileUploadPost(Request $request) {
        
        if(!Auth::user()->isUser()){
            
             $request->validate([
            'file' => 'required|mimes:pdf,png,jpg,jpeg|max:20480',
            ]);

            $file_name = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
            $type = $request->file->extension();


            $filename = strtoupper(trim( $file_name)).'-'.date('Y-m-d').'.'.$request->file->extension();
            $request->file->move(public_path('uploads'),$filename);

            // notifications
            $users = User::all();
            foreach ($users  as $user){
                $user->notify(new NewDocumentPosted($filename,$type,auth()->user()));
            }

            return back()
                    ->with('success','You have successfully upload file.')
                    ->with('file',$filename);
        }
        else{
            return redirect('home');
        }
        
       
    }

    public function show_files() {
        
            $filenames = HelperController::parse();
            return response()->json([
                'filenames'  => $filenames,

            ]);

        // dd($filenames);
    }

    public function showfiles() {
        if(!Auth::user()->isUser()){
            
            return view('files');
        }
        else{
            return redirect()->back();
        }
    }

    public function deleteFile(Request $request)
    {  
        $filename = $request->filename;
        if(\File::exists(public_path('uploads/'.$filename))){
            \File::delete(public_path('uploads/'.$filename));
            
        }
        return response()->json([
            'deleted'  => 'yes',

        ]);

    } 

    public function cvUpload(){
        if(!Auth::user()->isUser()){
            return view('admin.candidatures');
        }
        else{
            return redirect()->back();
        }
    }

    public function cvUploadPost(Request $request){
        //dd($request->cv_file);
        $request->validate([
            'nom_candidat' => 'required|string|max:255',
            'prenom_candidat' => 'required|string|max:255',
            'cv_file' => 'required|mimes:pdf,png,jpg,jpeg|max:20480',
        ]);

        $file_name = strtoupper($request->nom_candidat).'_'.strtoupper($request->prenom_candidat).'_'.date('Y-m-d').'.'.$request->cv_file->extension();
        //dd($file_name);
        $request->cv_file->move(public_path('cvs'),$file_name);

        $candidat = new Candidat;

        $candidat->nom_candidat = $request->nom_candidat;
        $candidat->prenom_candidat = $request->prenom_candidat;
        $candidat->emplacement = $file_name;

        $candidat->save();

        return back()
                ->with('success','Le candidat est téléchrgé avec succès.')
                ->with('cv_file',$file_name);

    }

    public function displayCvs(){
        $cv_emplacements = HelperController::parse_cv();
        return response()->json([
            'cv_emplacements'  => $cv_emplacements,
        ]);
    }

    public function deleteCV(Request $request)
    {  
        $file_name = $request->file_name;
        if(\File::exists(public_path('cvs/'.$file_name))){
            \File::delete(public_path('cvs/'.$file_name));
            
        }
        return response()->json([
            'deleted'  => 'yes',

        ]);

    } 


}
