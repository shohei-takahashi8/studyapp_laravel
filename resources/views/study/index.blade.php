@extends('layout')

@section('content')
<div class="container">
  <h3>
    <a class="btn btn-outline-primary" href="/study?year={{$year}}&month={{$month}}&day={{$day - 1}}" role="button">&lt;</a>
    {{ $year }}年{{ $month }}月{{ $day }}日
    <a class="btn btn-outline-primary" href="/study?year={{$year}}&month={{$month}}&day={{$day + 1}}" role="button">&gt;</a>
  </h3>

  @if(isset($categories[0]))
  <div class="row">
  <div class="col col-xs-12 col-md-8">
    @if($errors->has('body_edit') || $errors->has('time_edit'))
      <div class="alert alert-danger">
        @foreach($errors->all() as $message)
          <li>{{ $message }}</li>
        @endforeach  
      </div>
    @endif
    <table class="table study-table">
      <thead>
        <tr>
          <th>カテゴリー</th>
          <th><span>学習</span>内容</th>
          <th><span>学習時間</span>（分）</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($study_records as $study_record)
        <tr>
          @foreach($categories as $category)
            @if($category['id'] == $study_record->category_id)
            <td>{{ $category['title'] }}</td>
            @endif
          @endforeach
          @if($edit_id == $study_record->id)
            <form action="{{ route('study.edit', ['id' => $study_record->id]) }}" method="post">
            @csrf
              <td>
                <input type="text" name="body_edit" value="{{ $study_record->body }}">
              </td>
              <td>
                <input type="number" name="time_edit" value="{{ $study_record->time }}">
              </td>
              <td>
                <button type="submit" class="btn-sm btn-outline-primary">登録</button>
                <a href="/study?year={{$year}}&month={{$month}}&day={{$day}}">取消</a>
              </td>
              <input type="hidden" name="date" value="{{ $study_record->study_date }}">
            </form>  
          @else
            <td>{{ $study_record->body }}</td>
            <td class="study-time">{{ $study_record->time }}</td>
            <td><a href="/study?year={{$year}}&month={{$month}}&day={{$day}}&edit_id={{$study_record->id}}"><i class="fa fa-edit"></i><span class="edit-text">編集</span></a></td>
            @endif
          <form action="{{ route('study.delete', ['id' => $study_record->id]) }}" method="post">
          @csrf
          <td>
            <button type="submit" class="btn-sm btn-outline-primary" onclick='return confirm("本当に削除しますか？")'><i class="fa fa-trash"></i><span class="delete-text">削除</span></button>
          </td>
        </form>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    <div class="col col-xs-12 col-md-4">
      <nav class="card">
        <div class="card-header">学習内容を追加する</div>
        <div class="card-body">
          @if($errors->has('body') || $errors->has('time'))
            <div class="alert alert-danger">
              @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
              @endforeach  
            </div>
          @endif
          <form action="{{ route('study.create') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="category">カテゴリー</label>
              <select id="category" name="category" class="form-control">
              @foreach($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['title'] }}</option>
              @endforeach
              </select>
              <label for="body">学習内容</label>
              <input type="text" class="form-control" name="body" id="body" value="{{ old('body') }}" />
              <label for="time">学習時間（分）</label>
              <input type="number" class="form-control" name="time" id="time" value="{{ old('time') }}" />
              <input type="hidden" name="study_date" value="{{ $year }}-{{ $month }}-{{ $day }}">
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary">送信</button>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </div>
  @else
  <div class="alert alert-danger">
    <p>まずはヘッダーのリンクからカテゴリー作成をしてください</p>
  </div>
  @endif
</div>    
@endsection

