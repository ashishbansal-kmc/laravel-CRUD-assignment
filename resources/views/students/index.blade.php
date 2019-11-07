@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Students Listing</div>
                @include('flash::message')
                <div class="col-md-1">

                    <a href="{{url('students/create')}}" class="btn btn-success">Add</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>address</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($students) && $students->count())
                                @foreach($students as $key => $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>
                                            <a href="{{url('students/'.$value->id.'/edit')}}" class="btn btn-success">Edit</a>
                                       
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">There are no data.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>


                    {!! $students->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
