@extends('layouts.backoffice')

@section('title', 'Manage Roles')

@section('header')
  @parent

  <div class="row align-items-center py-4">
    <div class="col-lg-6 col-7">
      <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
    </div>
    <!-- @can('role-create')
    <div class="col-lg-6 col-5 text-right">
      <a href="{{ route('backoffice::roles.create') }}" class="btn btn-sm btn-neutral">New</a>
    </div>
    @endcan -->
  </div>
@endsection

@section('content')
<div class="row">
  <div class="col">
    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Success!</strong> {{ $message }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    @endif
    @if ($message = Session::get('failed'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <span class="alert-text"><strong>Failed!</strong> {{ $message }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    @endif
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">Data</h3>
      </div>
      <!-- tble -->
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col" class="sort" data-sort="no">No</th>
              <th scope="col" class="sort" data-sort="name">Name</th>
              <th scope="col">Action</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($roles as $key => $role)
              <tr>
                <td>{{ ++$i }}</td>
                <th scope="row">{{ $role->name }}</th>
                <td>
                    @can('role-edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('backoffice::roles.edit',$role->id) }}">Edit</a>
                    @endcan
                    <!-- @can('role-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['backoffice::roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endcan -->
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer py-4">
        {!! $roles->render() !!}
      </div>
      <!-- endtble -->
    </div>
  </div>
</div>
@endsection