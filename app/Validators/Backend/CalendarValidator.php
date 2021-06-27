<?php

namespace App\Validators\Backend;

use App\Validators\Base\BaseValidator;

class CalendarValidator extends BaseValidator
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

    public function validateStoreCalendar($params = [])
    {
        $rules = [
            'title' => 'bail|required|max:255',
            'image' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB,
            'status' => 'bail|nullable|in:0,1',
            'date_exam' => 'bail|required|date_format:Y-m-d',
            'short_description' => 'bail|max:255',
        ];

        return $this->validate($rules, $params);
    }

    protected function _setCustomAttributes()
    {
        return [
            'title' => 'Tiêu đề',
            'image' => 'Ảnh đại diện',
            'content' => 'Nội dung bài viết',
            'short_description' => 'Mô tả ngắn',
            'status' => 'Trạng thái',
            'date_exam' => 'Ngày thi',
        ];
    }

    protected function _setCustomMessage()
    {
        $message['date_exam.after'] = 'Trường Ngày thi phải sau hoặc bằng ngày hôm nay.';
        return $message;
    }
}
