@extends('layouts.horizontal-master')
@section('page-css')

@endsection
@section('main-content')


    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Registro de tipo de Propiedad</div>
                    <form >
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="spanishPropertyType">Tipo de Propiedad en Español</label>
                                <input type="text" class="form-control" id="spanishPropertyType" placeholder="Ingresa el tipo de propiedad en Español">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="spanishPropertyType">Tipo de Propiedad en Inglés</label>
                                <input type="text" class="form-control" id="englishPropertyType" placeholder="Ingresa el tipo de propiedad en Inglés">
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-js')

@endsection
