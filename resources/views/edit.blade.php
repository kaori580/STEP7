@extends('layouts.listlayout')

@section('title', '編集画面')

@section('content')




<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h3>商品編集画面</h3>
        <form class="form-inline" action="{{ route('update' , $products->id) }}" method="post" enctype="multipart/form-data">
       
        @csrf
        <fieldset>
        <div class="form-group">
            <label for="product_name">
                <span class="badge badge-danger">必須</span>
            {{ __('商品名') }}
            </label>
            <input type="text" class="form-control" name="product_name" id="product_name" value="{{$products->product_name}}">
        </div>  
       

        <div class="form-group">
                        <label for="company_id">
                            <span class="badge badge-danger">必須</span>
                        {{ __('メーカー名') }} 
                        </label>
                        <select class="form-control"  name="company_id" placeholder="" value="">
                        @foreach ($allcompany as $company)
                        
                        <!-- <option hidden>選択してください</option> -->
                        <option value="{{ $company->id }}" {{ old ('company',$products->company_id ?? '') == $company->id ? 'selected' : '' }}>
                            {{  $company->company_name }}</option>
                        <!-- <option value="{{ $company->id }}">{{  $company->company_name }}</option> -->
                        @endforeach
                        </select>
                        @if($errors->has('company_id'))
                            <p>{{ $errors->first('company_id') }}</p>
                        @endif
                    </div>

        <div class="form-group">
            <label for="price">
                <span class="badge badge-danger">必須</span>
            {{ __('価格') }}
            </label>
            <input type="text" class="form-control" name="price" id="price" value="{{$products->price}}">
            @if($errors->has('price'))
                <p>{{ $errors->first('price') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="stock">
                <span class="badge badge-danger">必須</span>
            {{ __('在庫数') }}
            </label>
            <input type="text" class="form-control" name="stock" id="stock" value="{{$products->stock}}">
            @if($errors->has('stock'))
                <p>{{ $errors->first('stock') }}</p>
            @endif
        </div>
       
        <div class="form-group">
            <label for="image">{{ __('画像') }}</label>
            <input type="file" id="file" name="image" class="form-control" >
        </div>

        


        <div class="form-group">
        <label for="comment">{{ __('コメント') }}</label>
            <textarea class="form-control" id="comment" name="comment" placeholder="Comment">{{ $products->comment }}</textarea>
            
        </div>




        <div class="d-flex justify-content-between pt-3">
            <a href="{{ route('list') }}" class="btn btn-outline-secondary" role="button">
                <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('戻る') }}
            </a>
            <button type="submit" class="btn btn-success">
                {{ __('登録') }}
            </button>
        </div>
    </fieldset>

        </form>
        
    </div>
</div>




<!-- 戻るボタン
<div class="detailback">
        <input class="btn btn-primary" type="button" onclick="history.back(-1)" value="戻る">
</div> -->


@endsection