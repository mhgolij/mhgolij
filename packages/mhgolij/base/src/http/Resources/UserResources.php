<?php

namespace mhgolij\base\http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data'=>parent::toArray($request),
            'status'=>true,
            'messages'=>[
                'date'=>now(),
                'type'=>'success',
                'code'=>200,
                'message'=>trans('mhgolijBase::admin.message.operation_success')
            ]
        ];
    }
}
