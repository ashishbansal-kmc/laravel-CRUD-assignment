@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$data->name}} 's Students Listing</div>
                <div class="col-md-1">
                    <a href="{{url('teachers')}}" class="btn btn-success"> Back</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data->students) && $data->students->count())
                                @foreach($data->students as $key => $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->address }}</td>
                                    </tr>
                                @endforeach
                                
                            @else
                                <tr>
                                    <td colspan="10">There are no data.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>


                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
