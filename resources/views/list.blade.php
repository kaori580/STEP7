@extends('layouts.listLayout')
@section('title', '商品情報画面')

@section('scripts')
     
@endsection

@section('content')

<!--検索フォーム-->
<form class="form-inline" action="{{ route('search') }}" method="POST">
@csrf
    <div class="form-search">
    <label for="company_id">{{ __('メーカー名') }} <span class="badge badge-danger ml-2"></span></label>
        <select class="form-control" id="company_id" name="company_id">
            @foreach ($allcompany as $company)
                <option hidden value="">選択してください</option>
                <option value="{{ $company->id }}">{{  $company->company_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="search">
        <p>商品名検索</p>
        <div>
            <div class="post-search-form col-md-6">
                
                    
                    <div class="form-group">
                        <input type="key" id="keyword" name="keyword" class="form-control" placeholder="キーワードを入力">
                    </div>
                    <div class="good1">
                        <input type="submit" value="検索" class="btn btn-info" id="search-btn">

                    </div>
                
            </div>
        </div>

    </div>

        <div>
          <input type="number" name="minPrice" id="minPrice" placeholder="最低価格">
          <input type="number" name="maxPrice" id="maxPrice" placeholder="最高価格">
        </div>
        <div>
          <input type="number" name="minStock" id="minStock" placeholder="最低在庫数">
          <input type="number" name="maxStock" id="maxStock" placeholder="最高在庫数">
        </div>
</form>
<!-- 新規フォーム -->
<form class="form-inline" action="{{ route('regist') }}" method="get">
    <div class="regist">
        <input type="submit" value="新規登録" class="btn btn-info">
    </div>
</form>

<!-- データ -->
<div class="links" id="step7table">
    <table class="table table-hover" id = "fav-table">
    
        <thead>
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                <img src="{{ asset($product->img_path) }}">
                </td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->company_name }}</td>

                <!-- 詳細ボタン -->
                <td><a href="{{ route('detail', $product->id) }}" class="btn btn-primary btn-sm">詳細</a></td>

                <!-- 削除ボタン -->
                <td>
                    <form method="POST" action="{{ route('delete', $product->id) }}" onsubmit="return checkDelete()">
                    @csrf
                        <input data-user_id="{{$product->id}}" type="submit" class="btn btn-danger btn-dell" value="削除">
                    </form> 
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
    
@endsection

<!-- JavaScriptバリテーション -->
<script>
    function checkDelete(){
        if(window.confirm('削除してよろしいでしょうか？')){
            return true;
        } else {
            return false;
        }
    }
</script>







