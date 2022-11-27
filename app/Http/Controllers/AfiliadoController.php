<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afiliado;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\ImageTrait;
use App\Models\Requisito;
use App\Models\MisRequisitos;
use App\Models\Aporte;
use App\Models\Credencial;
use App\Traits\ProgressTrait;
use Illuminate\Support\Carbon;

class AfiliadoController extends Controller
{
    use ImageTrait, ProgressTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('afiliado.index');
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
            'egreso' => ['string', 'max:100'],
            'domicilio' => ['string', 'max:300'],
            'telefono' => ['string', 'max:20'],
            'anos_servicio' => ['string', 'max:20'],
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
            'anos_servicio' => $request->anos_servicio,
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
    public function show($id, Request $request)
    {
        $model = Afiliado::find($id);
        $requisitos = Requisito::where(['estado'=>1])->get();
        $misRequisitos = $model->misRequisitos->pluck('requisito_id')->toArray();
        $porcentaje = $this->porcentaje($misRequisitos, $requisitos);

        // aportes
        $aporteMd = new Aporte();
        
        $afiliados = Afiliado::all();
        if ( $request->afiliado_id ) {
            $aporteMd->gestion = $request->gestion;
            // $aporteMd->mes = $request->mes;
            // $aporteMd->pendiente = $request->pendiente == "null"?null:$request->pendiente;
            $data = Aporte::where('afiliado_id', '=', $model->id)
                ->where('gestion', 'like', '%'.$aporteMd->gestion)
                // ->where('mes', '=', $aporteMd->mes)
                // ->where('pendiente', '=', $aporteMd->pendiente)
                ->paginate(5);
        } else {
            $data = Aporte::where('afiliado_id', '=', $model->id)->paginate(5);
        }

        $selected = true;

        return view('afiliado.show', [
            'model'=>$model,
            'requisitos'=>$requisitos,
            'misRequisitos'=>$misRequisitos,
            'porcentaje'=>$porcentaje,
            'porcentajeColor'=>$this->porcentajeColor($porcentaje),
            'data'=>$data,
            'aporteMd'=>$aporteMd,
            'selected'=>$selected,
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
            'expedido' => ['required', 'string', 'max:50'],
            'fecha_nacimiento' => ['date'],
            'grupo_sanguineo' => ['string'],
            'egreso' => ['string', 'max:100'],
            'domicilio' => ['string', 'max:300'],
            'telefono' => ['string', 'max:20'],
            'anos_servicio' => ['string', 'max:20'],
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

    public function imprimirCredencial($id, $side = 'front') {
        $credencial = Credencial::find($id);
        $model = $credencial->afiliado;
        $fechaInicio =  Carbon::parse($credencial->fecha_emision);
        $fechaInicio = $fechaInicio->format('d/m/Y');;
        $fechaFin =  Carbon::parse($credencial->fecha_vencimiento);
        $fechaFin = $fechaFin->format('d/m/Y');
        $pdf = Pdf::loadView('afiliado.print-credencial', compact('model', 'fechaInicio', 'fechaFin', 'side'));
        $pdf->set_option('defaultFont', 'Helvetica');
        $pdf->set_option('enable_php', true);    
        $pdf->set_option('enable_remote', true);
        // 210 X 297 mm => 595.276 X 841.89 points
        $customPaper = array(0,0, 595.276, 841.89);
        $pdf->setPaper($customPaper);

        return $pdf->stream();
        // return $pdf->download('disney.pdf');
    }

    public function requisitos($id, Request $request) {
        $model = Afiliado::find($id);
        $misRequisitos = $model->misRequisitos->pluck('requisito_id')->toArray();

        $requisitos = $request->requisitos?$request->requisitos:[];
        // eliminadno los que no estan seleccionados
        foreach ($model->misRequisitos as $key => $miRequisito) {
            if (!in_array($miRequisito->requisito_id, $requisitos)) {
                $miRequisito->delete();
            }
        }
        // Agregando regquisitos seleccionados
        foreach ($requisitos as $key => $item) {
            if (!in_array($item, $misRequisitos)) {
                $miRequisito = new MisRequisitos();
                $miRequisito->requisito_id = $item;
                $miRequisito->afiliado_id = $model->id;
                $miRequisito->fecha_presentacion = date('Y-m-d');
                $miRequisito->hora_presentacion = date('His');
                $miRequisito->save();
            }
        }
        return redirect()
            ->route('afiliados.show', $model->id)
            ->with('success','Guardado');
    }
}
