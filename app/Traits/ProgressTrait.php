<?php
namespace App\Traits;

/**
 * 
 */
trait ProgressTrait
{
    /**
     * calcula el porcentaje de avance.
     * @param Array | integer $avance es el numero de avance
     * @param Array | integer $total es el numero total
     * @param boolean $isArray  si los parametros son array o enteros
     */
    public function porcentaje($avance, $total, $isArray = true) {
        $porcentaje = 0;
        if ($isArray) {
            // return round(($avance * 100 ) / $total, 0);
            $avance = count($avance);
            $total = count($total);
        }
        if (  $total > 0 &&  $avance > 0 ) {
            $porcentaje = round(( $avance * 100 ) /  $total);
        }
        return $porcentaje;
    }
    
    /**
     * retorna el color del avance.
     * @param Integer | Decimal $avance
     */
    public function porcentajeColor($avance) {
        $barColor = 'bg-danger';
        if ($avance >= 0 && $avance <= 50){
            $barColor = 'bg-danger';
        }
        if ($avance > 50 && $avance <= 90) {
            $barColor = 'bg-warning';
        }
        if ($avance > 90 && $avance <= 100) {
            $barColor = 'bg-success';
        }
        return $barColor;
    }
}
