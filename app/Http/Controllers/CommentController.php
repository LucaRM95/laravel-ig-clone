<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){
        $validate = $this->validate($request, array(
            'image_id'=> ['integer', 'required'],
            'content' => ['string', 'required']
        ));
        
        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();
        return redirect()->route('detail', ['id' => $image_id])->with([
            'message' => 'Has publicado tu comentario'
        ]);
    }

    public function delete($id){
        $user = Auth::user();
        
        $comment = Comment::find($id);

        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();

            return redirect()->route('detail', ['id' => $comment->image->id])->with([
                'message' => 'Comentario eliminado'
            ]);
        }else{
            return redirect()->route('detail', ['id' => $comment->image->id])->with([
                'message' => 'Hubo un problema al intentar eliminar tu comentario'
            ]);
        }
    }
}
