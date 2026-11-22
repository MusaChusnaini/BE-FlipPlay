<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;

class UserCollectionController extends Controller
{
    // GET /api/users/{user}/collections
    public function index(User $user)
    {
        $user->load('media');

        return new UserResource($user);
    }

    // POST /api/users/{user}/collections
    public function addToCollection(Request $request, User $user)
    {
        $validated = $request->validate([
            'media_id' => 'required|integer|exists:media,id',
        ], [
            'media_id.required' => 'ID media wajib diisi.',
            'media_id.exists'   => 'Media tidak ditemukan di sistem.',
        ]);

        $mediaId = $validated['media_id'];

        // Cek duplikasi: jika media sudah ada di koleksi user, kembalikan status 409
        if ($user->media()->where('media_id', $mediaId)->exists()) {
            return response()->json([
                'message' => 'Media sudah ada di dalam koleksi pengguna.'
            ], 409);
        }

        $user->media()->attach($mediaId);
        $user->load('media');

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi pengguna.',
            'data'    => new UserResource($user),
        ], 201);
    }

    // DELETE /api/users/{user}/collections/{media}
    public function removeFromCollection(User $user, Media $media)
    {
        // Pastikan media memang ada di koleksi user tersebut
        if (!$user->media()->where('media_id', $media->id)->exists()) {
            return response()->json([
                'message' => 'Media tidak ditemukan di dalam koleksi pengguna ini.'
            ], 404);
        }

        $user->media()->detach($media->id);

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi pengguna.'
        ], 200);
    }
}
