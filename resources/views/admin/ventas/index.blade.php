@extends('adminlte::page')

@section('content_header')
    <h1><b>Ventas</b></h1>
@endsection

@section('content')
<div class="row">
    <!-- Tabla de ventas registradas -->
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ventas registradas</h3>

                <div class="card-tools">
                    <a href="{{ url('/admin/ventas/create') }}" class="btn btn-primary" style="margin-left: 20px;">
                        <i class="fas fa-plus"></i> Nuevo venta
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="mitabla" class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="text-align: center">Nro</th>
                            <th scope="col" style="text-align: center">Producto</th>
                            <th scope="col" style="text-align: center">Fecha</th>
                            <th scope="col" style="text-align: center">Precio total</th>
                        >
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1; ?>
                        @foreach($ventas as $venta)
                            <tr>
                                <td style="text-align: center">{{ $contador++ }}</td>
                                <td style="vertical-align: middle">
                                    <ul>
                                        @foreach($venta->detallesVenta as $detalle)
                                            <li>{{ $detalle->producto->nombre . ' - ' . $detalle->cantidad}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $venta->fecha }}</td>
                                <td>{{ $venta->precio_total }}</td>
                       
                                <td style="text-align: center">
                                    <!-- Botón ver las ventas-->
                                  <!-- Botón pdf -->
                                    <a href="{{ url('/admin/ventas/pdf/' . $venta->id) }}" target="_blank" class="btn btn-outline-warning">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    </a>
                                        <!-- Botón pverrr-->
                                        <a href="{{ url('/admin/ventas', $venta->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Botón Editar -->
                                    <a href="{{url('/admin/ventas/'. $venta->id.'/edit') }}" class="btn btn-outline-success">
                                        <i class="fas fa-pencil"></i>
                                    </a>

                                    <!-- Modal editar ventas -->

                                    <!-- Botón Eliminar -->
                                    <form action="{{url('/admin/ventas',$venta->id)}}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                         

                                </div> <!-- Cierra la fila correctamente -->

                            </div>  
                            
                            
                        </div>
                    </div>

                 
                </form>
            </div>
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
@endsection

@section('css')
@endsection

@section('js')
<script>





    
    $('#mitabla').DataTable({
        "pageLength": 5,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos disponibles en la tabla"
        }
    });
</script>
@endsection
