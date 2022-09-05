<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afiliado;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\ImageTrait;

class AfiliadoController extends Controller
{
    use ImageTrait;
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
            $data = Afiliado::where('nombre_completo', 'like', '%'.$model->nombre_completo.'%')
                    ->orderBy('id', 'DESC')
                    ->paginate(5);
        } else {
            $data = Afiliado::orderBy('id', 'DESC')
                    ->paginate(5);
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
            'numero_afiliado' => ['required', 'string', 'max:50'],
            'cargo' => ['required', 'string', 'max:50'],
            'nombre_completo' => ['required', 'string', 'max:50'],
            'numero_matricula' => ['required', 'string', 'max:50'],
            'ci' => ['required', 'string', 'max:50', 'unique:afiliados'],
            'fecha_nacimiento' => ['date'],
            'grupo_sanguineo' => ['string'],
            'egreso' => ['string', 'max:50'],
            'domicilio' => ['string', 'max:300'],
            'telefono' => ['string', 'max:20'],
        ]);

        $model = Afiliado::create([
            'numero_afiliado'=> $request->numero_afiliado,
            'cargo'=> $request->cargo,
            'nombre_completo'=> $request->nombre_completo,
            'numero_matricula'=> $request->numero_matricula,
            'ci'=> $request->ci,
            'fecha_nacimiento'=> $request->fecha_nacimiento,
            'grupo_sanguineo'=> $request->grupo_sanguineo,
            'egreso'=> $request->egreso,
            'domicilio'=> $request->domicilio,
            'telefono'=> $request->telefono,
            'fecha_registro'=> date('Y-m-d')
        ]);

        $imageName = null;
        $image = $request->file('foto');
        if ($image) {
            $this->saveImage($image, $model, 'afiliado');
        }

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
            'numero_afiliado' => ['required', 'string', 'max:50'],
            'cargo' => ['required', 'string', 'max:50'],
            'nombre_completo' => ['required', 'string', 'max:50'],
            'numero_matricula' => ['required', 'string', 'max:50'],
            'ci' => ['required', 'string', 'max:50'],
            'fecha_nacimiento' => ['date'],
            'grupo_sanguineo' => ['string'],
            'egreso' => ['string', 'max:50'],
            'domicilio' => ['string', 'max:300'],
            'telefono' => ['string', 'max:20'],
        ]);
        $model->update($request->all());

        $image = $request->file('foto');
        if ($image){
            $this->saveImage($image, $model, 'afiliado', true);
        }

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

    public function imprimirCredencial($id) {
        $model = Afiliado::find($id);
        // return view('afiliado.credencial', compact('model'));
        $pdf = Pdf::loadView('afiliado.credencial', compact('model'));
        // $customPaper = array(0,0,360,360);
        // $customPaper = array(0,0,5.5,3.5);
        $pdf->set_option('defaultFont', 'Helvetica');
        $pdf->set_option('enable_php', true);    
        $pdf->set_option('enable_remote', true);
        $customPaper = array(0,0,132.28346457, 207.87401575);
        $pdf->setPaper($customPaper);

        return $pdf->stream();
        // return $pdf->download('disney.pdf');
    }
}
