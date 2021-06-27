<?php

namespace App\Validators\Backend;

use App\Validators\Base\BaseValidator;

class LienheValidator extends BaseValidator
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

    public function validateStoreLienhe($params = [])
    {
        $rules = [
            'name' => 'bail|required',
            'phone_number' => 'bail|required',
            'message' => 'bail|required',
            'email' => 'bail|required',
        ];

        return $this->validate($rules, $params);
    }

    protected function _setCustomAttributes()
    {
        return [
            'name' => 'Tên',
            'email' => 'Email',
            'message' => 'Nội dung',
            'phone_number' => 'Số điện thoại',
        ];
    }
}