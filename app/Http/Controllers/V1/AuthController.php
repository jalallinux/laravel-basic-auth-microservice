<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Admin\AdminShowResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function me(Request $request): AdminShowResource
    {
        return new AdminShowResource($request->user());
    }
}
