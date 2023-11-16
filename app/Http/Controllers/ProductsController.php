<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Products;
use App\Models\Company;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\DB;


use App\Models\Image;



class ProductsController extends Controller
{
    // 商品情報画面
    public function showList(Request $request) {
        // インスタンス生成
        $model = new products();
        $products = $model->getList();
        $companies = new Company;
        $allcompany = $companies->getCreate();

            //以下画像について
            // ディレクトリ名
            // $dir = 'sample';
            // アップロードされたファイル名を取得
            // $file_name = $request->file('image')->getClientOriginalName();
            // sampleディレクトリに画像を保存
            // $request->file('image')->store('public/' . $dir);
            // return redirect('/');


        return view('list', ['products' => $products],['allcompany' => $allcompany]);
    }
    
    // 商品情報登録画面
    public function regist(Request $regist) {
        
        $companies = new Company();
        $allcompany = $companies->getCreate();

        //必須項目にするため
        $validation = new ProductsRequest();

        return view('regist',['allcompany' => $allcompany],
            // 必須項目にするため
            ['rulus'=> $validation->rules(),]);
        
    }
    
    // 商品情報登録画面送信 
    public function registSubmit(ProductsRequest $request) {
            // ディレクトリ名
        $dir = 'sample';

        $insert_data = [];
        $insert_data['company_id'] = (int)$request->input('company_id');
        $insert_data['product_name'] = $request->input('product_name');
        $insert_data['price'] = (int)$request->input('price');
        $insert_data['stock'] = (int)$request->input('stock');
        $insert_data['comment'] = $request->input('comment');
        

        if ($request ->file('image')){
            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();

            // 取得したファイル名で保存
            $request->file('image')->storeAs('public/' . $dir, $file_name);

            $insert_data['img_path'] = 'storage/' . $dir . '/' . $file_name;
        } else{
            $insert_data['img_path'] = null;
        }

        

       

        
        
        // dd('test');
        // トランザクション開始
        DB::beginTransaction();
        //インスタンス化
        $model = new Products();

        try {
            // 登録処理呼び出し
            
            $model->registProduct($insert_data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        // $registerproducts = $this->products->InsertList($request);
        // dd($products);
        // 処理が完了したらregistにリダイレクト
        return redirect()->route('list');
    }



    
    // public function post(ProductsRequest $request) 
    // {
    //     $rules = [
    //         'products_name' => 'required',
    //         // 'company_id' => ,
    //         'price'=>'numeric',
    //         'stock'=>'numeric' ,
    //         // 'comment' => ,
    //         // 'created_at'=> ,
    //         // 'updated_at' => ,
    //     ];
    //     return view('regist', ['msg'=>'登録完了']);
    // }
    // public function registSubmit(ProductsRequest $request) {
    //     return view ('regist');
    // }

    // public function registSubmit(Request $request)
    // {
    //     $this->validate($request, Products::$rules);
    //     $products = new Products;
    //     $form = $request -> all();
    //     unset($form['_token']);
    //     $products -> fill($form)->save();
    //     return redirect('regist');
    // }


    //詳細画面
    public function showDetail($id){
        
        $model = new products();
        $products = $model->getDetail($id);

        //  if (is_null($products)) {
        //      \Session::flash('err_msg','データがありません');
        //      return redirect (route('list'));
        //  }
        return view ('detail',['products' => $products]);
    }

    // 編集画面
    public function edit($id){
        


        $model = new products();
        $products = $model->getDetail($id);
        $companies = new Company;
        $allcompany = $companies->getCreate();
        return view ('edit',['products' => $products],['allcompany' => $allcompany]);



    }
    


    // public function update($id ,Request $request){
        // // データベースに保存する処理がくる
        // $update_data = [];
        // $update_data['product_name'] = $request->input('product_name');
        // $update_data['company_name'] = $request->input('company_name');
        // $update_data['price'] = $request->input('price');
        // $update_data['stock'] = $request->input('stock');
        // $update_data['comment'] = $request->input('comment');
        // $update_data['comment'] = $request->input('comment');
        // // $insert_data['img_path'] = $path;
        // try {
        //     // 登録処理呼び出し
            
        //     $model->registProduct($update_data);
        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return back();
        // }
        // // dd($products);
        // // 処理が完了したらregistにリダイレクト
        // return redirect(route('update'));

        public function update(ProductsRequest $request,$id){
                   // ディレクトリ名
                    $dir = 'sample';

                   
                    
                    $update_data = [];
                    $update_data['company_id'] = (int)$request->input('company_id');
                    $update_data['product_name'] = $request->input('product_name');
                    $update_data['price'] = (int)$request->input('price');
                    $update_data['stock'] = (int)$request->input('stock');
                    $update_data['comment'] = $request->input('comment');
                   
                    if ($request ->file('image')){
                         // アップロードされたファイル名を取得
                        $file_name = $request->file('image')->getClientOriginalName();
                        // 取得したファイル名で保存
                        $request->file('image')->storeAs('public/' . $dir, $file_name);
                        $update_data['img_path'] = 'storage/' . $dir . '/' . $file_name;
                    }else{
                        $update_data['img_path'] = null;
                    }

                    // dd($request);
                    // トランザクション開始
                    DB::beginTransaction();
                    //インスタンス化
                    $model = new Products();

                    try {
                        // 登録処理呼び出し
                        
                        $model->updateProduct($update_data, $id);

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                        return back();
                    }
                    // $registerproducts = $this->products->InsertList($request);
                    // dd($products);
                    // 処理が完了したらregistにリダイレクト
                    return redirect()->route('list');
    }


    
    // 商品情報画面の検索
    // public function index(Request $request)
    // {

    //      /* テーブルから全てのレコードを取得する */
    //      $products = products::query();


    //     /* キーワードから検索処理 */
    //     $keyword = $request->input('keyword');
    //     if(!empty($keyword)) {//$keyword　が空ではない場合、検索処理を実行します
    //         $products->where('product_name', 'LIKE', "%{$keyword}%")
    //         ->orwhereHas('products', function ($query) use ($keyword) {
    //             $query->where('product_name', 'LIKE', "%{$keyword}%");
    //         })->get();

    //     }

    //     /* ページネーション */
    //     $posts = $products->paginate(5);

    //     return view('list', ['posts' => $posts]);

    // }
    public function Search(Request $request){
        // dd($request);
        $keyword = $request->input('keyword');
        $company_id = $request->input('company_id');
        $model = new Products();
        $companies = new Company();
        $products = $model->Search($keyword, $company_id);
        
        $allcompany = $companies->getCreate();
        // dd($keyword);
        return view('list', ['products'=> $products], ['allcompany'=> $allcompany]);
    } 
    


    




    //削除処理
    public function exeDelete($id)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $product = Products::find($id);
        // レコードを削除
        $product->delete();
        // 指定されたIDのレコードを削除
        // $deleteProduct = $this->products->deleteProductById($id);
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('list');
    }

}

// //詳細画面
// public function showDetail($id){
        
//     $model = new products();
//     $products = $model->getDetail($id);

//     //  if (is_null($products)) {
//     //      \Session::flash('err_msg','データがありません');
//     //      return redirect (route('list'));
//     //  }
//     return view ('detail',['products' => $products]);
// }

// // 編集画面
// public function edit($id){
    


//     $model = new products();
//     $products = $model->getDetail($id);
//     $companies = new Company;
//     $allcompany = $companies->getCreate();
//     return view ('edit',['products' => $products],['allcompany' => $allcompany]);



// }