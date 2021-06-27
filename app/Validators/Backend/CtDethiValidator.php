<?php

namespace App\Validators\Backend;

use App\Validators\Base\BaseValidator;

class CtDethiValidator extends BaseValidator
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function validateStoreDethi($params = [])
    {
        $rules = [
            'id_ct' => 'bail|required|max:255'
        ];

        return $this->validate($rules, $params);
    }

    public function validateUpdateImgCtDethi($params = [])
    {
        $rules = [
            'image' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB,
        ];

        return $this->validate($rules, $params);
    }

    protected function _setCustomAttributes()
    {
        return [
            'id_ct' => 'Cấu trúc đề thi',
            'image' => 'Ảnh đại diện',
        ];
    }
}