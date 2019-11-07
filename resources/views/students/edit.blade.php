@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit') }} student</div>
                @include('flash::message')
                <div class="card-body">
                    <form action="{{ route('students.update',$student->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                   
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input id="name" type="text" name="name" value="{{ $student->name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <input type="text" name="email" value="{{ $student->email }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="email">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Address:</strong>
                                    <input type="text" name="address" value="{{ $student->address }}" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="address">
                                    @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label for="teacher" class="col-md-4 col-form-label text-md-right">{{ __('teacher_id') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="teacher">
                                        @foreach($teachers as $row)
                                            <option value="{{$row->id}}" @if($student->teacher_id==$row->id) selected @endif>{{$row->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('teacher'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('teacher') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row col-md-12 clearfix"></div>
                            <div class="clearfix"></div><br>
                            <div class="form-group row">
                                <label for="preview" class="">{{ __('Preview') }}</label>

                                <div class="col-md-6">
                                    <img src="{{url('/uploads/'.$student->image)}}" height="100px" width="200px">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">

                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <a href="{{url('students')}}" class="btn btn-success"> Back</a>
                            </div>
                        </div>
                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
