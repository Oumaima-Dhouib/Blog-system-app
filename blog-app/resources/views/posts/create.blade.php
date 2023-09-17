@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Créer un nouveau post</h2>
            </div>
        </div>
    </div>

    @if ($errors->any())
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
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    	@csrf
         <div class="row">
            <div class="mb-3">
                <strong>
                    <label for="titre" class="form-label">Titre</label>
                </strong>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <strong>
                    <label for="content" class="form-label">Contenant</label>
                </strong>
                <textarea class="form-control" style="height:150px" name="content"></textarea>
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