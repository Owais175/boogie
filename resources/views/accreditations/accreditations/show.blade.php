@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Accreditation {{ $accreditation->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/accreditations/accreditations') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $accreditation->id }}</td>
                            </tr>
                            <tr><th> Title </th><td> {{ $accreditation->title }} </td></tr><tr><th> Description </th><td> {{ $accreditation->description }} </td></tr><tr><th> Image </th><td> {{ $accreditation->image }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.footer')
</div>
@endsection

