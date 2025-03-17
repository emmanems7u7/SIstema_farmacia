@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Sucursales registradas</h1>
<hr>
@stop

@section('content')
<div class="row">
    <!-- Tabla de sucursales registradas-->
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Sucursales registrados</h3>
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalCrear">
                    <i class="fas fa-plus"></i> Nueva sucursal
                </button>

                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">


                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="text-align: center">Nro</th>
                            <th scope="col" style="text-align: center">Imagen</th>
                            <th scope="col" style="text-align: center">Nombre</th>
                            <th scope="col" style="text-align: center">Correo</th>
                            <th scope="col" style="text-align: center">Dirección</th>
                            <th scope="col" style="text-align: center">Teléfono</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach($sucursals as $sucursal)
                            <tr>
                                <td style="text-align: center">{{ $contador++ }}</td>
                                <td style="text-align: center">
                                    @if($sucursal->imagen)
                                        <img src="{{ asset('storage/' . $sucursal->imagen) }}" width="60" alt="Imagen">
                                    @else
                                        Sin imagen
                                    @endif
                                </td>
                                <td style="text-align: center">{{ $sucursal->nombre }}</td>
                                <td style="text-align: center">{{ $sucursal->email }}</td>
                                <td style="text-align: center">{{ $sucursal->direccion }}</td>
                                <td style="text-align: center">{{ $sucursal->telefono }}</td>
                                <td style="text-align: center">
                                    <!-- Botón Editar -->
                                    <a href="{{ url('/admin/configuraciones') }}" class="btn btn-outline-success">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <!-- Botón Eliminar -->

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>



                <div class="modal fade" id="modalCrear" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
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
                            <form action="{{ route('admin.sucursals.create') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="imagen"><b>Imagen</b></label>
                                        <input type="file" id="file" name="imagen" accept=".jpg, .jpeg, .png"
                                            class="form-control" required>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre"><b>Nombre</b></label>
                                        <input type="text" value="{{old('nombre')}}" name="nombre" class="form-control"
                                            required>
                                        @error('nombre')
                                            <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email"><b>Correo</b></label>
                                        <input type="email" value="{{old('email')}}" name="email" class="form-control"
                                            required>
                                        @error('email')
                                            <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre"><b>Direccion</b></label>
                                        <input type="text" value="{{old('direccion')}}" name="direccion"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre"><b>Telefono</b></label>
                                        <input type="text" value="{{old('telefono')}}" name="telefono"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Crear sucursal</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                @stop

                @section('css')

                @stop

                @section('js')

                @stop