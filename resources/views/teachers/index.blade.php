@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Teachers Listing</div>
                @include('flash::message')
                <div class="col-md-1">

                    <a href="{{url('teachers/create')}}" class="btn btn-success">Add</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Students</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($teachers) && $teachers->count())
                                @foreach($teachers as $key => $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->subject }}</td>
                                        <td>
                                            <a href="{{url('teacher/students/'.$value->id)}}"  class="btn btn-success">Click Here</a>
                                        </td>
                                        <td>
                                            <a href="{{url('teachers/'.$value->id.'/edit')}}" class="btn btn-success">Edit</a>
                                            <form action="{{ route('teachers.destroy',$value->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
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


                    {!! $teachers->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
