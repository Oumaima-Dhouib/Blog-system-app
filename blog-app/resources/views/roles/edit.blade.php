@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Modifier un role</h2>
        </div>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
<body class="bg-white">
<form method="POST" action="{{ route('roles.update', $role->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
    <div class="mb-3">
        <strong>
            <label for="name" class="form-label">Nom</label>
        </strong>
        <input type="text" class="form-control" value="{{ $role->name }}" name="name">
      </div>
      <div class="mb-3">
        <strong>
            <label for="permission" class="form-label">Permission</label>
        </strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>
</body>
@endsection
