<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;

use App\Models\Product_special;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * @group Product
 */
class ProductController extends Controller
{
    /**
     * Display a listing of products.
     *
     * @return Response
     */
    public function index()
    {
        return Cache::remember('products', 5, function()
        {
            return Product::all();
        });
    }

    /**
     * Store a newly created product.
     *
     * @bodyParam category_id integer required
     * @bodyParam category_id2 integer required
     * @bodyParam model string required
     * @bodyParam sku string required
     * @bodyParam location string
     * @bodyParam quantity integer
     * @bodyParam internal_quantity integer
     * @bodyParam stock_status_id integer required
     * @bodyParam image string required
     * @bodyParam manufacturer_id integer required
     * @bodyParam shipping integer
     * @bodyParam price float
     * @bodyParam tax_class_id integer required
     * @bodyParam date_available date required
     * @bodyParam weight float
     * @bodyParam weight_class_id integer
     * @bodyParam length float
     * @bodyParam width float
     * @bodyParam height float
     * @bodyParam measurement_class_id integer
     * @bodyParam status integer
     * @bodyParam viewed integer
     * @bodyParam container_capacity integer required
     * @bodyParam req_container integer
     * @bodyParam purchase_price float
     * @bodyParam viewed_month integer
     * @bodyParam viewed_quartal integer
     * @bodyParam viewed_year integer
     * @bodyParam heureka string
     * @bodyParam heureka_cat string
     * @bodyParam heureka_name string
     * @bodyParam warranty integer
     * @bodyParam sold_quartal integer required
     * @bodyParam conversion_quartal float required
     * @bodyParam free_shipping integer
     * @bodyParam domains string required
     * @bodyParam color1 string required
     * @bodyParam color2 string required
     * @bodyParam color3 string required
     * @bodyParam marketing_domain string required
     * @bodyParam raw_name string required
     * @bodyParam zasilkovna_enabled integer
     * @bodyParam condition integer
     * @bodyParam erotic integer
     * @bodyParam language string required
     * @bodyParam name string required required
     * @bodyParam meta_description string required
     * @bodyParam meta_keywords string required
     * @bodyParam description string required
     * @bodyParam intro string required
     * @response  {"product_id":3332}
     *
     * @param Request $request
     * @return Response
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('modify', Product::class);
        $id = Product::insertGetId([
            'category_id' => $request->input('category_id'),
            'category_id2' => $request->input('category_id2'),
            'model' => $request->input('model'),
            'sku' => $request->input('sku'),
            'location' => $request->input('location',''),
            'quantity' => $request->input('quantity',0),
            'internal_quantity' => $request->input('internal_quantity',0),
            'stock_status_id' => $request->input('stock_status_id'),
            'image' => $request->input('image'),
            'manufacturer_id' => $request->input('manufacturer_id'),
            'shipping' => $request->input('shipping',1),
            'price' => $request->input('price',0.0000),
            'tax_class_id' => $request->input('tax_class_id'),
            'date_available' => $request->input('date_available'),
            'weight' => $request->input('weight',0.00),
            'weight_class_id' => $request->input('weight_class_id',0),
            'length' => $request->input('length',0.00),
            'width' => $request->input('width',0.00),
            'height' => $request->input('height',0.00),
            'measurement_class_id' => $request->input('measurement_class_id',0),
            'status' => $request->input('status',0),
            'date_added' => date("Y-m-d H:i:s"),
            'viewed' => $request->input('viewed',0),
            'container_capacity' => $request->input('container_capacity'),
            'req_container' => $request->input('req_container',0),
            'purchase_price' => $request->input('purchase_price',0.0000),
            'viewed_month' => $request->input('viewed_month',0),
            'viewed_quartal' => $request->input('viewed_quartal',0),
            'viewed_year' => $request->input('viewed_year',0),
            'heureka' => $request->input('heureka',''),
            'heureka_cat' => $request->input('heureka_cat',''),
            'heureka_name' => $request->input('heureka_name',''),
            'warranty' => $request->input('warranty',24),
            'sold_quartal' => $request->input('sold_quartal'),
            'conversion_quartal' => $request->input('conversion_quartal'),
            'free_shipping' => $request->input('free_shipping',0),
            'domains' => $request->input('domains'),
            'color1' => $request->input('color1'),
            'color2' => $request->input('color2'),
            'color3' => $request->input('color3'),
            'marketing_domain' => $request->input('marketing_domain'),
            'raw_name' => $request->input('raw_name'),
            'zasilkovna_enabled' => $request->input('zasilkovna_enabled',1),
            'condition' => $request->input('condition',1),
            'erotic' => $request->input('erotic',0)
        ]);
        $language_id = DB::table('oc_language')
            ->where('name',$request->input('language'))
            ->value('language_id');

        DB::table('oc_product_description')->insert([
            'product_id' => $id,
            'language_id' => $language_id,
            'name' => $request->input('name'),
            'meta_description' => $request->input('meta_description'),
            'meta_keywords' => $request->input('meta_keywords'),
            'description' => $request->input('description'),
            'intro' => $request->input('intro')
        ]);

        return response()->json(['product_id' => $id]);
    }

    /**
     * Display the specified product.
     * @urlParam product required product id Example: 2408
     *
     * @param  Product  $product
     * @return Response
     */
    public function show(Product $product)
    {
        return Cache::remember('product'.$product->product_id, 5, function() use($product)
        {
            return $product;
        });
    }

    /**
     * Update the specified product in storage.
     * @urlParam product required product id
     * @bodyParam category_id integer
     * @bodyParam category_id2 integer
     * @bodyParam model string
     * @bodyParam sku integer
     * @bodyParam location string
     * @bodyParam quantity integer
     * @bodyParam internal_quantity integer
     * @bodyParam stock_status_id integer
     * @bodyParam image string
     * @bodyParam manufacturer_id integer
     * @bodyParam shipping integer
     * @bodyParam price float
     * @bodyParam tax_class_id integer
     * @bodyParam date_available date
     * @bodyParam weight float
     * @bodyParam weight_class_id integer
     * @bodyParam length float
     * @bodyParam width float
     * @bodyParam height float
     * @bodyParam measurement_class_id integer
     * @bodyParam status integer
     * @bodyParam viewed integer
     * @bodyParam container_capacity integer
     * @bodyParam req_capacity integer
     * @bodyParam req_container integer
     * @bodyParam purchase_price float
     * @bodyParam viewed_month integer
     * @bodyParam viewed_quartal integer
     * @bodyParam viewed_year integer
     * @bodyParam heureka integer
     * @bodyParam heureka_cat integer
     * @bodyParam heureka_name integer
     * @bodyParam warranty integer
     * @bodyParam sold_quartal integer
     * @bodyParam conversion_quartal
     * @bodyParam free_shipping integer
     * @bodyParam domains string
     * @bodyParam color1 string
     * @bodyParam color2 string
     * @bodyParam color3 string
     * @bodyParam marketing_damain string
     * @bodyParam raw_name string
     * @bodyParam zasilkovna_enabled integer
     * @bodyParam condition integer
     * @bodyParam erotic integer
     * @response {
     * "location":true,
     * "shipping":true
     * }
     *
     * @param Request $request
     * @param Product $product
     * @return Response
     * @throws AuthorizationException
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('modify', Product::class);
        $ret_array = [];
        if ($request->has('category_id')) {
            $ret_array += array('category_id' => $product->update([
                'category_id' => $request->input('category_id')
            ]));
        }
        if ($request->has('category_id2')) {
            $ret_array += array('category_id2' => $product->update([
                'category_id2' => $request->input('category_id2')
            ]));
        }
        if ($request->has('model')) {
            $ret_array += array('model' => $product->update([
                'model' => $request->input('model')
            ]));
        }
        if ($request->has('sku')) {
            $ret_array += array('sku' => $product->update([
                'sku' => $request->input('sku')
            ]));
        }
        if ($request->has('location')) {
            $ret_array += array('location' => $product->update([
                'location' => $request->input('location')
            ]));
        }
        if ($request->has('quantity')) {
            $ret_array += array('quantity' => $product->update([
                'quantity' => $request->input('quantity')
            ]));
        }
        if ($request->has('internal_quantity')) {
            $ret_array += array('internal_quantity' => $product->update([
                'internal_quantity' => $request->input('internal_quantity')
            ]));
        }
        if ($request->has('stock_status_id')) {
            $ret_array += array('stock_status_id' => $product->update([
                'stock_status_id' => $request->input('stock_status_id')
            ]));
        }
        if ($request->has('image')) {
            $ret_array += array('image' => $product->update([
                'iimage' => $request->input('image')
            ]));
        }
        if ($request->has('manufacturer_id')) {
            $ret_array += array('manufacturer_id' => $product->update([
                'manufacturer_id' => $request->input('manufacturer_id')
            ]));
        }
        if ($request->has('shipping')) {
            $ret_array += array('shipping' => $product->update([
                'shipping' => $request->input('shipping')
            ]));
        }
        if ($request->has('price')) {
            $ret_array += array('price' => $product->update([
                'price' => $request->input('price')
            ]));
        }
        if ($request->has('tax_class_id')) {
            $ret_array += array('tax_class_id' => $product->update([
                'tax_class_id' => $request->input('tax_class_id')
            ]));
        }
        if ($request->has('date_available')) {
            $ret_array += array('date_available' => $product->update([
                'date_available' => $request->input('date_available')
            ]));
        }
        if ($request->has('weight')) {
            $ret_array += array('weight' => $product->update([
                'weight' => $request->input('weight')
            ]));
        }
        if ($request->has('weight_class_id')) {
            $ret_array += array('weight_class_id' => $product->update([
                'weight_class_id' => $request->input('weight_class_id')
            ]));
        }
        if ($request->has('length')) {
            $ret_array += array('length' => $product->update([
                'length' => $request->input('length')
            ]));
        }
        if ($request->has('width')) {
            $ret_array += array('width' => $product->update([
                'width' => $request->input('width')
            ]));
        }
        if ($request->has('height')) {
            $ret_array += array('height' => $product->update([
                'height' => $request->input('height')
            ]));
        }
        if ($request->has('measurement_class_id')) {
            $ret_array += array('measurement_class_id' => $product->update([
                'measurement_class_id' => $request->input('measurement_class_id')
            ]));
        }
        if ($request->has('status')) {
            $ret_array += array('status' => $product->update([
                'status' => $request->input('status')
            ]));
        }
        if ($request->has('viewed')) {
            $ret_array += array('viewed' => $product->update([
                'viewed' => $request->input('viewed')
            ]));
        }
        if ($request->has('container_capacity')) {
            $ret_array += array('container_capacity' => $product->update([
                'container_capacity' => $request->input('container_capacity')
            ]));
        }
        if ($request->has('req_container')) {
            $ret_array += array('req_container' => $product->update([
                'req_container' => $request->input('req_container')
            ]));
        }
        if ($request->has('purchase_price')) {
            $ret_array += array('purchase_price' => $product->update([
                'purchase_price' => $request->input('purchase_price')
            ]));
        }
        if ($request->has('viewed_month')) {
            $ret_array += array('viewed_month' => $product->update([
                'viewed_month' => $request->input('viewed_month')
            ]));
        }
        if ($request->has('viewed_quartal')) {
            $ret_array += array('viewed_quartal' => $product->update([
                'viewed_quartal' => $request->input('viewed_quartal')
            ]));
        }
        if ($request->has('viewed_year')) {
            $ret_array += array('viewed_year' => $product->update([
                'viewed_year' => $request->input('viewed_year')
            ]));
        }
        if ($request->has('heureka')) {
            $ret_array += array('heureka' => $product->update([
                'heureka' => $request->input('heureka')
            ]));
        }
        if ($request->has('heureka_cat')) {
            $ret_array += array('heureka_cat' => $product->update([
                'heureka_cat' => $request->input('heureka_cat')
            ]));
        }
        if ($request->has('heureka_name')) {
            $ret_array += array('heureka_name' => $product->update([
                'heureka_name' => $request->input('heureka_name')
            ]));
        }
        if ($request->has('warranty')) {
            $ret_array += array('warranty' => $product->update([
                'warranty' => $request->input('warranty')
            ]));
        }
        if ($request->has('sold_quartal')) {
            $ret_array += array('sold_quartal' => $product->update([
                'sold_quartal' => $request->input('sold_quartal')
            ]));
        }
        if ($request->has('conversion_quartal')) {
            $ret_array += array('conversion_quartal' => $product->update([
                'conversion_quartal' => $request->input('conversion_quartal')
            ]));
        }
        if ($request->has('free_shipping')) {
            $ret_array += array('free_shipping' => $product->update([
                'free_shipping' => $request->input('free_shipping')
            ]));
        }
        if ($request->has('domains')) {
            $ret_array += array('domains' => $product->update([
                'domains' => $request->input('domains')
            ]));
        }
        if ($request->has('color1')) {
            $ret_array += array('color1' => $product->update([
                'color1' => $request->input('color1')
            ]));
        }
        if ($request->has('color2')) {
            $ret_array += array('color2' => $product->update([
                'color2' => $request->input('color2')
            ]));
        }
        if ($request->has('color1')) {
            $ret_array += array('color1' => $product->update([
                'color1' => $request->input('color1')
            ]));
        }
        if ($request->has('color1')) {
            $ret_array += array('color1' => $product->update([
                'color1' => $request->input('color1')
            ]));
        }
        if ($request->has('color3')) {
            $ret_array += array('color3' => $product->update([
                'color3' => $request->input('color3')
            ]));
        }
        if ($request->has('marketing_domain')) {
            $ret_array += array('marketing_domain' => $product->update([
                'marketing_domain' => $request->input('marketing_domain')
            ]));
        }
        if ($request->has('raw_name')) {
            $ret_array += array('raw_name' => $product->update([
                'raw_name' => $request->input('raw_name')
            ]));
        }
        if ($request->has('zasilkovna_enabled')) {
            $ret_array += array('zasilkovna_enabled' => $product->update([
                'zasilkovna_enabled' => $request->input('zasilkovna_enabled')
            ]));
        }
        if ($request->has('condition')) {
            $ret_array += array('condition' => $product->update([
                'condition' => $request->input('condition')
            ]));
        }
        if ($request->has('erotic')) {
            $ret_array += array('erotic' => $product->update([
                'erotic' => $request->input('erotic')
            ]));
        }
        return response()->json($ret_array);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param Product $product
     * @return Response
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        $this->authorize('modify', Product::class);
        Product_special::where('product_id', $product->product_id)->delete();
        DB::table('oc_product_gift')->where('product_id', $product->product_id)->delete();
        return response()->json($product->delete());
    }
}
