@extends('layouts.app')

<body class="bg-white">
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gestion des posts</h2>
            </div>
            <div class="pull-right">
                @can('post-create')
                <a class="btn btn-success" href="{{ route('posts.create') }}"> Créer un nouveau post</a>
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
            <th>Image</th>
            <th>Titre</th>
            <th>Contenant</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($posts as $post)
	    <tr>
	        <td>{{ ++$i }}</td>
            <td>
                <img src="{{ asset('images/'.$post->image) }}" width="90" height="90" class="img-thumbnail rounded-circle">
            </td>
	        <td>{{ $post->title }}</td>
	        <td>{{ $post->content }}</td>
	        <td>
                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('posts.show',$post->id) }}">Show</a>
                    @can('post-edit')
                    <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('post-delete')
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

    {!! $posts->links() !!}
@endsection