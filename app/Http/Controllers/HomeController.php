<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Bb;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private const BB_VALIDATOR = [
        'title' => 'required|max:50',
        'content' => 'required',
        'image'=>'image:jpeg,png,jpg',
        'music' => 'file|mimes:mp3,ogg,wav|max:10240',
        'price'=>'required|numeric|min:0',
    ];
    private const USER_VALIDATOR = [
        'name' => ['required', 'string', 'max:255'],
        'image'=>['image','mimes:jpeg,png,jpg','max:1080'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',['bbs'=>Auth::user()->bbs()->latest()->get(),'user'=>Auth::user()]);
    }

    public function create(){
        return view('bb_create');
    }

    public function store(Request $request){
        $validated = $request->validate(self::BB_VALIDATOR);
        $path = 'cover/img.png';
        $musicPatch = 'music/трымбалон.mp3';
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/cover');
        }
        if ($request->hasFile('music')) {
            $musicPatch = $request->file('music')->store('music');
        }
        Auth::user()->bbs()->create([
            'title'=>$validated['title'],
            'content'=>$validated['content'],
            'image'=>$path,
            'music'=>$musicPatch,
            'price'=>$validated['price'],
        ]);
        return redirect()->route('home');
    }

    public function edit(Bb $bb){
        return view('bb_edit',['bb'=>$bb]);
    }
    public function update(Request $request,Bb $bb){
        $validated = $request->validate(self::BB_VALIDATOR);
        $path = 'cover/img.png';
        $musicPatch = 'music/трымбалон.mp3';
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/cover');
        }
        if ($request->hasFile('music')) {
            $musicPatch = $request->file('music')->store('music');
        }
        $bb->fill([
            'title'=>$validated['title'],
            'content'=>$validated['content'],
            'image'=>$path,
            'music'=>$musicPatch,
            'price'=>$validated['price'],
            ]);
        $bb->save();
        return redirect()->route('detail',$bb->id);
    }

    public function destroy(Bb $bb){
        $bb->delete();
        return back();
    }
    public function UpdateAvatar(Request $request,User $user)
    {
        $path = $user->image;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/cover');
        }
        $user->fill(['image'=>$path]);
        $user->save();
        return back();
    }
    public function UpdateProfile(Request $request, User $user)
    {
        $validated = $request->validate(self::USER_VALIDATOR);
        dd($validated);
        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        $user->save();
        return back();
    }
}
