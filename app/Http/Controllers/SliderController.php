<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
class SliderController extends Controller
{
  public function store(Request $request){


        if ($request->hasFile('image')) {
          $file = $request->file('image');
          if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


            $name = "Slide" . $request->order . "." . $file->getClientOriginalExtension();
            $path = base_path('images/content/');

            $file-> move($path, $name);

            $guardar = new Slider($request->all());
            $guardar->image = $name;

            $guardar->save();
            Session::flash('mensaje', 'Slide guardado correctamente!');
            Session::flash('class', 'success');
            return redirect()->intended(url('/slides'));
          }
          else{
            Session::flash('mensaje', 'El archivo no es una imagen valida.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/slides'));
          }

        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/slides'));
        }
      }
      public function update(Request $request, $id)
      {


        if ($request->hasFile('image')) {
          $file = $request->file('image');
          if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
            $name = "Slide" . $request->order . "." . $file->getClientOriginalExtension();
            $path = base_path('images/content/');
            $file-> move($path, $name);
            $slide = Slider::find($id);
            File::delete($path . $slide->image);
            $slide->image = $name;
            $slide->description = $request->description;
            $slide->order = $request->order;
            $slide->save();


            Session::flash('mensaje', '¡Slide actualizado!');
            Session::flash('class', 'success');
            return redirect()->intended(url('/slides'));
          }
          else{
            Session::flash('mensaje', 'El archivo no es una imagen valida.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/slides'));
          }

        }
        else{
          $slide = Slider::find($id);
          $slide->description = $request->description;
          $slide->order = $request->order;
          $slide->save();
          Session::flash('mensaje', '¡Slide actualizado!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/slides'));
        }








      }

      public function destroy(Request $request, $id)
      {
          $path = base_path('images/content/');
          $slide =Slider::find($id);
          File::delete($path . $slide->image);
          $slide->delete();
          Session::flash('mensaje', '¡Slide eliminado correctamente!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/slides'));
      }
}
