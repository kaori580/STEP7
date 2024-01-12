<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Products;
use App\Models\Sale;   // 追加



class SalesController extends Controller
{
    public function index()
    {
       try {
            $version = Sale::first();
            $result = [
                'result'      => true,
                'version'     => $version->version,
                'min_version' => $version->min_version
            ];
        } catch(\Exception $e){
            $result = [
                'result' => false,
                'error' => [
                    'messages' => [$e->getMessage()]
                ],
            ];
            return $this->resConversionJson($result, $e->getCode());
        }
        return $this->resConversionJson($result);
    }

    private function resConversionJson($result, $statusCode=200)
    {
        if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }

    public function purchase(Request $request) {

        try{
            DB::beginTransaction();
            
        
            //リクエストから商品IDを取得
            $productId = $request->input('product_id');
            
            // dd($request);
            $product = Products::find($productId); //リクエストから商品IDを取得
            
            if(!$product) {
                DB::rollBack();
                return response()->json(['error' => '商品が存在しません']);
            }
            
            if($product->stock <= 0) {
                DB::rollBack();
                return response()->json(['error' => '在庫が不足しています']);
            }
            
            //Productsテーブルの在庫数を減らす
            $product->stock -= 1;
            $product->save();
            $sale = new Sale();
            $sale->product_id = $product->id;
            
            $sale->save();
            //モデルの減算処理を呼び出す
            // $sale = new Sale();
            // $result = $sale->dec();
        
            // return $result;
      
            DB::commit();
            return ['success' => true];
            
            
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => '購入処理に失敗しました'];
        }

        //return response()->json(['error' => '青い']);

       
    }
}




