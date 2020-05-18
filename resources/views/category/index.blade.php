@extends('layout')

@section('content')
<div class="container">
  <h3>カテゴリー</h3>
  <div class="">
    <a href="/category/create" class="btn btn-outline-primary">カテゴリーを追加する</a>
  </div>
  <table class="table">
    <thead>
    <tr>
        <th style="width:50%;">タイトル</th>
        <th style="width:25%;"></th>
        <th style="width:25%;"></th>
    </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
      <tr>
        <td>{{ $category->title }}</td>
        <td class="text-right"><a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn-sm btn-outline-primary">編集</a></td>
        <form action="{{ route('category.delete', ['id' => $category->id]) }}" method="post">
          @csrf
          <td class="text-right">
            <button type="submit" class="btn-sm btn-outline-primary" onclick='return confirm("カテゴリーに紐づく学習記録も削除されます。\n本当に削除しますか？")'>削除</button>
          </td>
        </form>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('script')
<script>
    
</script>
@endsection

