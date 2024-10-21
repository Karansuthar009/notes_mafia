<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Favorite;
use App\Models\State;
use App\Models\Uploadfile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request, $username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404, 'User not found');
        }

        $files = Uploadfile::where('user_id', $user->id)->get();
        $allfiles = $files->where('category');
        $userPdfPaths = $files->where('category', 'Pdf');
        $oldpaperPaths = $files->where('category', 'Old Paper');
        $notespaths = $files->where('category', 'Notes');
        $favoriteItems = Uploadfile::whereIn('id', Favorite::where('user_id', $user->id)->where('status', true)->pluck('file_id'))->get();

        return view('profile.profile', [
            'users' => $user,
            'files' => $files,
            'userPdfPaths' => $userPdfPaths,
            'notespaths' => $notespaths,
            'oldpaperPaths' => $oldpaperPaths,
            'favoriteItems' => $favoriteItems,
            'allfiles' => $allfiles
        ]);
    }



    public function update_profile(Request $request, $id)
    {
        $users = User::find($id);
        // dd($users);
        $state = State::all();
        $cities = City::all();
        return view('profile.update_profile', compact('users', 'state','cities'));
    }
    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        return response()->json(['cities' => $cities]);
    }

    public function updateprofile(Request $request, $id)
    {
        // Handle the file upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $fileName, 'public');
        } else {
            $filePath = null;
        }

        $uploadfile = Uploadfile::where('user_id', $id)->first();
        if ($uploadfile) {
            $uploadfile->username = $request->username;
            $uploadfile->save();
        }

        $users = User::find($id);
        if ($users) {
            $users->name = $request->name;
            $users->username = $request->username;
            $users->email = $request->email;
            $users->mobile_num = $request->mobile_num;
            $users->profession = $request->profession;
            $users->gender = $request->gender;
            $users->state_id = $request->state_id;
            $users->city_id = $request->city_id;
            if ($filePath) {
                $users->photo = $filePath;
            }
            $users->update();
        }

        $files = Uploadfile::where('user_id', $users->id)->get();
        $allfiles = $files->where('category');
        $userPdfPaths = $files->where('category', 'Pdf');
        $oldpaperPaths = $files->where('category', 'Old Paper');
        $notespaths = $files->where('category', 'Notes');
        $favoriteItems = Uploadfile::whereIn('id', Favorite::where('user_id', $users->id)->where('status', true)->pluck('file_id'))->get();

        return view('profile.profile', [
            'users' => $users,
            'files' => $files,
            'userPdfPaths' => $userPdfPaths,
            'notespaths' => $notespaths,
            'oldpaperPaths' => $oldpaperPaths,
            'favoriteItems' => $favoriteItems,
            'allfiles' => $allfiles
        ]);
    }

    public function old_paper($id)
    {
        $files = Uploadfile::where('user_id', $id)->first();
        $user = User::where('id',$files->user_id)->first();

        $file = Uploadfile::where('user_id', $id)->get();
        $allfiles = $file->where('category');
        $userPdfPaths = $file->where('category', 'Pdf');
        $oldpaperPaths = $file->where('category', 'Old Paper');
        $notespaths = $file->where('category', 'Notes');

        return view('profile.oldpaper', [
            'users' => $user,
            'files' => $file,
            'allfiles' => $allfiles,
            'userPdfPaths' => $userPdfPaths,
            'oldpaperPaths' => $oldpaperPaths,
            'notespaths' => $notespaths

        ]);
    }

    public function allfiles($id)
    {
        $files = Uploadfile::where('user_id', $id)->first();
        $user = User::where('id',$files->user_id)->first();
        $file = Uploadfile::where('user_id', $id)->get();
        $allfiles = $file->where('category');
        $userPdfPaths = $file->where('category', 'Pdf');
        $oldpaperPaths = $file->where('category', 'Old Paper');
        $notespaths = $file->where('category', 'Notes');

        return view('profile.allfiles', [
            'users' => $user,
            'files' => $file,
            'allfiles' => $allfiles,
            'userPdfPaths' => $userPdfPaths,
            'oldpaperPaths' => $oldpaperPaths,
            'notespaths' => $notespaths

        ]);
    }

    public function notes($id)
    {
        $files = Uploadfile::where('user_id', $id)->first();
        $user = User::where('id',$files->user_id)->first();
        $file = Uploadfile::where('user_id', $id)->get();
        $allfiles = $file->where('category');
        $userPdfPaths = $file->where('category', 'Pdf');
        $oldpaperPaths = $file->where('category', 'Old Paper');
        $notespaths = $file->where('category', 'Notes');

        return view('profile.notes', [
            'users' => $user,
            'files' => $file,
            'allfiles' => $allfiles,
            'userPdfPaths' => $userPdfPaths,
            'oldpaperPaths' => $oldpaperPaths,
            'notespaths' => $notespaths

        ]);
    }
    public function allpdf($id)
    {
        $files = Uploadfile::where('user_id', $id)->first();
        $user = User::where('id',$files->user_id)->first();
        $file = Uploadfile::where('user_id', $id)->get();
        $allfiles = $file->where('category');
        $userPdfPaths = $file->where('category', 'Pdf');
        $oldpaperPaths = $file->where('category', 'Old Paper');
        $notespaths = $file->where('category', 'Notes');

        return view('profile.allpdf', [
            'users' => $user,
            'files' => $file,
            'allfiles' => $allfiles,
            'userPdfPaths' => $userPdfPaths,
            'oldpaperPaths' => $oldpaperPaths,
            'notespaths' => $notespaths

        ]);
    }

    public function favorite($id)
    {
        $files = Uploadfile::where('user_id', $id)->first();
        $user = User::where('id',$files->user_id)->first();
        $file = Uploadfile::where('user_id', $id)->get();
        $allfiles = $file->where('category');
        $userPdfPaths = $file->where('category', 'Pdf');
        $oldpaperPaths = $file->where('category', 'Old Paper');
        $notespaths = $file->where('category', 'Notes');
        $favorites = Favorite::where('user_id', $id)->with('files')->get();

        return view('profile.favorite', [
            'users' => $user,
            'files' => $file,
            'allfiles' => $allfiles,
            'userPdfPaths' => $userPdfPaths,
            'oldpaperPaths' => $oldpaperPaths,
            'notespaths' => $notespaths,
            'favorites' => $favorites
        ]);
    }
}
