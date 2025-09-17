@extends('layouts.noti_admin')

@section('content')
<div class="container-fluid py-4"><br><br>
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg-gradient-primary rounded-3 p-4 text-white shadow-lg">
                <h1 class="display-6 mb-0">
                    <i class="fas fa-chart-line me-3"></i>📊 Reporte Financiero
                </h1>
                <p class="mb-0 opacity-75">Gestiona y visualiza el rendimiento financiero de tu negocio</p>
            </div>
        </div>
    </div>

    <!-- Filtros y Exportación -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-filter text-primary me-2"></i>Filtros de Período
                    </h5>
                    <form method="GET" action="{{ route('reportes.financieros') }}" class="d-flex gap-2 flex-wrap">
                        <select name="periodo" class="form-select flex-grow-1" style="min-width: 150px;">
                            <option value="dia" {{ request('periodo')=='dia' ? 'selected' : '' }}>Hoy</option>
                            <option value="semana" {{ request('periodo')=='semana' ? 'selected' : '' }}>Esta Semana</option>
                            <option value="mes" {{ request('periodo')=='mes' ? 'selected' : '' }}>Este Mes</option>
                            <option value="anio" {{ request('periodo')=='anio' ? 'selected' : '' }}>Este Año</option>
                        </select>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i>Filtrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-download text-success me-2"></i>Exportar Reportes
                    </h5>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('reportes.exportExcel', request()->all()) }}" class="btn btn-success flex-grow-1">
                            <i class="fas fa-file-excel me-1"></i>📥 Excel
                        </a>
                        <a href="{{ route('reportes.exportPdf', request()->all()) }}" class="btn btn-danger flex-grow-1">
                            <i class="fas fa-file-pdf me-1"></i>📄 PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjetas de Resumen Financiero -->
    <div class="row mb-5">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100 border-start border-success border-4">
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="fas fa-arrow-up fa-2x"></i>
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted">Ingresos</h6>
                    <h3 class="card-title text-success mb-0">${{ number_format($ingresos, 2) }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100 border-start border-danger border-4">
                <div class="card-body text-center">
                    <div class="text-danger mb-2">
                        <i class="fas fa-arrow-down fa-2x"></i>
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted">Gastos</h6>
                    <h3 class="card-title text-danger mb-0">${{ number_format($gastos, 2) }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100 border-start border-warning border-4">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted">Pérdidas</h6>
                    <h3 class="card-title text-warning mb-0">${{ number_format($perdidas, 2) }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100 border-start border-primary border-4">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted">Ganancia Neta</h6>
                    <h3 class="card-title text-primary mb-0">${{ number_format($gananciaNeta, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-area text-info me-2"></i>Análisis Visual
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div id="chart_line" style="width: 100%; height: 400px;"></div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div id="chart_bar" style="width: 100%; height: 400px;"></div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div id="chart_pie" style="width: 100%; height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formularios de Registro -->
    <div class="row mb-5">
        <div class="col-12">
            <h4 class="mb-4">
                <i class="fas fa-plus-circle text-primary me-2"></i>Registro de Movimientos
            </h4>
        </div>
        
        <!-- Registrar Ingreso -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100 border-top border-success border-3">
                <div class="card-header bg-light border-0">
                    <h5 class="card-title mb-0 text-success">
                        <i class="fas fa-plus-circle me-2"></i>Registrar Ingreso
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('reportes.storeIngreso') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Monto</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="monto" class="form-control" placeholder="0.00" step="0.01" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <input type="text" name="descripcion" class="form-control" placeholder="Describe el ingreso" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-save me-1"></i>Guardar Ingreso
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Registrar Gasto -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100 border-top border-danger border-3">
                <div class="card-header bg-light border-0">
                    <h5 class="card-title mb-0 text-danger">
                        <i class="fas fa-minus-circle me-2"></i>Registrar Gasto
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('reportes.storeGasto') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Monto</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="monto" class="form-control" placeholder="0.00" step="0.01" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <input type="text" name="descripcion" class="form-control" placeholder="Describe el gasto" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-save me-1"></i>Guardar Gasto
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Registrar Pérdida -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100 border-top border-warning border-3">
                <div class="card-header bg-light border-0">
                    <h5 class="card-title mb-0 text-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>Registrar Pérdida
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('reportes.storePerdida') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Producto</label>
                            <select name="producto_id" class="form-select" required>
                                <option value="">-- Selecciona un producto --</option>
                                @foreach($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre_producto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cantidad</label>
                            <input type="number" name="cantidad" class="form-control" placeholder="Cantidad perdida" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="fas fa-save me-1"></i>Guardar Pérdida
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Historial de Movimientos -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-history text-secondary me-2"></i>Historial de Movimientos
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">
                                        <i class="fas fa-calendar me-1"></i>Fecha
                                    </th>
                                    <th class="px-4 py-3">
                                        <i class="fas fa-tag me-1"></i>Tipo
                                    </th>
                                    <th class="px-4 py-3">
                                        <i class="fas fa-dollar-sign me-1"></i>Monto
                                    </th>
                                    <th class="px-4 py-3">
                                        <i class="fas fa-comment me-1"></i>Descripción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movimientos as $mov)
                                <tr>
                                    <td class="px-4 py-3">
                                        <span class="text-muted">{{ $mov->fecha }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($mov->tipo == 'ingreso')
                                            <span class="badge bg-success">
                                                <i class="fas fa-arrow-up me-1"></i>{{ ucfirst($mov->tipo) }}
                                            </span>
                                        @elseif($mov->tipo == 'gasto')
                                            <span class="badge bg-danger">
                                                <i class="fas fa-arrow-down me-1"></i>{{ ucfirst($mov->tipo) }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-exclamation-triangle me-1"></i>{{ ucfirst($mov->tipo) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <strong class="
                                            @if($mov->tipo == 'ingreso') text-success
                                            @elseif($mov->tipo == 'gasto') text-danger
                                            @else text-warning @endif
                                        ">
                                            ${{ number_format($mov->monto, 2) }}
                                        </strong>
                                    </td>
                                    <td class="px-4 py-3">{{ $mov->descripcion }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    {{ $movimientos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts de Gráficos -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        // -------------------------------
        // 1. Gráfico de Líneas (evolución por periodo)
        // -------------------------------
        var dataLine = google.visualization.arrayToDataTable([
            ['Periodo', 'Ingresos', 'Gastos', 'Pérdidas', 'Ganancia Neta'],
            @foreach($mensual as $row)
                ['{{ $row->mes ?? $row->dia ?? $row->semana }}', {{ $row->ingresos }}, {{ $row->gastos }}, {{ $row->perdidas }}, {{ $row->ganancia }}],
            @endforeach
        ]);

        var optionsLine = {
            title: 'Tendencia Financiera',
            curveType: 'function',
            legend: { position: 'bottom' },
            height: 400,
            backgroundColor: 'transparent',
            titleTextStyle: { fontSize: 18, bold: true },
            colors: ['#28a745', '#dc3545', '#ffc107', '#007bff']
        };

        new google.visualization.LineChart(document.getElementById('chart_line')).draw(dataLine, optionsLine);

        // -------------------------------
        // 2. Gráfico de Barras Horizontales (último periodo)
        // -------------------------------
        var dataBar = google.visualization.arrayToDataTable([
            ['Concepto', 'Monto'],
            ['Ingresos', {{ $mensual->last()->ingresos ?? 0 }}],
            ['Gastos', {{ $mensual->last()->gastos ?? 0 }}],
            ['Pérdidas', {{ $mensual->last()->perdidas ?? 0 }}],
            ['Ganancia Neta', {{ $mensual->last()->ganancia ?? 0 }}]
        ]);

        var optionsBar = {
            title: 'Comparación del Último Periodo',
            height: 400,
            legend: { position: "none" },
            bars: 'horizontal',
            colors: ['#28a745','#dc3545','#ffc107','#007bff'],
            backgroundColor: 'transparent',
            titleTextStyle: { fontSize: 16, bold: true }
        };

        new google.visualization.BarChart(document.getElementById("chart_bar")).draw(dataBar, optionsBar);

        // -------------------------------
        // 3. Gráfico de Torta (último periodo)
        // -------------------------------
        var dataPie = google.visualization.arrayToDataTable([
            ['Concepto', 'Monto'],
            ['Ingresos', {{ $mensual->last()->ingresos ?? 0 }}],
            ['Gastos', {{ $mensual->last()->gastos ?? 0 }}],
            ['Pérdidas', {{ $mensual->last()->perdidas ?? 0 }}]
        ]);

        var optionsPie = {
            title: 'Distribución del Último Periodo',
            height: 400,
            colors: ['#28a745','#dc3545','#ffc107'],
            backgroundColor: 'transparent',
            titleTextStyle: { fontSize: 16, bold: true }
        };

        new google.visualization.PieChart(document.getElementById('chart_pie')).draw(dataPie, optionsPie);
    }
</script>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.table-responsive {
    border-radius: 0.5rem;
}

.badge {
    font-size: 0.75em;
    padding: 0.5em 0.75em;
}

@media (max-width: 768px) {
    .display-6 {
        font-size: 1.5rem;
    }
    
    .card-body {
        padding: 1rem;
    }
}
</style>

@endsection