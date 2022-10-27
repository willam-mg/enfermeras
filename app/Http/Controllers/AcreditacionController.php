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
        $data = Acreditacion::select("*")
            ->when($request->input('afiliado_id') , function ($query) use ($request, $model) {
                $model->afiliado_id = $request->afiliado_id;
                $query->where('afiliado_id', $request->afiliado_id);
            })
            ->when($request->input('gestion'), function ($query) use ($request, $model) {
                $model->gestion = $request->gestion;
                $query->where('gestion', $request->gestion);
            })
            ->when($request->input('mes'), function ($query) use ($request, $model) {
                $model->mes = $request->mes;
                $query->where('mes', $request->mes);
            })
            ->when($request->input('pendiente'), function ($query) use ($request, $model) {
                $model->pendiente = $request->pendiente;
                $query->where('pendiente', $request->pendiente);
            })
            ->paginate(5);

        $selected = $request->input('afiliado_id')?true: false;
        return view('acreditacion.index', [
            'model'=>$model,
            'data'=>$data,
            'afiliados'=>$afiliados,
            'selected'=>$selected,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Acreditacion();
        $afiliados = Afiliado::all();
        return view('acreditacion.create', [
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
        $model->pendiente = $request->pendiente == '1'?1: 2;
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
