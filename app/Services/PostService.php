<?php

namespace App\Services;

use App\Models\post;
use App\Models\category;
use App\Models\writter;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Resources\PostResource;

class PostService
{
    public function getAllPost()
    {
        $posts = post::where('deleted_at', null)->orderBy('created_at','desc')->with('category', 'writter')->get();
        if($posts){
            return PostResource::collection($posts);
        } else {
            return null;
        }
    }

    public function getOnePost($slug)
    {
        $post = post::where('deleted_at', null)->where('slug', $slug)->with('category', 'writter')->first();
        if($post){
            return new PostResource($post);
        } else {
            return null;
        }
    }

    public function storePost($data)
    {
        $category = category::where('uuid', $data['category_id'])->first();
        $writter = writter::where('uuid', $data['writter_id'])->first();
        
        $data['category_id'] = $category->id;
        $data['writter_id'] = $writter->id;

        $post = post::create($data);
        return $post;
    }

    public function updatePost($slug, $data)
    {
        $post = post::where('slug', $slug)->where('deleted_at', null)->first();

        try {
            if($post){
                $category = category::where('uuid', $data['category_id'])->first('id');
                if($category){
                    $data_update = array(
                        'category_id' => $category['id'],
                        'title' => $data['title'],
                        'post_content' => $data['post_content'],
                        'summary' => $data['summary'],
                        'slug' => Str::slug($data['title']),
                        'cover' => $data['cover'],
                        'tags' => $data['tags']
                    );
        
                    $post->update($data_update);

                    return $post;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function deletePost($slug, $writter_id)
    {
        $writter = writter::where('uuid', $writter_id)->first(['id']);
        $post = post::where('slug', $slug)->where('deleted_at', null)->first();

        try {
            if($post->writter_id == $writter->id){
                return $post->update(['deleted_at' => Carbon::now()]);
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }
}