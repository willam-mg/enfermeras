<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Afiliado;
use App\Models\DetallePago;
use App\Models\Aporte;
use App\Models\Obsequio;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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
            $aporte = Aporte::find($seleccionados[0]);
            $afiliado = $aporte->afiliado;
        }
        $aportes = [];
        foreach ($seleccionados as $key => $item) {
            $aporte = Aporte::find($item);
            array_push($aportes, $aporte);
        }
        $total = 0;
        foreach ($aportes as $key => $item) {
            $total += $item->monto;
        }
        return view('pago.create', [
            'aportes'=>$aportes,
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
        try {
            DB::beginTransaction();
            $pago = Pago::create([
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s'),
                'user_id' => Auth::user()->id,
                'afiliado_id' => $request->afiliado_id,
            ]);
            $gestion = date("Y");
            foreach ($request->seleccionados as $key => $item) {
                $aporte = Aporte::find($item);
                $detalle = DetallePago::create([
                    'aporte_id' => $aporte->id,
                    'monto' => $aporte->monto,
                    'pago_id' => $pago->id,
                ]);
                $aporte->estado = Aporte::PAGADO;
                $aporte->save();
                $gestion = $aporte->gestion;
            }
            
            // verificar si teine la gestion completa
            $numeroAportesPagados = Aporte::where('afiliado_id', $request->afiliado_id)
                ->where('gestion', $gestion)
                ->where('estado','=', Aporte::PAGADO)->count();
            if ($numeroAportesPagados >= 12) {
                $obsequio = new Obsequio();
                $obsequio->user_id = Auth::user()->id;
                $obsequio->afiliado_id = $request->afiliado_id;
                $obsequio->save();
            }

            DB::commit();

            return redirect('pagos/recibo/' . $pago->id)
            ->with('success', 'Registro agregado');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
        }
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
        return view('pago._recibopdf', [
            'model'=>$model
        ]);
        // $pdf = Pdf::loadView('pago._recibopdf', compact('model'));
                // $pdf->set_option('defaultFont', 'Helvetica');
                // $pdf->set_option('enable_php', true);    
                // $pdf->set_option('enable_remote', true);

        // 8.5 x 5.3 cm => 240.945 (240.944882) x 150.236 (150.23622) points => 321.25984266666666 x 200.31496 px
        // 8.5 x 5.3 cm =>
        // $customPaper = array(0,0, 207.87401575, 132.28346457);
        // $customPaper = array(0,0, 240.944882, 150.23622);
        // $pdf->setPaper($customPaper);
        
        // $customPaper = array(0,0, 612, 396);
                // $customPaper = array(0,0, 595.276, 420.94488);
                // $pdf->setPaper($customPaper);

                // return $pdf->stream();
    } 
}
