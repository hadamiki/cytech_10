@extends('app')

@section('content')
    <div class="row">
        <div class="text-left">
            <h1>商品情報詳細画面</h1>
        </div>
        
    </div>


        <div class="form-area">
            <!-- ID番号の表示 -->
              <!-- idの表示 -->
            <dt>id.</dt>
            <dd class="dd-id">{{ $product->id}}</dd>

            <!-- 画像ファイルの表示 -->
            <dt>画像</dt>
            <dd class="img-show">
                @if ($product->img_path == null)
                    <p> No Image</p>
                    @else
                    <img src="{{ asset('storage/'.$product->img_path) }}"  alt="Image">
    
                
                @endif
            
            </dd>

            <!-- 商品名の表示 -->
            <dt>商品名</dt>
            <dd>
                {{ $product->product_name}}
            </dd>
            <!-- メーカー名の表示 -->
            <dt>メーカー名</dt>
            <dd>
                @foreach ($companies as $company)
                    @if($company->id==$product->company_id) {{ $company->company_name}} @endif
                @endforeach
               
            </dd>
            <!-- 価格の表示 -->
            <dt>価格</dt>
            <dd>
                ￥{{$product->price}}
            </dd>
            <!-- 在庫数の表示 -->
            <dt>在庫数</dt>
            <dd>
                {{$product->stock}}
            </dd>
            <!-- コメントの表示 -->
            <dt>コメント</dt>
            <dd class="comment-show">
                {{$product->comment}}
            </dd>
            

            <div class="create-area">
                <a class="a-edit" href="{{ route('products.edit',$product->id) }}">編集</a>
            </div>
            
            <div class="a-back">
                <a class="btn-back" href="{{ url('/products') }}?page={{ $page_id }}">戻る</a>
            </div>
           
        </div>



    
@endsection