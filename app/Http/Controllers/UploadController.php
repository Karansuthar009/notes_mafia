<?php

namespace App\Http\Controllers;

use App\Models\CollageData;
use App\Models\Course;
use App\Models\LikeDislike;
use App\Models\Subject;
use App\Models\Uploadfile;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload_file(Request $request)
    {
        $course = Course::all();
        return view('uploadpdf', compact('course'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $universities = CollageData::where('College_Name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(['id', 'College_Name']);

        return response()->json($universities);
    }

    public function getSubjects($courseId)
    {
        $subjects = Subject::where('course_id', $courseId)->get();
        return response()->json(['subjects' => $subjects]);
    }


    public function uploadfile(Request $request)
    {
        $filePath = null;

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $filename, 'public');
        }

        $user = Auth()->user();
        $upload = new Uploadfile();
        $upload->file_path = $filePath;
        $upload->description = $request->description;
        $upload->title = $request->title;
        $upload->semester = $request->semester;
        $upload->category = $request->category;
        $upload->course = $request->course;
        $upload->subject = $request->subject;
        $upload->year = $request->year;
        $upload->username = $user->username;
        $upload->college = $request->college;
        $upload->user_id = $user->id;
        $upload->save();

        return redirect('/');
    }

    public function edit_upload_file(Request $request, $id)
    {
        $data = Uploadfile::find($id);
        $colleges = Uploadfile::all();
        $course = Course::all();
        $subject = Subject::all();
        return view('edituploadpdf', compact('course','data','colleges','subject'));
    }

    public function edituploadfile(Request $request, $id)
    {
        $filePath = null;

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $filename, 'public');
        }
        // dd($filePath);

        $user = Auth()->user();
        $upload = Uploadfile::find($id);
        $upload->file_path = $filePath;
        $upload->description = $request->description;
        $upload->title = $request->title;
        $upload->semester = $request->semester;
        $upload->category = $request->category;
        $upload->course = $request->course;
        $upload->subject = $request->subject;
        $upload->year = $request->year;
        $upload->username = $user->username;
        $upload->college = $request->college;
        $upload->user_id = $user->id;
        $upload->update();

        return redirect('/');
    }

    public function deleteuploadfile($id)
    {
        Uploadfile::destroy($id);
        return redirect('/');
    }


    public function show($id)
    {
        $data = Uploadfile::find($id);

        if ($data) {
            $data->view += 1;
            $data->save();

            $pathToFile = storage_path('app/public/' . $data->file_path);

            return view('pdf', ['pdfPath' => $pathToFile,'data'=>$data]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }
 
}
