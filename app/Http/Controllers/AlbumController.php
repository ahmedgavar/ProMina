<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Http\Traits\PhotosTrait;
use App\Models\Album;
use Exception;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    use PhotosTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            $albums = Album::orderBy('id', 'desc')->get();

            return view('albums.index', ['albums' => $albums]);

        } catch (Exception $ex) {
            return redirect()->route('users.login_page')->with(['error' => ' حدث خطأ  ما']);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request)
    {
        //
        // try...catch

        try {

            $album_name = $request->only('name');
            $album = Album::create([
                'name' => $album_name['name'],
            ]);

            foreach ($request->file('images') as $image) {

                $this->saveImg($image, $album);
            }

            return redirect()->route('albums.index')->with(['success' => 'تم الحفظ بنجاح']);

            // Do your SQL here
        } catch (Exception $e) {
            return redirect()->route('albums.create')->with(['error' => ' حدث خطأ  ما']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $album = Album::findOrFail($id);

        return view('albums.show', ['album' => $album]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $album = Album::findOrFail($id);
        return view('albums.edit', ['album' => $album]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAlbumRequest $request, $id)
    {
        //
        try {
            $album = Album::findOrFail($id);

            $album_name = $request->only('name');
            $album->name = $album_name['name'];
            $album->save();
            if ($request->hasFile('images')) {

                // $this->saveImg($request->file('images'), $album);
                $this->updateImages($request->file('images'), $album);
                return redirect()->route('albums.index')->with(['success' => 'تم الحفظ بنجاح']);

            } else {
                return redirect()->route('albums.create')->with(['error' => ' حدث خطأ  ما']);

            }
            $this->save_updateImg($request->file('images'), $album);

            // Do your SQL here
        } catch (Exception $e) {
            return redirect()->route('albums.index')->with(['error' => ' حدث خطأ  ما']);
        }

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
        $album = Album::findOrFail($id);
        $this->deleteImages($album);
        $album->delete();
    }
}
