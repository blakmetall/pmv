
Datos <br>
{{ $row }} <br><br>

Datos con traduccones <br>
{{ $row->translations }} <br><br>

Queries <br>
{{ $row->translations()->get() }} <br><br><br>


<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
</div>

<div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
</div>

<fieldset class="form-group">
    <div class="row">
        <div class="col-form-label col-sm-2 pt-0">Radios</div>
        <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                <label class="form-check-label" for="gridRadios1">
                    First radio
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                <label class="form-check-label" for="gridRadios2">
                    Second radio
                </label>
            </div>
            <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                <label class="form-check-label" for="gridRadios3">
                    Third disabled radio
                </label>
            </div>
        </div>
    </div>
</fieldset>

<div class="form-group row">
    <div class="col-sm-2">Checkbox</div>
    <div class="col-sm-10">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck1">
            <label class="form-check-label" for="gridCheck1">
                Example checkbox
            </label>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
</div>





{{--
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
--}}