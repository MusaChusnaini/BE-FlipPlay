<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255|unique:media,title',
            'type'         => 'required|in:movie,music,game,series',
            'genre'        => 'required|string|max:100',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'description'  => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'        => 'Judul media wajib diisi.',
            'title.unique'          => 'Judul media sudah terdaftar di sistem FlipPlay.',
            'type.required'         => 'Jenis media wajib diisi.',
            'type.in'               => 'Jenis media harus salah satu dari: movie, music, game, atau series.',
            'genre.required'        => 'Genre media wajib diisi.',
            'release_year.required' => 'Tahun rilis wajib diisi.',
            'release_year.integer'  => 'Tahun rilis harus berupa angka.',
        ];
    }
}
