<?php

namespace App\Services;

use App\Models\category;
use App\Models\User;

class CategoryService
{
    public function getAllCategory()
    {
        $categories = category::orderBy('created_at','desc')->get(['uuid', 'name', 'icon']);
        return $categories;
    }

    public function getOneCategory($id)
    {
        $category = category::where('uuid', $id)->get(['uuid', 'name', 'icon']);
        return $category;
    }

    public function storeCategory($data)
    {
        $user = User::where('uuid', $data['admin_uuid'])->first();
        try {
            if($user->is_admin)
            {
                $category = category::create($data);
                return $category;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function updateCategory($id, $data)
    {
        $user = User::where('uuid', $data['admin_uuid'])->first();
        try {
            if($user->is_admin)
            {
                $category = category::where('uuid', $id)->update(array(
                    'name' => $data['name'],
                    'icon' => $data['icon']
                ));
                return $category;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function deleteCategory($id, $admin_id)
    {
        $admin = User::where('uuid', $admin_id)->first(['is_admin']);

        try {
            if($admin->is_admin){
                $category = category::where('uuid', $id)->delete();
                return $category;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

}