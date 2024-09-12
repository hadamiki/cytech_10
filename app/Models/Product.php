<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    public function company(){
        return $this->belongsTo(Company::class);
    }    

    public function product(){
    $products = Product::select([
        'p.id',
        'p.img_path',
        'p.product_name',
        'p.price',
        'p.stock',
        'c.company_name as company_id',
    ])
    ->from('products as p')
    ->join('companies as c', function($join) {
        $join->on('p.company_id', '=', 'c.id');
    })
    ->orderBy('p.id', 'DESC')
    ->paginate(5);

        return $products;
    }

}
