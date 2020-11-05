<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::latest()->get();
        return response([
            'success'   => true,
            'message'   => 'List Semua Post',
            'data'      => $posts
        ], 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ],
            [
                'title.required' => 'Masukkan Title Post !',
                'content.required' => 'Masukkan Content Post !',
            ]
        );

        if($validator->fails()){
            return response()->json([
                'success'   => false,
                'message'   => 'Silakan isi bidang kosong!',
                'data'      => $validator->errors()
            ], 400);
        } else{
            $post = Post::create([
                'title'     => $request->title,
                'content'   => $request->content
            ]);

            if($post){
                return response()->json([
                    'success'       => true,
                    'message'       => 'Post berhasil ditambahkan!'
                ], 200);
            } else{
                return response()->json([
                    'success'       => false,
                    'message'       => 'Post gagal ditambahkan!'
                ], 200);
            }
        }
    }

    public function show($id) {
        $post = Post::whereId($id)->first();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post!',
                'data'    => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ],
            [
                'title.required' => 'Masukkan Title Post !',
                'content.required' => 'Masukkan Content Post !',
            ]
        );

        if($validator->fails()){
            return response()->json([
                'success'   => false,
                'message'   => 'Silakan isi bidang kosong!',
                'data'      => $validator->errors()
            ], 400);
        } else{
            $post = Post::whereId($id)->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);

            if($post){
                return response()->json([
                    'success'       => true,
                    'message'       => 'Post berhasil diupdate!'
                ], 200);
            } else{
                return response()->json([
                    'success'       => false,
                    'message'       => 'Post gagal diupdate!'
                ], 200);
            }
        }
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Dihapus!',
            ], 500);
        }
    }
}
