@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Créer un nouveau utilisateur </h2>
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
<form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="mb-3">
        <strong>
            <label for="userName" class="form-label">Nom d'utilisateur</label>
        </strong>
      <input type="text" class="form-control" name="userName">
    </div>
    <div class="mb-3">
      <strong>
        <label for="firstName" class="form-label">Nom</label>
      </strong>
      <input type="text" class="form-control" name="firstName">
     </div>
    <div class="mb-3">
        <strong>
            <label for="lastName" class="form-label">Prènom</label>
        </strong>
        <input type="text" class="form-control" name="lastName">
    </div>
    <div class="mb-3">
        <strong>
            <label for="email" class="form-label">Email</label>
        </strong>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="mb-3">
        <strong>
            <label for="password" class="form-label">Mot de passe</label>
        </strong>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="mb-3">
        <strong>
            <label for="password" class="form-label">Confirmer mot de passe</label>
        </strong>
        <input type="password" class="form-control" name="confirm-password">
    </div>
    <div class="mb-3">
        <strong>
            <label for="role" class="form-label">Role</label>
        </strong>
        <select class="form-control" data-style="select-with-transition" id="roles" name="roles" title="Choisir Role" style="width: 100%;">
            @foreach ($roles as $role)
            <option >
            {{ $role }}</option>
            @endforeach
        </select>
    </div>
    <strong>
        <label for="image" class="form-label">Image</label>
    </strong>
    <div class="mb-3">
      
      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
        
        <div class="fileinput-new thumbnail">
          
          <img src="" alt="...">
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail"></div>
        <div>
          <span class="btn btn-secondary btn-round btn-file">
            <span class="fileinput-new">choisir une image</span>
            <span class="fileinput-exists">Changer</span>
            <input type="file" name="image" />
          </span>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
  
</div>

</form>
</body>
@endsection