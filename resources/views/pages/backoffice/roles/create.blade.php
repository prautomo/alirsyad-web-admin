@extends('layouts.app')

@section('title', 'Create Role')

@section('header')
  @parent

  <div class="row align-items-center py-4">
    <div class="col-lg-6 col-7">
      <h6 class="h2 text-dark d-inline-block mb-0">@yield('title')</h6>
    </div>
    <div class="col-lg-6 col-5 text-right">
      <a href="{{ route('backoffice::roles.index') }}" class="btn btn-sm btn-neutral">Back</a>
      <!-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
    </div>
  </div>
@endsection

@section('content')

<div class="row">
  <div class="col">
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::open(array('route' => 'backoffice::roles.store','method'=>'POST')) !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="form-control-label" for="input-name">Name</label>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                    <label class="form-control-label" for="input-perm">Permission</label><br/>
                    @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->name }}</label>
                    <br/>
                    @endforeach
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
                
        </div>
        {!! Form::close() !!}
    </div>

@endsection