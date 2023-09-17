@extends('layouts.app')

<body class="bg-white">
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gestion des utilisateurs</h2>
            </div>
            <div class="pull-right">
                @can('user-create')
                <a class="btn btn-success text-capitalize" href="{{ route('users.create') }}"> Créer un nouveau utilisateur </a>
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
          <th>Nom d'utilisateur</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Role</th>
          <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->userName }}</td>
            <td>{{ $user->firstName }}</td>
            <td>{{ $user->lastName }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                   <label class="">{{ $v }}</label>
                @endforeach
              @endif
            </td>
	        <td>
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                    @can('user-edit')
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('user-delete')
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

    {!! $data->render() !!}
@endsection