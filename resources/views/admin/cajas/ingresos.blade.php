@extends('adminlte::page')

@section('content_header')
    <h1><b>Cajas</b></h1>
@endsection

@section('content')
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="row">
        <!-- Tabla de usuarios registrados -->
        <div class="col-md-12">
            <div class="card card-outline card-primary">

                <div class="card-body">

                    <form method="GET" action="{{ route('admin.cajas.ingresos') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" name="fecha" id="fecha" class="form-control"
                                    value="{{ request('fecha') }}">
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Buscar</button>

                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <a href="{{ route('admin.cajas.ingresos') }}" class="btn btn-primary w-100">Cargar
                                    todos</a>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <a href="{{ route('admin.cajas.ingresos') }}" class="btn btn-primary w-100">Generar
                                    Reporte</a>
                            </div>

                        </div>
                    </form>
                    @foreach ($cajas as $caja)
                        {{-- Card de Movimientos de la Caja --}}
                        <div class="card mb-12 shadow">
                            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                                <div class="w-100">
                                    <h4 class="mb-0">Caja #{{ $caja->id }}
                                        <span class="ms-3">Fecha:
                                            {{ \Carbon\Carbon::parse($caja->fecha_apertura)->format('d/m/Y') }}</span>
                                    </h4>
                                </div>
                                <a href="{{ route('admin.cajas.reporte_caja', ['id' => $caja->id]) }}"
                                    class="btn btn-sm btn-primary">Reporte</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Tipo</th>

                                            <th>Detalles de Venta</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($caja_movs[$caja->id] as $movimiento)
                                            <tr>
                                                <td>{{ ucfirst($movimiento->tipo) }}</td>

                                                <td>
                                                    @if ($movimiento->detalle_ventas->isNotEmpty())
                                                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#detalleVenta{{ $movimiento->id }}" aria-expanded="false"
                                                            aria-controls="detalleVenta{{ $movimiento->id }}">
                                                            Ver Detalles
                                                        </button>

                                                        <div class="collapse mt-2" id="detalleVenta{{ $movimiento->id }}">
                                                            <div class="p-2 bg-light rounded">
                                                                @foreach ($movimiento->detalle_ventas as $detalle)
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                                                        <div>
                                                                            <strong>{{ $detalle['producto_nombre'] }}</strong><br>
                                                                            <small class="text-muted">Cantidad:
                                                                                {{ $detalle['cantidad'] }}</small>
                                                                        </div>
                                                                        <div class="text-end">
                                                                            <span class="fw-bold text-success">
                                                                                Bs.{{ number_format($detalle['producto_precio'], 2) }}
                                                                            </span><br>
                                                                            <small class="text-muted">Total:
                                                                                Bs.{{ number_format($detalle['cantidad'] * $detalle['producto_precio'], 2) }}
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">No hay detalle de venta</span>
                                                    @endif
                                                </td>
                                                <td>Bs.{{ number_format($movimiento->monto, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- Sección de Total de Caja --}}
                                <div class="card mb-4 shadow">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold text-muted">Total de Caja:</span>
                                            <h4 class="fw-bold">Bs. {{ number_format($totales_caja[$caja->id], 2) }}</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach

                    {{-- Agregar paginación de Cajas --}}
                    @if ($cajas->hasPages())
                        <nav aria-label="Paginación de Cajas">
                            <ul class="pagination justify-content-center mt-4">
                                {{-- Botón "Anterior" --}}
                                @if ($cajas->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Anterior</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $cajas->previousPageUrl() }}" tabindex="-1">Anterior</a>
                                    </li>
                                @endif

                                {{-- Números de Página --}}
                                @foreach ($cajas->getUrlRange(1, $cajas->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $cajas->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Botón "Siguiente" --}}
                                @if ($cajas->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $cajas->nextPageUrl() }}">Siguiente</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">Siguiente</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif

                </div>

            </div>
        </div>
    </div>



    <div class="modal fade" id="modalCrear" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Header del modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Usuario registrado</b></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Formulario -->
                <div class="row">
                    <!-- Formulario para crear un usuario -->
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Ingrese los datos</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('cajas.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="fecha_apertura" class="form-label">Fecha de Apertura</label>
                                        <input type="datetime-local" class="form-control" id="fecha_apertura"
                                            name="fecha_apertura" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="fecha_cierre" class="form-label">Fecha de Cierre</label>
                                        <input type="datetime-local" class="form-control" id="fecha_cierre"
                                            name="fecha_cierre">
                                    </div>

                                    <div class="mb-3">
                                        <label for="monto_inicial" class="form-label">Monto Inicial</label>
                                        <input type="number" step="0.01" class="form-control" id="monto_inicial"
                                            name="monto_inicial">
                                    </div>

                                    <div class="mb-3">
                                        <label for="monto_final" class="form-label">Monto Final</label>
                                        <input type="number" step="0.01" class="form-control" id="monto_final"
                                            name="monto_final">
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS (incluye Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection

@section('css')
@endsection

@section('js')
@endsection