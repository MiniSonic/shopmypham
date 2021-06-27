<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class CategoryValidator extends BaseValidator
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

    // ========== BACKEND ==========
    public function backendValidateStoreCategory($params = [])
    {
        $rules = [
            'name' => 'bail|required|max:255',
        ];

        return $this->validate($rules, $params);
    }

    public function backendValidateUpdateCategory($params = [])
    {
        $rules = [
            'name' => 'bail|required|max:255'
        ];

        return $this->validate($rules, $params);
    }

    // ========== FRONTEND ==========
    protected function _setCustomAttributes()
    {
        return [
            'old_password' => 'Mật khẩu cũ',
            'new_password' => 'Mật khẩu mới',
            'avatar ' => 'Ảnh đại diện',
        ];
    }
}