<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//importanto o model
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('/pages/home',['photos'=>$photos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('pages/photo_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //criação do objeto Photo
        $photo = new Photo();

        //aletarndo os atributos do objeto
        $photo->title = $request->title;
        $photo->date = $request->date;
        $photo->description = $request->description;
        $photo->photo_url = "teste";

        //inserindo no banco de dados para a pagina inicial
        $photo->save();

        //redirecionar pata a pagina
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);

        return view('pages/photo_form',['photo'=>$photo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($request->id);

        $photo->title = $request->title;
        $photo->date = $request->date;
        $photo->description = $request->description;
        $photo->photo_url = "teste";

        //alterando no banco de dados
        $photo->update();

        //redirecionar pata a pagina
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
