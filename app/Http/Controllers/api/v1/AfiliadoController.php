<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Afiliado;
use App\Traits\ImageTrait;
use App\Traits\ProgressTrait;

class AfiliadoController extends Controller
{
    use ImageTrait, ProgressTrait;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Afiliado::findOrFail($id);
        
    }

}
