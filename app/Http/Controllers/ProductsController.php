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
        // $model = new products();
        // $products = $model->getList();
        // $companies = new Company;
        // $allcompany = $companies->getCreate();
        // return view('list', ['products' => $products],['allcompany' => $allcompany]);

        


        $keyword = $request->input('keyword');
        $company_id = $request->input('company_id');
    
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $minStock = $request->input('minStock');
        $maxStock = $request->input('maxStock');

        $model = new products();
        $companies = new Company();
        $products = $model->Search($keyword, $company_id);
        
        $allcompany = $companies->getCreate();
        // dd($keyword);
        
        return view('list', ['products'=> $products], ['allcompany'=> $allcompany],['price'=> $request->minPrice]);
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
        
        // 処理が完了したらregistにリダイレクト
        return redirect()->route('list');
    }



    
    


    //詳細画面
    public function showDetail($id){
        
        $model = new products();
        $products = $model->getDetail($id);

       
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
                    }

                    // dd($request);
                    // トランザクション開始
                    DB::beginTransaction();
                    //インスタンス化
                    $model = new Products();

                    try {
                        // 登録処理呼び出し
                        
                        
                        //if
                        if ($request ->file('image')){
                            $model->updateProduct($update_data, $id);


                        }else{
                            $model->notUpdateProduct($update_data, $id);

                        }

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                        return back();
                    }
                    
                    // 処理が完了したらregistにリダイレクト
                    return redirect()->route('list');
    }


    
    
    public function Search(Request $request){
        // dd($request);
       
        $keyword = $request->input('keyword');
        $company_id = $request->input('company_id');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $minStock = $request->input('minStock');
        $maxStock = $request->input('maxStock');
        $model = new products();
        $companies = new Company();
        $products = $model->Search($keyword, $company_id);
        
        $allcompany = $companies->getCreate();
        // dd($keyword);
        
        return view('list', ['products'=> $products], ['allcompany'=> $allcompany],['price'=> $request->minPrice]);
    } 
    


    




    //削除処理
    public function exeDelete($id)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $product = Products::find($id);
        // レコードを削除
        $product->delete();
        // 指定されたIDのレコードを削除
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('list');
    }



    // public function destroy(Request $request, Users $users) {

    //     //ajaxメソッドから送信されたデータは$requestに格納されます
    //     //ajas側で送信したデータの名前は"id"という名前に設定しているため
    //     //コントローラーで使うには $request->id で出力します
             
    //                 $users = Users::findOrFail($request->id);
    //     //データベースのUsersテーブルから()で指定されたiDのレコードを代入します
    //                 $users->delete();
    //     //usersに代入されているレコード（行）を削除します
        
    //         }
        
}

