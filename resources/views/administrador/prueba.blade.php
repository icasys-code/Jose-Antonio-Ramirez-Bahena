@extends('administrador.plantilla')

@section("content")
<div class="row">
    <div class="col-md-12">
        <h1>Dashboard Administrador</h1>
        <p>Bienvenido al panel de administración de la Refaccionaria Automotriz.</p>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Vehículos</h5>
                        <p class="card-text">Gestionar inventario de vehículos.</p>
                        <a href="{{ route('admin.vehicles.index') }}" class="btn btn-light">Ver</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Piezas</h5>
                        <p class="card-text">Administrar refacciones y componentes.</p>
                        <a href="{{ route('admin.parts.index') }}" class="btn btn-light">Ver</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Órdenes</h5>
                        <p class="card-text">Revisar pedidos y ventas.</p>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-light">Ver</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios</h5>
                        <p class="card-text">Gestionar cuentas de usuario.</p>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light">Ver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection