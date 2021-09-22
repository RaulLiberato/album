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

    public function showAll()
    {
        $photos = Photo::all();

        return view('/pages/photo_list',['photos' => $photos]);
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

        //upload
        if($request->hasFile('photo') && $request->file('photo')){

          //salvando o caminho completo em uma variavel
          $upload = $this->uploadPhoto($request->photo);

          //dividindo a string em um array
          $directoryArray = explode(DIRECTORY_SEPARATOR,$upload);

          //adicionando o nome do arquivo ao atributo photo_url
          $photo->photo_url = $directoryArray[count($directoryArray)-1];
        }

        if($directoryArray){
          //inserindo no banco de dados
          $photo->save();
        }

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
        //retorna uma foto do banco de dados
        $photo = Photo::findOrFail($request->id);

        $photo->title = $request->title;
        $photo->date = $request->date;
        $photo->description = $request->description;
        $photo->photo_url = "teste";

        //alterando no banco de dados
        $photo->update();

        //redirecionar para a pagina
        return redirect('/photos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
  {
    //Retorna a foto do banco de dados
    $photo = Photo::findOrFail($id);

    //excluir o registro do armazenamento
    $this->deletePhoto($photo->photo_url);

    //excluir foto do banco de dados
    $photo->delete();

    //Redirecionar para a página de Fotos
    return redirect('/photos');
  }

  public function uploadPhoto($photo){

    //define um nome aleatorio para imagem baseado em data e hora atual
    $nomeFoto = sha1(uniqid(date('HisYmd')));

    //recupera a extensão do arquivo
    $extensao = $photo->extension();

    //nome do arquivo com extensao
    $nomeArquivo = "{$nomeFoto}.{$extensao}";

    //upload
    $upload = $photo->move(public_path("storage".DIRECTORY_SEPARATOR."photos"),$nomeArquivo);

    return $upload;

  }

  public function deletePhoto($fileName){
    //Verificar se o arquivo existe
    if(file_exists(public_path("storage".DIRECTORY_SEPARATOR."photos".DIRECTORY_SEPARATOR.$fileName))){

      //excluir foto
      unlink(public_path("storage".DIRECTORY_SEPARATOR."photos".DIRECTORY_SEPARATOR.$fileName));
    }
  }
}//fim do controler

