@extends('app')

@section('content')
    <div class="row">
        <div class="text-left">
            <h1>商品新規登録画面</h1>
        </div>
        
    </div>

    <!-- 新規登録のフォーム※画像登録の為の記述込み -->
    <div class="create-fc">
        <form action="{{ route('products.store')}}" method="POST" enctype='multipart/form-data'>
            @csrf
            <dl class="form-area">
        
        
            <!-- 商品名の新規登録 -->
            <dt>商品名<span class="req">*</span></dt>
                <dd><input type="text" name="product_name"></dd>
                @error('product_name')
                <span class="error">商品名を入力してください</span>
                @enderror
            
            <!-- メーカー名の新規登録     -->
            <dt>メーカー名<span class="req">*</span></dt>
                <dd>
                    <select class="select-cn" name="company_id" >
                        <option></option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{$company->company_name}}</option>
                        @endforeach
                    </select>
                </dd>    
                @error('company_id')
                <span class="error">メーカー名を選択してください</span>
                @enderror
            
            <!-- 価格の新規登録 -->
            <dt>価格<span class="req">*</span></dt>
                <dd><input type="text" name="price"></dd>
                @error('price')
                <span class="error">価格を入力してください</span>
                @enderror

            <!-- 在庫数の新規登録 -->
            <dt>在庫数<span class="req">*</span></dt>
                <dd><input type="text" name="stock"></dd>
                @error('stock')
                <span class="error">在庫数を入力してください</span>
                @enderror
            
            <!-- コメントの新規登録 NULLABLE-->
            <dt>コメント</dt>
                <dd><textarea class="textarea-cm" name="comment"></textarea></dd>
            
            <!-- 画像ファイルの新規登録 NULLABLE -->
            <dt>画像</dt>
                <label> ファイルを選択
                    <dd><input class="file" type="file" name="img_path"></dd>
                </label>
            
    
            <div class="create-area">
                <button class="btn-create" type="submit">新規登録</button>
            </div>
            <div class="a-back">
                <a class="btn-back" href="{{ url('/products') }}">戻る</a>
            </div>
            </dl> 
    
        </form>
    </div>

@endsection