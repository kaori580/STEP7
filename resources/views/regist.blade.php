@extends('layouts.listLayout')
@section('title', '商品情報新規登録画面')

@section('content')

<div class="container">
        <div class="row">
            <h3>商品情報新規登録</h3>
            <form class="form-inline" action="{{ route('submit') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                    <div class="form-group">
                        <label for="product_name">
                            <span class="badge badge-danger">必須</span>
                        商品名
                        </label>
                        <input type="text" class="form-control"  name="product_name" placeholder="Product_name" value="{{ old('product_name') }}">
                        @if($errors->has('product_name'))
                            <p>{{ $errors->first('product_name') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="company_id">
                            <span class="badge badge-danger">必須</span>
                        {{ __('メーカー名') }} 
                        </label>
                        <select class="form-control"  name="company_id" placeholder="company_id" value="{{ old('company_id') }}">
                        @foreach ($allcompany as $company)
                        <option hidden value="">選択してください</option>
                        <option value="{{ $company->id }}">{{  $company->company_name }}</option>
                        @endforeach
                        </select>
                        @if($errors->has('company_id'))
                            <p>{{ $errors->first('company_id') }}</p>
                        @endif
                    </div>

                    

                    <div class="form-group">
                        <label for="price">
                            <span class="badge badge-danger">必須</span>
                        価格 
                        </label>
                        <input type="text" class="form-control"  name="price" placeholder="Price" value="{{ old('price') }}">
                        @if($errors->has('price'))
                            <p>{{ $errors->first('price') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="stock">
                            <span class="badge badge-danger">必須</span>
                        在庫数
                        </label>
                        <input type="text" class="form-control"  name="stock" placeholder="Stock" value="{{ old('stock') }}">
                        @if($errors->has('stock'))
                            <p>{{ $errors->first('stock') }}</p>
                        @endif
                    </div>

                    <!-- <form method="POST" action="/upload" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="comment">画像</label>
                    <input type="file" id="file" name="file" class="form-control" />

                    
                    </form> -->


                    <div class="form-group">
                        <label for="image">{{ __('画像') }}
                            <!-- 以下一文必須にするため -->
                            
                        </label>
                        <input type="file" id="file" name="image" class="form-control" >
                    </div>


                    <div class="form-group">
                        <label for="comment">コメント
                             <!-- 以下一文必須にするため -->
                                

                        </label>
                        <textarea class="form-control"  name="comment" placeholder="Comment">{{ old('comment') }}</textarea>
                        


                        <!-- required.blade.phpにifがあるので一旦コメントアウト -->
                        <!-- @if($errors->has('comment'))
                            <p>{{ $errors->first('comment') }}</p>
                        @endif -->
                    </div>
                   
                    <!-- <input type="file" name="image"> -->
                    


                
                
                

                
                    <div class="d-flex justify-content-between pt-3">
                        <a href="{{ route('list') }}" class="btn btn-outline-secondary" role="button">
                            <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('戻る') }}
                        </a>
                        <button type="submit" class="btn btn-success">
                            {{ __('登録') }}
                        </button>
                    </div>


                    
                           
                    
                
            </form>

        </div>
    </div>


    





@endsection