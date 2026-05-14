<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\Muro;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function storePost(Request $request)
    {
        $request->validate([
            'content'  => 'required|string',
            'image'    => 'nullable|image|max:2048',
        ]);

        $muro = Muro::firstOrCreate(
            ['id_usuario' => auth()->user()->id_usuario]
        );

        $publicacion = Publicacion::create([
            'id_muro'   => $muro->id_muro,
            'contenido' => $request->content,
            'fecha'     => now()->toDateString(),
        ]);


        if ($request->hasFile('image')) {
            $ruta = $request->file('image')->store('publicaciones', 'public');

            Imagen::create([
                'id_publicacion' => $publicacion->id_publicacion,
                'imagen'         => $ruta,
            ]);
        }

        return redirect()->back()->with('success', 'Publicación creada.');
    } 

    public function destroyPost($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        foreach ($publicacion->imagenes as $img) {
            \Storage::disk('public')->delete($img->imagen);
            $img->delete();
        }

        $publicacion->delete();

        return redirect()->back()->with('success', 'Publicación eliminada.');
    }

    public function updatePost(Request $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $publicacion->update([
            'contenido' => $request->contenido,
        ]);

        return redirect()->back()->with('success', 'Publicación actualizada.');
    }

}
