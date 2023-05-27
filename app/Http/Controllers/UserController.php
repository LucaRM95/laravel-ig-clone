<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){
        $user = Auth::user();
        $id = $user->id;
        
        $validate = $this->validate($request, array(
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:200'],
            'nick' => ['required', 'string', 'max:100', 'unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        ));
        
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //Subir imagen
        $image_path = $request->file('image_path');
        if($image_path){
            //Asignarle nombre único
            $image_path_name = time().$image_path->getClientOriginalName();

            //Guardar en la carpeta storage (sotrage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //Set al nombre de la imagen en el obj
            $user->image = $image_path_name;
        }

        $user->update();
        return redirect()->route('config')
                ->with(['message'=> 'Usuario actualizado correctamente']);
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);

        return Response($file, 200);
    }

    public function profile($id){
        $user = User::find($id);

        return view('user.profile', array(
            'user' => $user
        ));
    }

    public function search_view(){

        return view('user.search');
    }

    public function search(Request $request){
        $validate = $this->validate($request, array(
            'search' => ['required', 'string', 'max:100']
        ));
        
        $search = $request->input('search');

        $users_search = User::where('name', 'like', '%'.$search.'%')
                    ->orWhere('surname', 'like', '%'.$search.'%')
                    ->orWhere('nick', 'like', '%'.$search.'%')
                    ->get();

        return view('user.search', array(
            'search' => $users_search
        ));
    }
}
