@extends('layouts.horizontal-master')
@section('page-css')

@endsection
@section('main-content')

    <div class="separator-breadcrumb border-top"></div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ trans(session()->get('message')) }}
        </div>
    @endif


    <div class="row col-md-12">
        <div class="col-md-3"></div>
            <div class="row align-self-center col-md-6">

                <div class="col-md-12">
                    <div class="card mb-6">
                        <div class="card-body">
                            <div class="card-title mb-3">{{ trans('messages.property-types-title') }}</div>
                            <form method="POST" action="{{ route('types-store' ) }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="spanishPropertyType">{{ trans('messages.property-types-name-label-es') }}</label>
                                        <input type="text" class="form-control" name="spanishPropertyType"
                                               placeholder="{{ trans('messages.property-types-name-label-es') }}" >
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="spanishPropertyType">{{ trans('messages.property-types-name-label-en') }}</label>
                                        <input type="text" class="form-control" name="englishPropertyType"
                                               placeholder="{{ trans('messages.property-types-name-label-en') }}" >
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">{{ trans('messages.from-btn-label') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="separator-section" style="margin-top: 5px;">&nbsp;</div>
                <div class="col-md-12">
                    <div class="card mb-6">
                        <div class="card-body">
                            <div class="row" style="padding: 10px;"> <!-- Style moverlo a css -->
                                <div class="col-md-9"><h4 class="card-title mb-3">{{ trans('messages.property-types-title') }}</h4></div>
                                <div class="col-md-3">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ trans('messages.property-types-table-col-name') }}</th>
                                        <th scope="col">{{ trans('messages.property-types-table-col-action') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($properties_types as $type)
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{ $type['id'] }}</th>
                                            <td>{{ $type['name'] }}</td>
                                            <td>
                                                @if($type['id'] > 10)
                                                <a href="#" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>

                                                <a  href="#" class="text-danger mr-2"
                                                    data-toggle="modal"
                                                    data-delete="{{ route( 'types-destroy', [ 'id' => $type['property_type_id'] ] ) }}"
                                                    data-target="#deleteModal">

                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">{{ 'Do you want to delete this Property Type?' }}</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary ripple m-1" data-dismiss="modal" >   {{ 'Cancel' }}
                                                                    </button>
                                                                    <a href="{{ route( 'types-destroy', [ 'id' => $type['property_type_id'] ] ) }}" type="button" class="btn btn-danger">{{ 'Delete' }}</a>
                                                                    <!-- Agregar traduccion de delete -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <!--href="{{ route( 'types-destroy', [ 'id' => $type['property_type_id'] ] ) }}" -->
                                                @else
                                                    {{ 'Protected data' }}
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    @endforeach

                                </table>
                                <div class="pagination-wrapper">
                                    {{ $properties_types->render() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

@endsection

@section('page-js')

@endsection

