<?php

namespace App\Http\Requests;

use App\Models\TaskTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaskTagRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('task_tag_edit'),
            response()->json(
                ['message' => 'This action is unauthorized.'],
                Response::HTTP_FORBIDDEN
            ),
        );

        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
