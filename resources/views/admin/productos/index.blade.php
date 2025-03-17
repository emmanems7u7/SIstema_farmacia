@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Laboratorios</b></h1>
    
@stop

@section('content')
<div class="row">


<section class="content">
      <!-- Default box -->
      <div class="card card-solid">
      <div class="col-md-12">
        <div class="card-body pb-sm">
        
            <!-- Buscador de productos -->
            <div class="mb-2">
                <div class="d-flex justify-content-between">
                    <!-- Campo de búsqueda -->
                    
                    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar producto...">

                    <!-- Botón de nuevo producto -->
                    <a href="{{ url('/admin/productos/create') }}" class="btn btn-primary ml-3">
                        <i class="fas fa-plus"></i> Nuevo Producto
                    </a>
                </div>
                <hr>
            </div>

          <div class="row">
           

            
          <?php $contador = 1; ?>
          @foreach($productos as $producto) 
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
              
                <div class="card-header text-muted border-bottom-0">
                    <b>
                            <div style="text-align: left">Nro {{ $contador++ }}</div>                  
                    </b>
                </div>
                    <div class="card-header text-muted border-bottom-0"><b>  
                       <td style="text-align: center"></td></b>
                        Código: {{ $producto->codigo }}
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                           
                                <h2 class="lead"><b>{{ $producto->nombre }}</b></h2>
                                <p class="text-muted text-sm"><b>Descripción: {{ $producto->descripcion }}</b></p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small">
                                        <span class="fa-li">
                                            <i class="fas fa-lg fa-box"></i>
                                        </span> 
                                        <span style="color: red;">
                                        <strong class="font-weight-bold" style="font-size: 16px;">Stock: {{ $producto->stock }}</strong>
                                        </span> 
                                    </li>
                                    <li class="small">
                                        <span class="fa-li">
                                        <i class="fa-solid fa-money-bill"></i>
                                        </span> 
                                        <span style="color: red;">
                                        <strong class="font-weight-bold" style="font-size: 16px;">Precio: {{ $producto->precio_venta }}</strong>
                                        </span> 
                                    </li>
                                    <li class="small">
                                        
                                        <span style="color: red;">
                                        <strong class="font-weight-bold" style="font-size: 16px;">F.V: {{ $producto->fecha_vencimiento }}</strong>
                                        </span> 
                                    </li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                @if($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" width="110" alt="Imagen">
                                @else
                                    <p>Sin imagen</p>
                                @endif
                            </div>
                        </div>
                    </div>
                   
                    <div class="card-footer">
                        <div class="text-right">
                            <!-- Botón Ver -->
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#verModal{{ $producto->id }}">
                                <i class="fas fa-eye"></i>
                            </button>



                           
                                        
            
        

                            <!-- Botón Editar -->
                            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editarModal{{ $producto->id }}">
                                <i class="fas fa-pencil-alt"></i>
                            </button>

                            <!-- Botón Eliminar -->
                            <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form> 


                                <div class="row">
                                    <!-- Modal para ver -->
                                    <div class="modal fade" id="verModal{{ $producto->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <!-- Header del modal -->
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel"><b>Producto Detalles</b></h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- Formulario -->
                                                <form action="{{ route('admin.productos.show', $producto->id) }}" method="GET">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <!-- Categoría -->
                                                            <div class="col-md-6">
                                                                <div class="form-group text-left">
                                                                    <label for="categoria" class="text-dark font-weight-bold">Categoría</label>
                                                                    <p class="font-weight-bold">{{ $producto->categoria->nombre }}</p>
                                                                </div>
                                                            </div>
                                                            <!-- Laboratorio -->
                                                            <div class="col-md-6">
                                                                <div class="form-group text-left">
                                                                    <label for="laboratorio" class="text-dark font-weight-bold">Laboratorio</label>
                                                                    <p class="font-weight-bold">{{ $producto->laboratorio->nombre }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- Nombre del Producto -->
                                                            <div class="col-md-6">
                                                                <div class="form-group text-left">
                                                                    <label for="nombre" class="text-dark font-weight-bold">Nombre del Producto</label>
                                                                    <p>{{ $producto->nombre }}</p>
                                                                </div>
                                                            </div>
                                                            <!-- Descripción -->
                                                            <div class="col-md-6">
                                                                <div class="form-group text-left">
                                                                    <label for="descripcion" class="text-dark font-weight-bold">Descripción</label>
                                                                    <p>{{ $producto->descripcion }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- Stock -->
                                                            <div class="col-md-4">
                                                                <div class="form-group text-left">
                                                                    <label for="stock" class="text-dark font-weight-bold">Stock</label>
                                                                    <input type="text" 
                                                                        class="form-control" 
                                                                        style="width: 50px; text-align: center; background-color: red;" 
                                                                        value="{{ $producto->stock }}" 
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <!-- Stock Mínimo -->
                                                            <div class="col-md-4">
                                                                <div class="form-group text-left">
                                                                    <label for="stock_minimo" class="text-dark font-weight-bold">Stock Mínimo</label>
                                                                    <p>{{ $producto->stock_minimo }}</p>
                                                                </div>
                                                            </div>
                                                            <!-- Stock Máximo -->
                                                            <div class="col-md-4">
                                                                <div class="form-group text-left">
                                                                    <label for="stock_maximo" class="text-dark font-weight-bold">Stock Máximo</label>
                                                                    <p>{{ $producto->stock_maximo }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- Precio de Venta -->
                                                            <div class="col-md-4">
                                                                <div class="form-group text-left">
                                                                    <label for="precio_venta" class="text-dark font-weight-bold">Precio de Venta</label>
                                                                    <p>{{ $producto->precio_venta }}</p>
                                                                </div>
                                                            </div>
                                                            <!-- Precio de Compra -->
                                                            <div class="col-md-4">
                                                                <div class="form-group text-left">
                                                                    <label for="precio_compra" class="text-dark font-weight-bold">Precio de Compra</label>
                                                                    <p>{{ $producto->precio_compra }}</p>
                                                                </div>
                                                            </div>
                                                            <!-- Fecha de Ingreso -->
                                                            <div class="col-md-4">
                                                                <div class="form-group text-left">
                                                                    <label for="fecha_ingreso" class="text-dark font-weight-bold">Fecha de Ingreso</label>
                                                                    <p>{{ $producto->fecha_ingreso }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- Fecha de Vencimiento -->
                                                            <div class="col-md-6">
                                                                <div class="form-group text-left">
                                                                    <label for="fecha_vencimiento" class="text-dark font-weight-bold">Fecha de Vencimiento</label>
                                                                    <p class="font-weight-bold">{{ $producto->fecha_vencimiento }}</p>
                                                                </div>
                                                            </div>
                                                            <!-- Imagen -->
                                                            <div class="col-md-6">
                                                                <div class="form-group text-left">
                                                                    <label for="imagen" class="text-dark font-weight-bold">Imagen</label>
                                                                    <p><img src="{{ asset('storage/'.$producto->imagen) }}" class="img-fluid" width="100" alt="Imagen Producto"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Footer del modal -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


    <!-- MODAL PARA EDITAR PRODUCTO -->
    <div class="modal fade" id="editarModal{{ $producto->id }}" tabindex="-1" aria-labelledby="editarModalLabel{{ $producto->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-left">
                <!-- Header del modal -->
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="editarModalLabel{{ $producto->id }}"><b>Editar Producto</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Formulario -->
                <form action="{{ url('/admin/productos', $producto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body text-left">
                        <div class="row">
                            <!-- Primera columna -->
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group text-left">
                                            <label for="categoria_id">Categoría</label>
                                            <select name="categoria_id" class="form-control" required>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}" {{ $categoria->id == $producto->categoria_id ? 'selected' : '' }}>
                                                        {{ $categoria->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="laboratorio_id">Laboratorio</label>
                                            <select name="laboratorio_id" class="form-control" required>
                                                @foreach($laboratorios as $laboratorio)
                                                    <option value="{{ $laboratorio->id }}" {{ $laboratorio->id == $producto->laboratorio_id ? 'selected' : '' }}>
                                                        {{ $laboratorio->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="codigo">Código</label>
                                            <input type="text" class="form-control" name="codigo" value="{{ $producto->codigo }}" required>
                                            @error('codigo')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre del Producto</label>
                                            <input type="text" class="form-control" value="{{ $producto->nombre }}" name="nombre"  required>
                                            @error('nombre')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Segunda fila -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <input type="text" class="form-control"  value="{{ $producto->descripcion }}" name="descripcion">
                                            @error('descripcion')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="number" class="form-control" value="{{ $producto->stock }}" name="stock" required>
                                            @error('stock')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_minimo">Stock mínimo</label>
                                            <input type="number" class="form-control" value="{{ $producto->stock_minimo }}" name="stock_minimo" required>
                                            @error('stock_minimo')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_maximo">Stock máximo</label>
                                            <input type="number" class="form-control" value="{{ $producto->stock_maximo }}" name="stock_maximo" required>
                                            @error('stock_maximo')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Tercera fila -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio de compra</label>
                                            <input type="text" class="form-control" value="{{ $producto->precio_compra }}"  name="precio_compra" required>
                                            @error('precio_compra')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio de venta</label>
                                            <input type="text" class="form-control"  value="{{ $producto->precio_venta }}" name="precio_venta" required>
                                            @error('precio_venta')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha de ingreso</label>
                                            <input type="date" class="form-control" value="{{ $producto->fecha_ingreso }}" name="fecha_ingreso" required>
                                            @error('fecha_ingreso')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha_vencimiento">Fecha de vencimiento</label>
                                            <input type="date" class="form-control" value="{{ $producto->fecha_vencimiento }}"  name="fecha_vencimiento">
                                            @error('fecha_vencimiento')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                                           <!-- Segunda columna: Imagen -->
                                            <div class="col-md-3">                                           
                                            <div class="form-group">
                                                <label for="imagen"><b>Imagen</b></label>
                                                    <input type="file" id="file" name="imagen" accept=".jpg, .jpeg, .png" class="form-control" >
                                                    <br>
                                                    <center><output id="list"><p><img src="{{ asset('storage/'.$producto->imagen) }}" class="img-fluid" width="100" alt="Imagen Producto"></p></output></center>
                                                    <script>
                                                        function archivo(evt) {
                                                            var files = evt.target.files;

                                                            // Iterar sobre los archivos seleccionados
                                                            for (var i = 0, f; f = files[i]; i++) {
                                                                // Verificar si es una imagen
                                                                if (!f.type.match('image.*')) {
                                                                    continue;
                                                                }

                                                                var reader = new FileReader();
                                                                reader.onload = (function (theFile) {
                                                                    return function (e) {
                                                                        // Insertar la imagen en el contenedor
                                                                        document.getElementById("list").innerHTML = [
                                                                            '<img class="thumb thumbnail" src="',
                                                                            e.target.result,
                                                                            '" width="70%" title="',
                                                                            escape(theFile.name),
                                                                            '"/>'
                                                                        ].join('');
                                                                    };
                                                                })(f);

                                                                // Leer el archivo como una URL de datos
                                                                reader.readAsDataURL(f);
                                                            }
                                                        }

                                                        // Agregar evento al input de archivo
                                                        document.getElementById('file').addEventListener('change', archivo, false);
                                                    </script>

                                                </div>
                                            </div> 
                        
                                        </div>
                                    </div>

                                    <!-- Footer del modal -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
            @endforeach
      </div>
    </section>
</div>
@endsection

@section('css')


@stop



@section('js')




<script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>

<script>
    var options = {
        valueNames: ['producto-nombre', 'producto-descripcion', 'producto-stock', 'producto-precio'],
        page: 5, // Cantidad de tarjetas por página
        pagination: true
    };

    var productosList = new List('productosContainer', options);

    $('#searchInput').on('keyup', function() {
        productosList.search($(this).val());
    });
</script>

@endsection
