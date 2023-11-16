<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class products extends Model
{
    use HasFactory;
    // public function getList() {
    //     // productsテーブルからデータを取得
    //     $products = DB::table('products')->get();

    //     return $products;
    // }

    // カラムのホワイトリストの指定
        // モデルに関連付けるテーブル
        protected $table = 'products';

        // テーブルに関連付ける主キー
        protected $primaryKey = 'id';

        // 登録・更新可能なカラムの指定
        protected $fillable = [
            'product_name',
            'company_id',
            'price',
            'stock',
            'comment',
            'created_at',
            'updated_at'
        ];
        /**
             * 一覧画面表示用にbooksテーブルから全てのデータを取得
             */
            public function findAllProducts()
            {
                return products::all();
            }

            public function InsertProduct($request)
            {
                // リクエストデータを基に管理マスターユーザーに登録する
                return $this->create([
                    'product_name'             => $request->product_name,
                    'company_id'                => $request->company_id,
                    'price'                     => $request->price,
                    'stock'                     => $request->stock,
                    'comment'                   => $request->comment,
                   
                ]);
            }

        

    
    // 商品情報新規登録画面送信


        public function registProduct($data) {
            // dd($data);
            // 登録処理
            DB::table('products')->insert([
                'product_name' => $data['product_name'],
                'company_id' =>$data['company_id'],
                'price'=>$data['price'],
                'stock'=>$data['stock'],
                'img_path'=>$data['img_path'],
                'comment' => $data['comment'],
                'created_at'=> now(),
                'updated_at' => now(),
            ]);
        }

   

        // public function registProduct($data) {
            
        //     // 登録処理
        //     DB::table($this->table)->insert([
        //         'product_name' => $data->product_name,
        //         'company_id' =>$data->company_id,
        //         'price'=>$data->price,
        //         'stock'=>$data->stock,
        //         // 'img_path'=>$data->file,
        //         'comment' => $data->comment,
        //         'created_at'=> now(),
        //         'updated_at' => now(),
        //     ]);
            
           
        // }


    
    // protected $guarded = array ('id');
    // public static $rules = array(
    //     'products_name' => 'required',
    //         // 'company_id' => ,
    //         'price'=>'integer',
    //         'stock'=>'integer' ,
    //         // 'comment' => ,
    //         // 'created_at'=> ,
    //         // 'updated_at' => ,
    //     // 'products_name' => $data->products_name,
    //     //     'company_id' =>$data->company_id,
    //     //     'price'=>$data->price,
    //     //     'stock'=>$data->stock,
    //     //     // 'img_path'=>$data->file,
    //     //     'comment' => $data->comment,
    //     //     'created_at'=> now(),
    //     //     'updated_at' => now(),
    // );
    // public function getDate()
    // {
    //     return $this -> products_name.':'. $this -> company_id.':'. $this -> price.':'. $this -> stock.':'. $this -> comment.':'. $this -> created_at.'('. $this -> updated_at.')';
    // }


    // 商品一覧画面の検索機能
    public function Search($keyword, $company_id)
    {
         $products =  DB::table('products')
         ->join('companies', 'company_id', '=', 'companies.id')
         ->select('products.*', 'companies.company_name');
         if($keyword){
            $products->where('products.product_name', 'like', '%'.$keyword.'%');
         }
         if($company_id){
            $products->where('products.company_id', '=', $company_id);
         }
         $products=$products->get();

         return $products;
    }


  
    //商品一覧画面表示
    public function getList() {
        $products = DB::table('products')
        ->join('companies', 'company_id', '=', 'companies.id')
        ->select('products.*', 'companies.company_name')
        ->get();
        
        return $products;
    }

    //詳細画面表示
    public function getDetail($id) {
        //Product テーブルからデータを取得
        $products = DB::table('products')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->where('products.id', '=', $id)
            ->first();

        return $products;
    }

     //商品編集画面送信
     public function updateProduct($data, $id) {
        // dd($data);
        // 登録処理
        DB::table('products')
        ->where('products.id', '=', $id)
        ->update([
            'product_name' => $data['product_name'],
            'company_id' =>$data['company_id'],
            'price'=>$data['price'],
            'stock'=>$data['stock'],
            'img_path'=>$data['img_path'],
            'comment' => $data['comment'],
            
            'updated_at' => now(),
        ]);
        

        // $result = $data->fill([
        //     'product_name' => $data->book_name
        // ])->save();

        // return $result;
    }



    //リクエストされたIDをもとにbooksデーブルのレコードを1件取得
    public function findProductById($id)
    {
        return products::find($id);
    }
    //削除処理
    public function deleteProductById($id)
    {
        return $this->destroy($id);
    }
}

