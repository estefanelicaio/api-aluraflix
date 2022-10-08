<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $videos = Video::query();

        if($request->has('name')) {
            $videos->where('title', 'like', "%{$request->name}%");
        }

        return $videos->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        $video = Video::create($request->all());

        return response()->json($video, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $video = Video::find($id);

        if(!$video) {
            return response()->json(['mensagem' => 'Vídeo não encontrado'], 404);
        }

        return $video;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, int $id)
    {
        $video = Video::find($id);

        if(!$video) {
            return response()->json(['mensagem' => 'Vídeo não encontrado'], 404);
        }

        $video->update($request->all());
        return $video;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if(Video::destroy($id)) {
            return response()->json(['mensagem' => 'Video excluído com sucesso']);
        }

        return response()->json(['mensagem' => 'Vídeo não encontrado'], 404);
    }
}
