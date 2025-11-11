@extends('layouts.sidebar')

@vite(['resources/js/form-maderas.js'])
@section('content')
            <div class="container ">
                <div class="d-flex justify-content-between m-2">
                    <h1>Maderas</h1>
                    <button id="btn-agregar-madera" class="btn bg-black text-white">Agregar madera</button>
                </div>
                <h4>Ingresa las medidas en metros</h4>
                
                <form id="form-cont" action="">
                    <div class="row mb-2">
                        <div class="col-12">
                            
                            <select name="" id="" class="form-select w-25">
                                <option value="" disabled selected>Selecciona el tipo de madera</option>
                                <option value="" >Pino</option>
                                <option value="" >Encino</option>
                                <option value="" >Cedro</option>
                                <option value="" >Poplar</option>
                                <option value="" >Parota</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="pieza" class="form-label">Pieza</label>
                            <input type="text" name="pieza" id="" placeholder="Fondo" class="form-control col-auto">
                        </div>
                        <div class="col-auto">

                            <label for="pieza" class="form-label">Largo</label>
                            <input type="text" name="pieza" id="" class="form-control col-auto">
                        </div>
                        <div class="col-auto">

                            <label for="pieza" class="form-label">Ancho</label>
                            <input type="text" name="pieza" id="" class="form-control col-auto">
                        </div>
                        <div class="col-auto">

                            <label for="pieza" class="form-label">Cantidad</label>
                            <input type="text" name="pieza" id="" class="form-control col-auto">
                        </div>
                        <div class="col-auto ms-auto">
                            <button id="btn-eliminar-madera" class="btn btn-outline-danger">Eliminar</button>
                        </div>
                    </div>
                    
                </form>
            </div>
@endsection