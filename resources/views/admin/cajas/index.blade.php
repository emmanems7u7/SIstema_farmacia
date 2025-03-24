@extends('adminlte::page')

@section('content_header')
    <h1><b>Usuarios</b></h1>
@endsection

@section('content')

    <div class="row">
        <!-- Tabla de usuarios registrados -->
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios registrados</h3>


                    <div class="card-tools">



                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalCrear">
                            <i class="fas fa-plus"></i> Nuevo Usuario
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="text-align: center">Nro</th>
                                <th scope="col" style="text-align: center">Fecha Apertura</th>
                                <th scope="col" style="text-align: center">Fecha Cierre</th>
                                <th scope="col" style="text-align: center">Monto Inicial</th>
                                <th scope="col" style="text-align: center">Monto Final</th>
                                <th scope="col" style="text-align: center">Descripcion</th>
                                <th scope="col" style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $contador = 1; @endphp
                            @foreach($cajas as $caja)
                                <tr>
                                    <td style="text-align: center">{{ $contador++ }}</td>
                                    <td>{{ $caja->fecha_apertura }}</td>
                                    <td>{{ $caja->fecha_cierre ?? 'Caja sin cerrar'}}</td>
                                    <td> {{ $caja->monto_inicial }}</td>
                                    <td> {{ $caja->monto_final ?? 'Caja sin cerrar' }} </td>
                                    <td> {{ $caja->descripcion }}</td>
                                    <td style="text-align: center">
                                        <!-- Botón ver-->
                                        <button type="button" class="btn btn-outline-primary"
                                            onclick="window.location.href='{{ route('caja.cerrar', ['id' => $caja->id]) }}'">
                                            Cerrar Caja
                                        </button>


                                        <!-- Botón ver-->
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#verModal{{ $caja->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Botón Editar -->
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                            data-target="#editarModal{{ $caja->id }}">
                                            <i class="fas fa-pencil"></i>
                                        </button>

                                        <!-- Botón Eliminar -->
                                        <form action="{{ route('admin.cajas.destroy', $caja->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <!-- MODAL PARA VER -->
                                        <div class="modal fade" id="verModal{{ $caja->id }}" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- Header del modal -->
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel"><b>Usuario registrado</b>
                                                        </h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <!-- Formulario -->
                                                    <form action="{{ route('admin.cajas.show', $caja->id) }}" method="GET">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">

                                                        </div>
                                                        <!-- Footer del modal -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- MODAL PARA EDITAR USUARIO -->
                                        <div class="modal fade" id="editarModal{{ $caja->id }}" tabindex="-1"
                                            aria-labelledby="editarModalLabel{{ $caja->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- Header del modal -->
                                                    <div class="modal-header bg-success text-white">
                                                        <h5 class="modal-title" id="editarModalLabel{{ $caja->id }}"><b>Editar
                                                                cajas</b></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <!-- Formulario -->

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                                        <label for="monto_inicial" class="form-label">Monto Inicial</label>
                                        <input type="number" step="0.01" class="form-control" id="monto_inicial"
                                            name="monto_inicial">
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


@endsection

@section('css')
@endsection

@section('js')
@endsection