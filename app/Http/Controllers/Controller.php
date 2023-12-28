<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Pagination\LengthAwarePaginator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function paginate($collection, $perPage): LengthAwarePaginator
    {
        $page = request()->get('page') ?: 1;
        $paginatedItems = $collection->forPage($page, $perPage);
        return new LengthAwarePaginator($paginatedItems->values(), $collection->count(), $perPage, $page,
            ['path' => request()->url()]
        );
    }
}
