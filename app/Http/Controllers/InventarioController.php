<?php

namespace App\Http\Controllers;

use App\Models\DatoUsuario;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\MovimientoFinanciero;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $inventarios = Producto::all();
        $numeroUsuarios = DatoUsuario::count();
        $productosBajoStock = Producto::where('stock', '<', 10)->count();
        $pendidos = Pedido::where('estado_id', 3)->count();

        $productosRecientes = Producto::with('categorias')
            ->orderBy('created_at', 'desc')
            ->simplePaginate(3);

        // Datos para gráfico: productos por categoría
        $dataCat = DB::table('productos')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->select('categorias.nombre', DB::raw('COUNT(*) as total'))
            ->groupBy('categorias.nombre')
            ->pluck('total', 'nombre');


        // Fechas para filtrar tareas
        $desde = $request->input('desde', now()->subDays(7)->format('Y-m-d'));
        $hasta = $request->input('hasta', now()->format('Y-m-d'));

        // Tareas pendientes
        $pendientes = Tarea::where('tipo', 'pendiente')->get();

        // Tareas hechas
        $hechas = Tarea::where('tipo', 'hecha')->get();

        // Gráfico de tareas (pendientes vs hechas)
        $resumen = Tarea::selectRaw('tipo, COUNT(*) as total')->groupBy('tipo')->get();
        $labelsTareas = $resumen->pluck('tipo');
        $datosTareas = $resumen->pluck('total');

        // Productos recientes con categoría relacionada
        $productosRecientes = Producto::with('categorias')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Datos para gráfica de productos por categoría
        $dataCat = Producto::with('categorias')
            ->get()
            ->groupBy(fn($item) => $item->categorias->nombre ?? 'Sin categoría')
            ->map(fn($items) => count($items));
        // Retornar a la vista con todos los datos
        return view('index_admin', compact(
            'inventarios',
            'productosBajoStock',
            'productosRecientes',
            'dataCat',
            'pendientes',
            'hechas',
            'labelsTareas',
            'datosTareas',
            'desde',
            'numeroUsuarios',
            'pendidos',
            'hasta',
        ));
    }

    /**
     * Display the specified resource.
     */
    public function index2(Producto $productos_reci)
    {
        return view('admin.productos_reci', compact('productos_reci'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('admin.edit_produc', compact('producto'));
    }

    public function galeria(Producto $productos)
    {
        $productos = Producto::whereNotNull('imagen')
            ->orderBy('categoria_id')
            ->get();

        $agrupados = $productos->groupBy(fn($p) => $p->categorias->nombre ?? 'Sin Categoría');

        return view('admin.dashboard', compact('agrupados'));
    }
}
