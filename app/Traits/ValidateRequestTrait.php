<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

trait ValidateRequestTrait
{
    /**
     * Validate the given request with the provided rules.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateProductStoreRequest(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $rules = [
            'title' => 'required|string|max:255',
            'body_html' => 'required|string|max:255',
            'vendor' => 'required|string|max:100',
            'product_type' => 'required|string|max:100',
            'status' => 'required|in:active,draft,archived',
        ];

        return Validator::make($request->all(), $rules);
    }

    public function validateProductUpdateRequest(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $rules = [
            'title' => 'required|string|max:255',
            'body_html' => 'required|string|max:255',
            'vendor' => 'required|string|max:100',
            'product_type' => 'required|string|max:100',
            'status' => 'required|in:active,draft,archived',
        ];

        return Validator::make($request->all(), $rules);
    }
}
