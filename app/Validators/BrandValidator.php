<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class BrandValidator extends BaseValidator
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

    public function validateStoreBrand($params = [])
    {
        $rules = [
            'name' => 'bail|required|max:255',
            'avatar' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB,
        ];

        return $this->validate($rules, $params);
    }
}