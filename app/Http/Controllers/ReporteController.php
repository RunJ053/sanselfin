<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientoFinanciero;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteExport;
use PDF;

class ReporteController extends Controller
{
    public function financieros(Request $request)
    {
        // 📌 Filtros
        $filtro = $request->get('filtro', 'mes');
        $desde = $request->get('desde');
        $hasta = $request->get('hasta');

        $query = MovimientoFinanciero::query();

        if ($desde && $hasta) {
            $query->whereBetween('fecha', [$desde, $hasta]);
        } else {
            switch ($filtro) {
                case 'dia':
                    $query->whereDate('fecha', today());
                    break;
                case 'semana':
                    $query->whereBetween('fecha', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'mes':
                    $query->whereYear('fecha', now()->year)
                        ->whereMonth('fecha', now()->month);
                    break;
                case 'anio':
                    $query->whereYear('fecha', now()->year);
                    break;
            }
        }

        // Totales
        $ingresos = (clone $query)->where('tipo', 'ingreso')->sum('monto');
        $gastos = (clone $query)->where('tipo', 'gasto')->sum('monto');
        $perdidas = (clone $query)->where('tipo', 'perdida')->sum('monto');

        $gananciaNeta = $ingresos - ($gastos + $perdidas);

        $productos = Producto::all();
        $movimientos = $query->with('pedido', 'producto')
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        $mensual = MovimientoFinanciero::select(
            DB::raw("DATE_FORMAT(fecha, '%Y-%m') as mes"),
            DB::raw("SUM(CASE WHEN tipo = 'ingreso' THEN monto ELSE 0 END) as ingresos"),
            DB::raw("SUM(CASE WHEN tipo = 'gasto' THEN monto ELSE 0 END) as gastos"),
            DB::raw("SUM(CASE WHEN tipo = 'perdida' THEN monto ELSE 0 END) as perdidas"),
            DB::raw("SUM(CASE WHEN tipo = 'ingreso' THEN monto ELSE 0 END) -
                        (SUM(CASE WHEN tipo = 'gasto' THEN monto ELSE 0 END) +
                        SUM(CASE WHEN tipo = 'perdida' THEN monto ELSE 0 END)) as ganancia")
        )
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        return view('admin.reports.reportes', compact(
            'ingresos',
            'gastos',
            'perdidas',
            'gananciaNeta',
            'productos',
            'movimientos',
            'mensual',
            'filtro',
            'desde',
            'hasta'
        ));
    }

    // 📌 Exportar a Excel
    public function exportExcel(Request $request)
    {
        return Excel::download(new ReporteExport($request), 'reporte_financiero.xlsx');
    }

    // 📌 Exportar a PDF
    public function exportPdf(Request $request)
    {
        // reutilizamos lógica de filtros
        $controller = new self();
        $data = $controller->financieros($request)->getData();

        $pdf = PDF::loadView('admin.reports.reporte_pdf', (array) $data);
        return $pdf->download('reporte_financiero.pdf');
    }

    // Registrar pérdida
    public function storePerdida(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        $producto = Producto::find($request->producto_id);

        MovimientoFinanciero::create([
            'fecha' => now(),
            'tipo' => 'perdida',
            'monto' => $producto->precio_unitario * $request->cantidad,
            'descripcion' => "Pérdida de {$request->cantidad} unidades de {$producto->nombre_producto}",
            'producto_id' => $producto->id
        ]);

        $producto->decrement('stock', $request->cantidad);

        return redirect()->route('reportes.financieros')->with('success', 'Pérdida registrada correctamente');
    }

    // Registrar gasto
    public function storeGasto(Request $request)
    {
        try {
            $request->validate([
                'monto' => 'required|numeric',
                'descripcion' => 'required|string'
            ]);

            MovimientoFinanciero::create([
                'fecha' => now(),
                'tipo' => 'gasto',
                'monto' => $request->monto,
                'descripcion' => $request->descripcion
            ]);

            return redirect()->route('reportes.financieros')->with('success', 'Gasto registrado correctamente');
        } catch (\Exception $e) {
            // Guarda el error en el log de Laravel
            \Log::error('Error al registrar gasto: ' . $e->getMessage());

            // Retorna con mensaje de error
            return redirect()->route('reportes.financieros')->with('error', 'Hubo un problema al registrar el gasto. Intenta de nuevo.');
        }
    }

    // Registrar ingreso manual (opcional)
    public function storeIngreso(Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric',
            'descripcion' => 'required|string'
        ]);

        MovimientoFinanciero::create([
            'fecha' => now(),
            'tipo' => 'ingreso',
            'monto' => $request->monto,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('reportes.financieros')->with('success', 'Ingreso registrado correctamente');
    }
}
