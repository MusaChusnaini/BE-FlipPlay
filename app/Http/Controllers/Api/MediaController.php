<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    // GET /api/media (mendukung filter ?title=...)
    public function index(Request $request)
    {
        $media = Media::searchTitle($request->query('title'))
            ->latest()
            ->paginate(10);

        return MediaResource::collection($media);
    }

    // POST /api/media
    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());

        return (new MediaResource($media))
            ->response()
            ->setStatusCode(201);
    }

    // GET /api/media/{media} (menampilkan detail media + user yang mengoleksinya)
    public function show(Media $medium)
    {
        $medium->load('users');

        return new MediaResource($medium);
    }

    // PATCH /api/media/{media}
    public function update(UpdateMediaRequest $request, Media $medium)
    {
        $medium->update($request->validated());

        return new MediaResource($medium);
    }

    // DELETE /api/media/{media}
    public function destroy(Media $medium)
    {
        $medium->delete();

        return response()->json([
            'message' => 'Media berhasil dihapus dari sistem FlipPlay.'
        ], 200);
    }
}
