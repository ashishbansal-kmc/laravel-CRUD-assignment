@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit') }} Teacher</div>
                @include('flash::message')
                <div class="card-body">
                    <form action="{{ route('teachers.update',$teacher->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                   
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input id="name" type="text" name="name" value="{{ $teacher->name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
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
                                    <input type="text" name="email" value="{{ $teacher->email }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="email">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Subject:</strong>
                                    <input type="text" name="subject" value="{{ $teacher->subject }}" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" placeholder="subject">
                                    @if ($errors->has('subject'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="preview" class="">{{ __('Preview') }}</label>

                                <div class="col-md-6">
                                    <img src="{{url('/uploads/'.$teacher->image)}}" height="100px" width="200px">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group row">
                                <label for="subject" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

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
                              <a href="{{url('teachers')}}" class="btn btn-success"> Back</a>
                            </div>
                        </div>
                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
