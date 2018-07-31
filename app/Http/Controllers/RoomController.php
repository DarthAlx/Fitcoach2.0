<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function store(Request $request)
    {
      $guardar = new Room($request->all());

      if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


          $name = $request->nombre . time() . "." . $file->getClientOriginalExtension();
          $path = base_path('uploads/rooms/');

          $file-> move($path, $name);

          
          $guardar->imagen = $name;

          $guardar->save();
          Session::flash('mensaje', 'Room guardado correctamente!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/rooms'));
        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/rooms'))->withInput();
        }

      }
      else{
        Session::flash('mensaje', 'El archivo no es una imagen valida.');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/rooms'))->withInput();
      }
    }
public function update(Request $request)
    {
        $room = Room::find($request->room_id);

      if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


          $name = $request->nombre . time() . "." . $file->getClientOriginalExtension();
          $path = base_path('uploads/rooms/');

          $file-> move($path, $name);

          $room->imagen = $name;

          
        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/rooms'))->withInput();
        }

      }


      $room->nombre=$request->nombre;
      $room->descripcion= $request->descripcion;
      $room->save();
      Session::flash('mensaje', 'Room actualizado correctamente!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/rooms'));

    }
public function destroy(Request $request)
    {
        $room = Room::find($request->room_id);
        $path = base_path('uploads/rooms/');
        File::delete($path . $room->imagen);
        $room->delete();
        Session::flash('mensaje', '¡Room eliminado correctamente!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/rooms'));
    }
}
