@extends('app')

@section('content')
    <div class="row">
        <div class="text-left">
            <h1>商品情報編集画面</h1>
        </div>
        
    </div>


<div class="create-fc">
       
        
    <form action="{{ route('products.update', $product->id)}}" method="POST">
        @method('PUT')
        @csrf

        <dl class="form-area">

            <!-- idの表示 -->
            <dt>id.</dt>
            <dd class="dd-id">{{ $product->id }}.</dd>
           

            <!-- 商品名の編集 -->
            <dt>商品名<span class="req">*</span></dt>
            <dd>
                <input type="text" name="product_name" placeholder={{ $product->product_name }}></dd>
                @error('product_name')
                <span class="error">商品名を入力してください</span>
                @enderror
    

            <!-- メーカー名の編集 -->
            <dt>メーカー名<span class="req">*</span></dt>
            <dd>
                <select class="select-cn" name="company_id" >
                    
                    @foreach ($companies as $company)
                    <option value="{{ $company->id }}"
                     @if($company->id == old('company_id', $product->company_id)) selected @endif>
                     {{ $company->company_name }}</option>
                    
                    @endforeach
                </select>
            </dd>
                @error('company_id')
                <span class="error">メーカー名を選択してください</span>
                @enderror
            
            <!-- 価格の編集 -->
            <dt>価格<span class="req">*</span></dt>
            <dd>
                <input type="text" name="price" placeholder={{ $product->price }}></dd>
                @error('price')
                <span class="error">価格を入力してください</span>
                @enderror
            
            <!-- 在庫数の編集 -->
            <dt>在庫数<span class="req">*</span></dt>
            <dd>
                <input type="text" name="stock" placeholder={{ $product->stock }}></dd>
                @error('stock')
                <span style="color:red">在庫数を入力してください</span>
                @enderror
            
            <!-- コメントの編集※NULLABLE -->
            <dt>コメント</dt>
            <dd>
                <textarea name="comment" placeholder={{ $product->comment }}></textarea>
            </dd>
            <!-- 画像の編集※NULLABLE -->
            <dt>画像</dt>
                <label> ファイルを選択
                    <dd><input class="file" type="file" name="img_path"></dd>
                </label>


            <div class="create-area">
                <button class="btn-create" type="submit">更新</button>
            </div>

            <div class="a-back">
                <a class="btn-back" href="{{ url('/products') }}">戻る</a>
            </div>
           
        </dl>
    </form>
</div>
@endsection