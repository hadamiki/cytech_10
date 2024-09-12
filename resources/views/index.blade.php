@extends('app')

@section('content')
<div class="main-container">
    <div class="headder">
        <div class="text-left">
            <h1>商品画面一覧</h1>
        </div>
    </div>

    <!-- 削除の為のアラート -->
    <!-- <div class="message-alert">
        @if($message = Session::get('success'))
        <div class="alert alert-success mt-1">
            <p>{{ $message }}</p>
        </div>
        @endif
    </div> -->

    <!-- 検索機能 -->
    <div class="search-container">
        <form class="search-form" action="products.searchInput" method="GET">
            <!-- キーワード検索 -->
            
            <input type="text" class="search-kw" name="search" value="{{ request('search')}}" placeholder="検索キーワード">
            
            <!-- メーカー名の選択 -->
            
                <select name="company_id" class="search-ci">
                <option>メーカー名</option>
                
                @foreach ($companies as $company)
                    <option value="{{ $company->id}}">{{ $company->company_name}}</option>
                @endforeach 
                </select>   
            
            
            <input type="submit" value="検索" class="search-bt">
            
        </form>
    </div>
    
    <!-- 登録商品一覧 -->
    <table class="table-product">
        <tr class="tr-head">
            <th class="th-id">ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th class="th-cr">
                <a class="btn-new" href="{{ route('products.create')}}">新規登録</a>
            </th>
                    
        </tr>
        @foreach ($products as $product)
        <tr>
            <td class="td-id">{{ $product->id }}.</td>
            <td>
                @if ($product->img_path == null)
                        <p>No Image</p>
                        @else
                        <img src="{{ asset('storage/'.$product->img_path) }}"  alt="Image">
                @endif
                
            </td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}円</td>
            <td>{{ $product->stock }}個</td>
            <td>{{ $product->company_id }}</td>
            <td><a class="btn-detail" href="{{ route('products.show', $product->id) }}?page_id={{ $page_id}}">詳細</a></td>
            <td>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- 削除実行時のアラート表示 -->
                    <button type="submit" class="btn-dan" onclick='return confirm("削除しますか？")'>削除</button>
                </form>
            </td>
        </tr>
        
        @endforeach
    </table>
        <div class="boot-pagi">
           {{ $products->links() }}
        </div>
</div>

<!-- 画像表示テスト
<img src="{{ asset('/storage/R.png')}}" alt="">
<p>{{ asset('/storage/R.png') }}</p> -->




    
@endsection