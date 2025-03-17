@extends('adminlte::page')

@section('content_header')
    <h1><b>Productos</b></h1>
@endsection

@section('content')
                <div class="row">
                    <!-- Tabla de productos registrados -->
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Productos registrados</h3>
                            </div>                    
                                   <div class="card-body">                    
                                        <!-- Formulario para nuevo producto -->
                                        <form action="{{ url('/admin/productos/create') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="role">Categoría</label>
                                                                <select name="categoria_id" id="" class="form-control">
                                                                <option value="">Seleccionar una categoria</option>
                                                                    @foreach($categorias as $categoria)
                                                                    
                                                                        <option value="{{$categoria->id}}">{{$categoria->nombre}} </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="role">Laboratorio</label>
                                                        <select name="laboratorio_id" id="" class="form-control">
                                                        <option value="">Seleccionar un lab</option>
                                                            @foreach($laboratorios as $laboratorio)
                                                                <option value="{{ $laboratorio->id }}">{{ $laboratorio->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                 <!-- Campo Nombre del Usuario -->
                                                 <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="codigo">Codigo</label>
                                                        <input type="text" class="form-control" value="{{ old('codigo') }}" name="codigo" required>
                                                        
                                                        @error('codigo')
                                                        <small style="color: red;">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- Campo Nombre del Usuario -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre del Producto</label>
                                                        <input type="text" class="form-control" value="{{ old('nombre') }}" name="nombre"  placeholder="Ingrese el nombre del producto"required>
                                                        @error('nombre')
                                                        <small style="color: red;">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="descripcion">Descripcion"</label>
                                                        <input type="text" class="form-control" value="{{old('descripcion')}}" name="descripcion">
                                                        @error('descripcion')
                                                        <small style="color: red;">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="stock">Stock</label>
                                                        <input type="number" class="form-control" value="0" name="stock"  required>
                                                        @error('stock')
                                                        <small style="color: red;">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="stock_minimo">Stock minimo</label>
                                                        <input type="number" class="form-control" value="0" name="stock_minimo"  required>
                                                        @error('stock_minimo')
                                                        <small style="color: red;">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="stock_maximo">Stock maximo</label>
                                                        <input type="number" class="form-control" value="0" name="stock_maximo"  required>
                                                        @error('stock_maximo')
                                                        <small style="color: red;">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="precio_compra">Precio_compra</label>
                                                        <input type="text" class="form-control" value="{{old('precio_compra')}}" name="precio_compra" required>
                                                        @error('precio_compra')
                                                        <small style="color: red;">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="precio_venta">Precio venta"</label>
                                                        <input type="text" class="form-control" value="{{old('precio_venta')}}" name="precio_venta" required>
                                                        @error('precio_venta')
                                                        <small style="color: red;">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="fecha_ingreso">Fecha de ingreso</label>
                                                        <input type="date" class="form-control" value="{{old('fecha_ingreso')}}" name="fecha_ingreso" required>
                                                        @error('fecha_ingreso')
                                                        <small style="color: red;">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="fecha_vencimiento">Fecha de vencimiento"</label>
                                                        <input type="date" class="form-control" value="{{old('fecha_vencimiento')}}" name="fecha_vencimiento" >
                                                        @error('fecha_vencimiento')
                                                        <small style="color: red;">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                
                                                </div>
                                            </div>
                                                </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="imagen"><b>Imagen</b></label>
                                                    <input type="file" id="file" name="imagen" accept=".jpg, .jpeg, .png" class="form-control" >
                                                    <br>
                                                    <center><output id="list"></output></center>
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
                                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                                    </div>

                                    </form> <!-- Se cierra el formulario aquí -->
                                </div>
                            </div>
                        </div>
                       
                    
                    <hr>
 
</div>
@endsection

@section('css')
@endsection

@section('js')
@endsection