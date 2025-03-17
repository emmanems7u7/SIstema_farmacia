@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Dashboard{{$sucursal->nombre}}</b></h1>
    <hr>
@stop

@section('content')
    
<div class="row ">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info elemento">
              <div class="inner">
                <h3>
                  <span class="info-box-number">{{$total_productos}} </span>
                </h3>
                <p>Productoss Registrados</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
            
              <a href="{{ url('/admin/productos/create') }}" class="small-box-footer">
              Nuevo producto <i class="fas fa-arrow-circle-right"></i>
          </a>
                      </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 elemento" >
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                <span class="info-box-number">{{$total_compras}} </span>
                </h3>
                <p>Compras registradas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ url('/admin/compras/create') }}" class="small-box-footer">
                Nueva compra <i class="fas fa-arrow-circle-right"></i>
              </a>
             
          
            </div>
          </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger elemento">
              <div class="inner">
                <h3>
                <span class="info-box-number">{{$total_ventas}} </span>
                </h3>
            

                <p>Ventas</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="{{ url('/admin/ventas/create') }}" class="small-box-footer">" 
                Nueva venta <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning elemento">
              <div class="inner">
                <h3>
                <span class="info-box-number">{{$total_clientes}} </span>
                </h3>

                <p>Clientes</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="{{ url('/admin/clientes') }} class="small-box-footer">
                Nuevo cliente <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
  
        </div>


  
            <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">VENTAS</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 334px;" width="334" height="250" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- PIE CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">PRODUCTOS MAS VENDIDOS</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 334px;" width="334" height="250" class="chartjs-render-monitor"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">COMPRAS</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 334px;" width="334" height="250" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           

        

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div>

@stop

@section('css')
    
@stop

@section('js')



@if( (($mensaje = Session::get('mensaje')) && ($icono = Session::get('icono'))) )
<script>
    Swal.fire({
  position: "top-end",
  icon: "{{$icono}}",
  title: "{{$mensaje}}",
  showConfirmButton: false,
  timer: 4000
});
</script>
   @endif
@stop