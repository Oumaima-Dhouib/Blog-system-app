@extends('layouts.app')

<body class="bg-white">
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gestion des roles</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Créer un nouveau role </a>
            @endcan
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
  <table class="table table-striped">
  <tr>
     <th>Num</th>
     <th>Nom</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
            @endcan
            @csrf
                    @method('DELETE')
                    @can('role-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
        </td>
    </tr>
    @endforeach
</table>
</div>
</div>
<!-- end content-->
</div>
<!--  end card  -->
</div>
<!-- end col-md-12 -->
</div>
<!-- end row -->
</div>
</div>
</body>
{!! $roles->render() !!}
@endsection