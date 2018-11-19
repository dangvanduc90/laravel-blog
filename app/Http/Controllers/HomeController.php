<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Country;
use App\Events\OrderShipped;
use App\Flight;
use App\Http\Resources\UserCollection;
use App\Phone;
use App\Post;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function mutators()
    {
        $user = User::find(13);

        $user->first_name = 'Sally';
        $firstName = $user->first_name;

        dd($firstName);
    }

    public function show($id)
    {
//        DB::enableQueryLog();
        /* Relationships */
//        $user = User::find($id)->phone; // One To One

//        $user = User::find($id)->flight; // One To Many

//        $user = Flight::find($id)->user; // Inverse Of The Relationship One To Many

//        $user = Phone::find($id)->user; // Inverse Of The Relationship One To One

//        $user = Role::find(1)->users; // Many To Many

//        $user = User::find(36)->roles; // Many To Many

//        $user = Country::find(1)->posts; // Has Many Through

//        $user = Post::find(1)->comments; // Polymorphic Relations

//        $user = Post::find(1)->tags ; // Many To Many Polymorphic Relations
//        $user = Post::whereHas('comments', function ($query) { // Querying Relationship Absence
//            $query->where('body', 'like', '%W7W54crThsYdroDioMmWdsnniPrCjTVpN3Ho3VXbMyAAgeshzV%');
//        })->get();
//        $user = Post::withCount(['comments' => function ($query) {
//            $query->where('body', '=', 'W7W54crThsYdroDioMmWdsnniPrCjTVpN3Ho3VXbMyAAgeshzV');
//        }])->get(); // Counting Related Models

//        $user = Post::with(['user'])->get(); // Eager Loading Multiple Relationships
//        $user = User::with(['posts' => function ($query) {
//            $query->orderBy('created_at', 'desc');
//        }])->get();

//        $comment = new Comment([ // Inserting Related Models
//            'body' => 'Proin eget tortor risus.',
//            'commentable_id' => 1,
//            'commentable_type' => 'App\Post',
//        ]);
//        $post = Post::find(1);
//        $post->comments()->save($comment);

//        $post = Post::find(4); // Update $post Belongs To Relationships
//        $user = User::find(5);
//        $post->user()->associate($user);
//        $post->save();

//        $user = User::find(2); // Attaching Many To Many Relationships
//        $roleId = 3;
//        $user->roles()->attach($roleId);

        User::find(1)->update(['name'=>'dangvanduc222 3']);
        $user = User::find(1);
//        $comment->body = 'Edit to this comment!';
//        $comment->save();
//        $user->name = 'dangvanduc90';
//        $user->save();
        return $user;

        /* Collections */
//        return UserCollection::collection(User::paginate()); // Pagination
//        return UserCollection::make(User::find($id)); // one record
//        return UserCollection::collection(User::all()); // multiple record
    }
}
