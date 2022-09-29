<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acreditacion;
use App\Models\Afiliado;

class AcreditacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new Acreditacion();
        
        $afiliados = Afiliado::all();
        if ( $request->afiliado_id ) {
            $model->afiliado_id = $request->afiliado_id;
            $data = Acreditacion::where('afiliado_id', '=', $model->afiliado_id)->paginate(5);
        } else {
            $data = Acreditacion::paginate(5);
        }
        return view('acreditacion.index', [
            'model'=>$model,
            'data'=>$data,
            'afiliados'=>$afiliados,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $afiliados = Afiliado::all();
        return view('acreditacion.create', [
            'afiliados'=>$afiliados
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

        $user = Acreditacion::create([
            'gestion' => $request->gestion,
            'mes' => $request->mes,
            'monto' => $request->monto,
            'afiliado_id' => $request->afiliado_id,
            'pendiente' => true,
        ]);

        return redirect()
            ->route('acreditaciones.index')
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
        $model = Acreditacion::find($id);
        return view('acreditacion.show', [
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
        $model = Acreditacion::find($id);
        $afiliados = Afiliado::all();

        return view('acreditacion.edit', [
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
        $model = Acreditacion::find($id);
        $lastRol = $model->rol;
        $request->validate([
            'gestion' => ['required', 'integer'],
            'mes' => ['required', 'integer'],
            'monto' => ['required', 'numeric'],
            'afiliado_id' => ['required'],
            'pendiente' => ['boolean'],
        ]);
        
        $model->gestion = $request->gestion;
        $model->mes = $request->mes;
        $model->monto = $request->monto;
        $model->afiliado_id = $request->afiliado_id;
        $model->pendiente = $request->pendiente == '1'?true: false;
        $model->save();

        return redirect()
            ->route('acreditaciones.index')
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
        $model = Acreditacion::find($id);
        $model->delete();
        
        return redirect()
            ->route('acreditaciones.index')
            ->with('success','Registro eliminado');
    }

    public function pagar(Request $request) {
        return $request;
    }
}
