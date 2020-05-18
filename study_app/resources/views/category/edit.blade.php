@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col col-md-offset-3 col-md-6">
      <nav class="card">
        <div class="card-header">カテゴリーを編集する</div>
        <div class="card-body">
          @if($errors->any())
            <div class="alert alert-danger">
              @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
              @endforeach  
            </div>
          @endif
          <form action="{{ route('category.edit', ['id' => $category->id]) }}" method="post">
            @csrf
            <div class="form-group">
              <label for="title">カテゴリー名</label>
              <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $category->title }}" />
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary">送信</button>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </div>
</div>

@endsection

