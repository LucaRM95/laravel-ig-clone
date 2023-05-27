<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }
    
    public function edit($id){
        $user = Auth::user();
        $image = Image::find($id);

        if($user && $image && $image->user->id == $user->id ){
            return view('image.create', array(
                'image_post' => $image
            ));
        }else{
            return redirect()->route('home');
        }
    } 

    public function upload(Request $request){
        $validate = $this->validate($request, array(
            'description' => ['string', 'max:255'],
            'image_path' => ['required', 'image']
        ));

        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Asignar valores al objeto
        $user_id = Auth::user()->id;
        $image = new Image();
        $image->user_id = $user_id;
        $image->image_path = null;
        $image->description = $description;

        //Subir imagen
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();
        return redirect()->route('home')->with([
            'message' => 'Post created successfully'
        ]);
    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail', array(
            'image' => $image
        ));
    }

    public function delete($id){
        $user = Auth::user();

        $image = Image::find($id);
        $likes = Like::where('image_id', $id)->get();
        $comments = Comment::where('image_id', $id)->get();

        if($user && $image->user->id == $user->id ){
            if(count($likes) > 0){ 
                foreach($likes as $like){ $like->delete(); }
            }
            if(count($comments) > 0){ 
                foreach($comments as $comment){ $comment->delete(); }
            }
            
            Storage::disk('images')->delete($image->image_path);
            $image->delete();

            return redirect()->route('profile', ['id' => $user->id])->with([
                'error' => false,
                'message' => 'Publicación eliminada'
            ]);
        }else{
            return redirect()->route('profile', ['id' => $user->id])->with([
                'error' => true,
                'message' => 'Hubo un problema al intentar eliminar el post'
            ]);
        }
    }

    public function update(Request $request){
        $validate = $this->validate($request, array(
            'description' => ['string', 'max:255'],
            'image_path' => ['image']
        ));

        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        $image = Image::find($image_id);
        $image->description = $description;

        //Subir imagen
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->update();

        return redirect()->route('detail', ['id' => $image_id])->with(array(
            'message' => 'Post actualizado'
        ));
    }

    public function explore(){
        $images = Image::orderBy('id', 'desc')->get();

        return view('user.explore', array(
            'images' => $images
        ));
    }
}
