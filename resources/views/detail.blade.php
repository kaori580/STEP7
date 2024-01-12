@extends('layouts.listlayout')

@section('title', '商品詳細画面')

@section('content')
<h3>商品確認</h3>
<table class="table table-striped">
    <thead>
        <tr>
        <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th>コメント</th>
                <th></th>
        </tr>
    </thead>
    <tbody>
   
        <tr>
        <td>{{ $products->id }}</td>
                <td>
                <img src="{{ asset($products->img_path) }}">
                </td>
                <td>{{ $products->product_name }}</td>
                <td>{{ $products->price }}</td>
                <td>{{ $products->stock }}</td>
                <td>{{ $products->company_name }}</td>
                <td>{{ $products->comment }}</td>
                <td><a href="{{ route('edit', $products->id) }}" class="btn btn-primary btm-sm">編集画面</a></td>
                <td></td>    
        </tr>
     
    </tbody>
</table>
    <!-- 戻るボタン -->
    <div class="detailback">
        <input class="btn btn-primary" type="button" onclick="history.back(-1)" value="戻る">
    </div>
</body>
@endsection