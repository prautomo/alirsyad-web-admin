@extends('layouts.backoffice')

@section('title', 'Manage Users')

@section('header')
  @parent

  <div class="row align-items-center py-4">
    <div class="col-lg-6 col-7">
      <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
    </div>
    @can('user-create')
    <div class="col-lg-6 col-5 text-right">
      <a href="{{ route('backoffice::users.create', ['role'=>\Request::get('role')]) }}" class="btn btn-sm btn-neutral">New</a>
      <!-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
    </div>
    @endcan
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
              <th scope="col" class="sort" data-sort="email">Email</th>
              <th scope="col">Roles</th>
              <th scope="col">Action</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody class="list">
            @forelse ($data as $key => $user)
              <tr>
                <td>{{ ++$i }}</td>
                <th scope="row">{{ $user->name }}</th>
                <td>{{ $user->email }}</td>
                <td>
                  @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                      <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                  @endif
                </td>
                <td>
                  <!-- <a class="btn btn-info btn-sm" href="{{ route('backoffice::users.show',$user->id) }}">Show</a> -->
                  @can('user-edit')
                  <a class="btn btn-primary btn-sm" href="{{ route('backoffice::users.edit',$user->id) }}">Edit</a>
                  @endcan
                  @can('user-delete')
                  {!! Form::open(['method' => 'DELETE','route' => ['backoffice::users.destroy', $user->id],'style'=>'display:inline']) !!}
                      {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                  {!! Form::close() !!}
                  @endcan
                </td>
              </tr>
            @empty
              <tr colspan="4">
                <td>Empty data.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="card-footer py-4">
        {!! $data->render() !!}
      </div>
      <!-- endtble -->
    </div>
  </div>
</div>
@endsection