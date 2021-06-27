<?php

namespace App\Repositories;

use App\Model\Entities\User;
use App\Repositories\Base\BaseRepository;
use App\Validators\UserValidator;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function validator()
    {
         return UserValidator::class;
    }

    public function getListForBackend()
    {
        $query = $this->where('del_flag', delFlagOn());

        $search = trimValuesArray(request()->all());
        if(arrayGet($search, 'id')) {
            $query->where('id', arrayGet($search, 'id'));
        }

        if(!is_null(arrayGet($search, 'status')) && arrayGet($search, 'status') != -1) {
            $query->where('status', arrayGet($search, 'status'));
        }

        if(!is_null(arrayGet($search, 'gender')) && arrayGet($search, 'gender') != -1) {
            $query->where('gender', arrayGet($search, 'gender'));
        }

        if(arrayGet($search, 'username')) {
            $query->where('username', 'like', '%' . arrayGet($search, 'username') . '%');
        }

        return $query->orderBy('id', 'desc')->paginate(getBackendPagination());
    }
}