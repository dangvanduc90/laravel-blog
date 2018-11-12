<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
use App\User;
use Illuminate\Http\Request;
use \Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        return view('home');
    }

    /**
     *
     */
    public function ship()
    {
        $user = User::findOrFail(13);

        // dispatch User event
        event(new OrderShipped($user));
    }

    public function uploadFileStorage()
    {
        return view('file.storage');
    }

    public function fileStorage(Request $request)
    {
////        upload file
//        Storage::disk('local')->put('file1.txt', 'Contents');

////        get content of specific file
//        $contents = null;
//        try {
//            $contents = Storage::get('file.txt');
//        } catch (\Exception $e) {
//            \Log::error($e->getMessage());
//        }

//        // get all files
//        $files = Storage::files(); // all file with nest folder using allFiles method
//        dd($files);

        // storage file upload
        $file = $request->file('avatar');
        $path = $file->store('avatars');
        dd($path);
    }

    public function collections()
    {
        $users = User::all();

        $names = $users->reject(function ($user) {
            return $user->active === false;
        })
            ->map(function ($user) {
                return $user->name;
            });

        $email = $users->map(function ($user) {
            return $user->email;
        });
        dd($users->min(function ($user) {
            return $user->id;
        }));
    }
}
