<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afiliado;

class AfiliadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new Afiliado();
        if ($request != null) {
            $model->nombre_completo = $request->nombre_completo;
            $data = Afiliado::where('nombre_completo', 'like', '%'.$model->nombre_completo.'%')->paginate(5);
        } else {
            $data = Afiliado::paginate(5);
        }
        
        return view('afiliado.index', [
            'data'=>$data,
            'model'=>$model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('afiliado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => ['required', 'string', 'max:255'],
            'ci' => ['required', 'string', 'unique:afiliados'],
            'telefono' => ['string'],
            'celular' => ['string'],
            'direccion' => ['string', 'max:255'],
        ]);

        $user = Afiliado::create([
            'nombre_completo' => $request->nombre_completo,
            'ci' => $request->ci,
            'telefono' => $request->telefono,
            'celular' => $request->celular,
            'direccion' => $request->direccion,
        ]);

        return redirect()
            ->route('afiliados.index')
            ->with('success','Registro agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Afiliado::find($id);
        return view('afiliado.show', [
            'model'=>$model
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Afiliado::find($id);
        return view('afiliado.edit', [
            'model'=>$model
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Afiliado::find($id);

        $request->validate([
            'nombre_completo' => ['required', 'string', 'max:255'],
            'ci' => ['required', 'string'],
            'telefono' => ['string'],
            'celular' => ['string'],
            'direccion' => ['string', 'max:255'],
        ]);
        $model->update($request->all());

        return redirect()
            ->route('afiliados.index')
            ->with('success','Registro modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Afiliado::find($id);
        $model->delete();
        
        return redirect()
            ->route('afiliados.index')
            ->with('success','Registro eliminado');
    }
}
