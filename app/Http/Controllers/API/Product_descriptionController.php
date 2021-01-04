<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * @group Product_description
 */
class Product_descriptionController extends Controller
{
    /**
     * Display a listing of all product descriptions.
     * @response  {[
     * "product_id":1,
     * "language_id":5,
     * "name":"Holící strojek F3790 Dual Flex Foil Shaver",
     * "meta_description":"Planžetový holící strojek Remington F3790 Dual Flex Foil Shaver",
     * "meta_keywords":"planžetový, holící strojek, Remington, Remington F3790, pánské strojky, holení, planžety",
     * "description":"&lt;h2&gt;
     * Remington F 3790 Dual Flex Foil Shaver&lt;/h2&gt;
     * &lt;ul&gt;
     * &lt;li&gt;
     * 2 přizpůsobiv&amp;eacute; planžety pro hladk&amp;eacute; oholen&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * Nab&amp;iacute;jec&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * 16 hodin do pln&amp;eacute;ho nabit&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * Až 40 minut provozu&lt;/li&gt;
     * &lt;li&gt;
     * V&amp;yacute;suvn&amp;yacute; detailn&amp;iacute; zastřihovač&lt;/li&gt;
     * &lt;li&gt;
     * Kontrolka nab&amp;iacute;jen&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * 2 roky z&amp;aacute;ruka&lt;/li&gt;
     * &lt;li&gt;
     * barva čern&amp;aacute;&lt;/li&gt;
     * &lt;li&gt;
     * Typ hol&amp;iacute;c&amp;iacute;ho strojku: planžetov&amp;yacute;&lt;/li&gt;
     * &lt;li&gt;
     * Zdroj energie: akumul&amp;aacute;torov&amp;yacute;&lt;/li&gt;
     * &lt;li&gt;
     * rozměry balen&amp;iacute; V x &amp;Scaron; x H (mm): 235 x 161 x 92&lt;/li&gt;
     * &lt;li&gt;
     * hmotnost balen&amp;eacute;ho v&amp;yacute;robku (g) 615&lt;/li&gt;
     * &lt;/ul&gt;
     * ",
     * "intro":"
     * &lt;p&gt;
     * &amp;nbsp;&lt;/p&gt;
     * &lt;ul&gt;
     * &lt;li&gt;
     * 2 přizpůsobiv&amp;eacute; planžety pro hladk&amp;eacute; oholen&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * Nab&amp;iacute;jec&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * 16 hodin do pln&amp;eacute;ho nabit&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * Až 40 minut provozu&lt;/li&gt;
     * &lt;li&gt;
     * V&amp;yacute;suvn&amp;yacute; detailn&amp;iacute; zastřihovač&lt;/li&gt;
     * &lt;li&gt;
     * Kontrolka nab&amp;iacute;jen&amp;iacute;&lt;/li&gt;
     * &lt;/ul&gt;
     * &lt;p&gt;
     * &amp;nbsp;&lt;/p&gt;
     * &lt;ul&gt;
     * &lt;/ul&gt;
     * ",
     * ]}
     *
     * @param $product_id
     * @return \Illuminate\Support\Collection
     */
    public function index($product_id)
    {
        return DB::table('oc_product_description')->where('product_id', $product_id)->get();
    }

    /**
     * Store a newly created product description in storage.
     * @urlParam product required product id Example: 2
     * @bodyParam product_id integer required
     * @bodyParam language_id integer required
     * @bodyParam name string required
     * @bodyParam meta_description string required
     * @bodyParam meta_keywords string required
     * @bodyParam description string required
     * @bodyParam intro string required
     * @response  {
     * "product_id":1,
     * "language_id":5
     * }
     *
     * @param Request $request
     * @param $product_id
     * @return Response
     * @throws AuthorizationException
     */
    public function store(Request $request, $product_id)
    {
        $this->authorize('modify', Product::class);
        $bool = DB::table('oc_product_description')->insert(
            [
                'product_id' => $product_id,
                'language_id' => $request->input('language_id'),
                'name' => $request->input('name'),
                'meta_description' => $request->input('meta_description'),
                'meta_keywords' => $request->input('meta_keywords'),
                'description' => $request->input('description'),
                'intro' => $request->input('intro')
            ]
        );
        if($bool) return response()->json([
            'product_id' => $product_id,
            'language_id' => $request->input('language_id')
        ]);
    }

    /**
     * Display the specified product description.
     * @urlParam product required product id Example: 2
     * @urlParam language required language id Example: 2
     * @response  {
     * "product_id":1,
     * "language_id":5,
     * "name":"Holící strojek F3790 Dual Flex Foil Shaver",
     * "meta_description":"Planžetový holící strojek Remington F3790 Dual Flex Foil Shaver",
     * "meta_keywords":"planžetový, holící strojek, Remington, Remington F3790, pánské strojky, holení, planžety",
     * "description":"&lt;h2&gt;
     * Remington F 3790 Dual Flex Foil Shaver&lt;/h2&gt;
     * &lt;ul&gt;
     * &lt;li&gt;
     * 2 přizpůsobiv&amp;eacute; planžety pro hladk&amp;eacute; oholen&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * Nab&amp;iacute;jec&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * 16 hodin do pln&amp;eacute;ho nabit&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * Až 40 minut provozu&lt;/li&gt;
     * &lt;li&gt;
     * V&amp;yacute;suvn&amp;yacute; detailn&amp;iacute; zastřihovač&lt;/li&gt;
     * &lt;li&gt;
     * Kontrolka nab&amp;iacute;jen&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * 2 roky z&amp;aacute;ruka&lt;/li&gt;
     * &lt;li&gt;
     * barva čern&amp;aacute;&lt;/li&gt;
     * &lt;li&gt;
     * Typ hol&amp;iacute;c&amp;iacute;ho strojku: planžetov&amp;yacute;&lt;/li&gt;
     * &lt;li&gt;
     * Zdroj energie: akumul&amp;aacute;torov&amp;yacute;&lt;/li&gt;
     * &lt;li&gt;
     * rozměry balen&amp;iacute; V x &amp;Scaron; x H (mm): 235 x 161 x 92&lt;/li&gt;
     * &lt;li&gt;
     * hmotnost balen&amp;eacute;ho v&amp;yacute;robku (g) 615&lt;/li&gt;
     * &lt;/ul&gt;
     * ",
     * "intro":"
     * &lt;p&gt;
     * &amp;nbsp;&lt;/p&gt;
     * &lt;ul&gt;
     * &lt;li&gt;
     * 2 přizpůsobiv&amp;eacute; planžety pro hladk&amp;eacute; oholen&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * Nab&amp;iacute;jec&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * 16 hodin do pln&amp;eacute;ho nabit&amp;iacute;&lt;/li&gt;
     * &lt;li&gt;
     * Až 40 minut provozu&lt;/li&gt;
     * &lt;li&gt;
     * V&amp;yacute;suvn&amp;yacute; detailn&amp;iacute; zastřihovač&lt;/li&gt;
     * &lt;li&gt;
     * Kontrolka nab&amp;iacute;jen&amp;iacute;&lt;/li&gt;
     * &lt;/ul&gt;
     * &lt;p&gt;
     * &amp;nbsp;&lt;/p&gt;
     * &lt;ul&gt;
     * &lt;/ul&gt;
     * ",
     * }
     *
     * @param $product_id
     * @param $language_id
     * @return Response
     */
    public function show($product_id, $language_id)
    {
        return DB::table('oc_product_description')
            ->where('product_id', $product_id)
            ->where('language_id', $language_id)
            ->first();
    }


    /**
     * Update the specified product description in storage.
     * @urlParam product required product id Example: 2
     * @urlParam language required language id Example: 2
     * @bodyParam name string
     * @bodyParam meta_description string
     * @bodyParam meta_keywords string
     * @bodyParam intro string
     * @response  {
     * "name":true,
     * "meta_description":true
     * }
     *
     * @param Request $request
     * @param $product_id
     * @param $language_id
     * @return Response
     * @throws AuthorizationException
     */
    public function update(Request $request, $product_id, $language_id)
    {
        $this->authorize('modify', Product::class);
        $pd = $this->show($product_id, $language_id);
        $ret_array = [];
        if ($request->has('name')) {
            $ret_array += array('name' => $pd->update([
                'name' => $request->input('name')
            ]));
        }
        if ($request->has('meta_description')) {
            $ret_array += array('meta_description' => $pd->update([
                'meta_description' => $request->input('meta_description')
            ]));
        }
        if ($request->has('meta_keywords')) {
            $ret_array += array('meta_keywords' => $pd->update([
                'meta_keywords' => $request->input('meta_keywords')
            ]));
        }
        if ($request->has('description')) {
            $ret_array += array('description' => $pd->update([
                'description' => $request->input('descriptione')
            ]));
        }
        if ($request->has('intro')) {
            $ret_array += array('intro' => $pd->update([
                'intro' => $request->input('intro')
            ]));
        }

        return response()->json($ret_array);
    }

    /**
     * Remove the specified product description from storage.
     * @urlParam product required product id Example: 2
     * @urlParam language required language id Example: 2
     * @response {true}
     *
     * @param $product_id
     * @param $language_id
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy($product_id, $language_id)
    {
        $pd = $this->show($product_id, $language_id);
        $this->authorize('modify', Product::class);
        return response()->json($pd->delete());
    }
}
