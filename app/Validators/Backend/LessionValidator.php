<?php

namespace App\Validators\Backend;

use App\Validators\Base\BaseValidator;

class LessionValidator extends BaseValidator
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

    public function validateStoreLession($params = [], $id = '')
    {
        $rules = [
            'name' => 'bail|required|max:255',
            'documents.*' => 'bail|nullable|mimes:pdf', // 100KB, 1024kb = 1 MB,
            'video' => 'bail|nullable|mimes:mp4',
        ];

        return $this->validate($rules, $params);
    }

    protected function _setCustomAttributes()
    {
        $attr = [];
        for ($i = 0; $i < 10; $i++) {
            $attr['documents.'.$i] = 'Tài liệu ' . $i;
        }
        $attr['name'] = 'Tên bài học';

        return $attr;
    }
}
