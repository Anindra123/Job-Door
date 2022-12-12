<?php

namespace App\Http\Controllers;

use App\Models\CVModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CVController extends Controller
{
    public function getForm()
    {
        return view('cv');
    }

    public function uploadFile(Request $req)
    {
        $this->validate($req, [
            'cv' => 'required|file|mimes:doc,docx,pdf|max:2048',
        ]);
        $pathFile = null;
        $saveFile = null;
        if ($req->hasFile('cv')) {
            $file_name = $req->file('cv')->getClientOriginalName();
            $fileName = pathinfo($file_name, PATHINFO_FILENAME);
            $updatedFileName = str_replace(' ', '_', $fileName);
            $ext = $req->file('cv')->getClientOriginalExtension();
            $saveFile = $updatedFileName . '_' . time() . '.' . $ext;
            $pathFile = $req->file('cv')->storeAs('cv', $saveFile);
        }

        $cv = new CVModel();
        $cv->cv_file_name = $saveFile;
        $cv->cv_file_path = $pathFile;
        $cv->pr_id = session()->get('prid');
        $cv->save();
        // dd(1);
        return redirect('portfolio');
    }

    public function downloadFile()
    {
        $cv = new CVModel();
        $file = $cv->where('pr_id', session()->get('prid'))->first();
        // $path = public_path($file->cv_file_path);
        // return response()->download($path);
        if (Storage::disk('local')->exists($file->cv_file_path)) {
            $path = Storage::disk('local')->path($file->cv_file_path);
            $content = file_get_contents($path);
            return response($content)->withHeaders([
                'Content-Type' => mime_content_type($path),
            ]);
        }
        return redirect('/404');
    }

    public function downloadCV($id = null)
    {
        $cv = new CVModel();
        $file = $cv->where('pr_id', $id)->first();
        // $path = public_path($file->cv_file_path);
        // return response()->download($path);
        if (Storage::disk('local')->exists($file->cv_file_path)) {
            $path = Storage::disk('local')->path($file->cv_file_path);
            $content = file_get_contents($path);
            return response($content)->withHeaders([
                'Content-Type' => mime_content_type($path),
            ]);
        }
        return redirect('/404');
    }

    public function deleteFile()
    {
        $cv = new CVModel();
        $file = $cv->where('pr_id', session()->get('prid'))->first();

        if (Storage::disk('local')->exists($file->cv_file_path)) {

            unlink(storage_path('app/' . $file->cv_file_path));
            $file->delete();
            return redirect('portfolio');
        }
        return redirect('/404');
    }

    public function updateFileForm()
    {
        $cv = new CVModel();
        $file = $cv->where('pr_id', session()->get('prid'))->first();
        $path = Storage::disk('local')->path($file->cv_file_path);
        return view('updateCV')->with('path', $path);
    }

    public function updateFile(Request $req)
    {
        $cv = new CVModel();
        $file = $cv->where('pr_id', session()->get('prid'))->first();
        if (Storage::disk('local')->exists($file->cv_file_path)) {
            unlink(storage_path('app/' . $file->cv_file_path));
            $file->delete();
        }

        $this->validate($req, [
            'cv' => 'required|file|mimes:doc,docx,pdf|max:2048',
        ]);
        $pathFile = null;
        $saveFile = null;
        if ($req->hasFile('cv')) {
            $file_name = $req->file('cv')->getClientOriginalName();
            $fileName = pathinfo($file_name, PATHINFO_FILENAME);
            $updatedFileName = str_replace(' ', '_', $fileName);
            $ext = $req->file('cv')->getClientOriginalExtension();
            $saveFile = $updatedFileName . '_' . time() . '.' . $ext;
            $pathFile = $req->file('cv')->storeAs('cv', $saveFile);
        }

        // $cv = new CVModel();
        $file->cv_file_name = $saveFile;
        $file->cv_file_path = $pathFile;
        $file->pr_id = session()->get('prid');
        $file->save();
        // dd(1);
        return redirect('portfolio');
    }
}
