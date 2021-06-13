<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use  Storage;
class PhotosController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');
     $this->authorizeResource(Photo::class);
    }

    protected $rules = [

        'album_id' => 'bail|required|integer|exists:albums,id',
        'name' => 'required',
        'img_path' => 'bail|required|image'
    ];
 protected $messages = [
     'album_id.required' => 'Il campo album è obbligatorio',
     'description.required' => 'Il campo Descrizione è obbligatorio',
     'name.required' => 'Il campo Nome è obbligatorio',
     'img_path.required' => 'Il campo Immagine è obbligatorio'

 ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $album = $req->album_id? Album::findOrFail($req->album_id): new Album();
        $photo = new Photo();
        $albums = $this->getAlbums();
       return view('images.editimage', compact('album','photo','albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, $this->rules, $this->messages);
        $photo = new Photo();
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $photo->album_id = $request->input('album_id');


        $this->processFile($photo);
        $photo->save();
        return redirect(route('albums.images',$photo->album_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
       dd($photo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        $albums = $this->getAlbums();
        $album = $photo->album;
        return view('images.editimage', compact('photo','albums','album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {

        unset( $this->rules ['img_path']);
        $this->validate($request, $this->rules, $this->messages);
        $this->processFile($photo);
        $photo->album_id = $request->input('album_id');
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $res =  $photo->save();
        $messaggio = $res ? 'Image   ' .  $photo->name . ' Updated' : 'Image ' .   $photo->name . ' was not updated';
        session()->flash('message', $messaggio);
        return redirect()->route('albums.images', $photo->album_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $res =  $photo->delete();
        if($res){
            $this->deleteFile($photo) ;
        }
        return ''.$res;
    }
    public function processFile(Photo $photo,  Request $req = null )
    {
        if(!$req){
            $req = request();
        }
        if(!$req->hasFile('img_path') ){
            return false;
        }
        $file = $req->file('img_path');
        if(!$file->isValid()){
            return false;
        }
        $imgName = preg_replace('@[a-z0-9]i@','_', $photo->name);

        $fileName = $imgName. '.' . $file->extension();
        $file->storeAs(env('IMG_DIR').'/'.$photo->album_id, $fileName);
        $photo->img_path = env('IMG_DIR') .$photo->album_id .'/'.$fileName;

        return  true;



    }
    public function deleteFile(Photo $photo)
    {
        $disk = config('filesystems.default');
        // let's remove the storage string we added in the Model
        $imgPath = str_replace('storage', '',$photo->img_path);
        if($imgPath && Storage::disk($disk)->has($imgPath)){
            // let's remove the storage
            return   Storage::disk($disk)->delete($imgPath);
        }
        return false;
    }
    public function getAlbums()
    {
        return Album::whereUserId(Auth::id())->orderBy('album_name')->get();
    }
}
