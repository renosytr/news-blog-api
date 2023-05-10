<?php

namespace App\Services;

use App\Models\writter;
use App\Models\reader;
use App\Models\User;
use App\Http\Resources\WritterResource;
use App\Http\Resources\ReaderResource;

class UserService
{
    // witter service
    public function getAllWritter()
    {
        try {
            $writters = writter::orderBy('created_at','desc')->get();
            return WritterResource::collection($writters);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getOneWritter($id)
    {
        try {
            $user = User::where('deleted_at', null)->where('uuid', $id)->first('writter_id');
            $writter = writter::where('id', $user->writter_id)->first();
            if($writter){
                return new WritterResource($writter);
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function storeWritter($data)
    {
        $writter = writter::create($data);
        return $writter;
    }
    
    public function updateWritter($id, $data)
    {
        try {
            $writter = writter::where('uuid', $id)->update($data);
            return $writter;
        } catch (\Throwable $th) {
            return null;
        }
    }

    // reader service
    public function getAllReader()
    {
        try {
            $reader = reader::orderBy('created_at','desc')->get();
            return ReaderResource::collection($reader);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getOneReader($id)
    {
        try {
            $user = User::where('deleted_at', null)->where('uuid', $id)->first('reader_id');
            $reader = reader::where('id', $user->reader_id)->first();
            return new ReaderResource($reader);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function storeReader($data)
    {
        $reader = reader::create($data);
        return $reader;
    }
    
    public function updateReader($id, $data)
    {
        try {
            $reader = reader::where('uuid', $id)->update($data);
            return $reader;
        } catch (\Throwable $th) {
            return null;
        }
    }
}