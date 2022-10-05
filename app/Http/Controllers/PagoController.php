<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Afiliado;
use App\Models\DetallePago;
use App\Models\Acreditacion;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pago::paginate(5);
        return view('pago.index', [
            'data'=>$data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $seleccionados = json_decode($request->seleccionados);
        $afiliado = null;
        if ( $seleccionados != null ) {
            $acreditacion = Acreditacion::find($seleccionados[0]);
            $afiliado = $acreditacion->afiliado;
        }
        $acreditaciones = [];
        foreach ($seleccionados as $key => $item) {
            $acreditacion = Acreditacion::find($item);
            array_push($acreditaciones, $acreditacion);
        }
        $total = 0;
        foreach ($acreditaciones as $key => $item) {
            $total += $item->monto;
        }
        return view('pago.create', [
            'acreditaciones'=>$acreditaciones,
            'afiliado'=>$afiliado,
            'total'=>$total,
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
        // $request->validate([
        //     'acreditacion_id' => ['required' ],
        //     'fecha' => ['required', 'string'],
        // ]);
        
        $pago = Pago::create([
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
            'user_id' => Auth::user()->id,
        ]);
        foreach ($request->seleccionados as $key => $item) {
            $acreditacion = Acreditacion::find($item);
            $detalle = DetallePago::create([
                'acreditacion_id' => $acreditacion->id,
                'monto' => $acreditacion->monto,
                'pago_id' => $pago->id,
            ]);
            $acreditacion->pendiente = 2;
            $acreditacion->save();
        }

        return redirect('pagos/recibo/'.$pago->id)
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
        $model = Pago::find($id);
        return view('pago.show', [
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
        $model = Pago::find($id);
        return view('pago.edit', [
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
        // $model = Pago::find($id);
        // $lastRol = $model->rol;
        // $request->validate([
        //     'gestion' => ['required', 'integer'],
        //     'mes' => ['required', 'integer'],
        //     'monto' => ['required', 'numeric'],
        //     'afiliado_id' => ['required'],
        // ]);
      
        // $model->update($request->all());
      
        // return redirect()
        //     ->route('pagos.index')
        //     ->with('success','Registro modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Pago::find($id);
        $model->delete();
        
        return redirect()
            ->route('pagos.index')
            ->with('success','Registro eliminado');
    }

    public function recibo($id) {
        $model = Pago::find($id);
        return view('pago.recibo', [
            'model'=>$model
        ]);
    } 
    public function recibopdf($id) {
        $model = Pago::find($id);
        // return view('pago._recibo', [
        //     'model'=>$model
        // ]);



        $pdf = Pdf::loadView('pago._recibopdf', compact('model'));
        // $customPaper = array(0,0,360,360);
        // $customPaper = array(0,0,5.5,3.5);
        $pdf->set_option('defaultFont', 'Helvetica');
        $pdf->set_option('enable_php', true);    
        $pdf->set_option('enable_remote', true);
        // 8.5 x 5.3 cm => 240.945 (240.944882) x 150.236 (150.23622) points => 321.25984266666666 x 200.31496 px
        // 8.5 x 5.3 cm =>
        // $customPaper = array(0,0, 207.87401575, 132.28346457);
        // $customPaper = array(0,0, 240.944882, 150.23622);
        // $pdf->setPaper($customPaper);
        
        $customPaper = array(0,0, 612, 396);
        $pdf->setPaper($customPaper);

        return $pdf->stream();
    } 
}
