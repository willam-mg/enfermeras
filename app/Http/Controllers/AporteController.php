<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aporte;
use App\Models\Afiliado;

class AporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Aporte();
        $afiliados = Afiliado::all();
        return view('aporte.create', [
            'afiliados'=>$afiliados,
            'model'=>$model,
        ]);
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
            'gestion' => ['required', 'integer'],
            'mes' => ['required', 'integer'],
            'monto' => ['required', 'numeric'],
            'afiliado_id' => ['required'],
        ]);

        $user = Aporte::create([
            'gestion' => $request->gestion,
            'mes' => $request->mes,
            'monto' => $request->monto,
            'afiliado_id' => $request->afiliado_id,
            'estado' => Aporte::PENDIENTE,
        ]);

        return redirect()
            ->route('aportes.index')
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
        $model = Aporte::find($id);
        return view('aporte.show', [
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
        $model = Aporte::find($id);
        $afiliados = Afiliado::all();

        return view('aporte.edit', [
            'model'=>$model,
            'afiliados'=>$afiliados
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
        $model = Aporte::find($id);
        $lastRol = $model->rol;
        $request->validate([
            'gestion' => ['required', 'integer'],
            'mes' => ['required', 'integer'],
            'monto' => ['required', 'numeric'],
            'afiliado_id' => ['required'],
            'estado' => ['integer'],
        ]);
        
        $model->gestion = $request->gestion;
        $model->mes = $request->mes;
        $model->monto = $request->monto;
        $model->afiliado_id = $request->afiliado_id;
        $model->estado = $request->estado == Aporte::PENDIENTE?2: 3;
        $model->save();

        return redirect()
            ->route('aportes.index')
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
        $model = Aporte::find($id);
        $model->delete();
        
        return redirect()
            ->route('aportes.index')
            ->with('success','Registro eliminado');
    }

    public function pagar(Request $request) {
        return $request;
    }
}
