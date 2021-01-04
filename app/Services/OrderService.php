<?php
namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class OrderService extends Controller
{
    public static function getTransitOrCODPrice(Order $order, $keySuffix, $shipping_method)
    {
        $sm_transcript = "";
        switch ($shipping_method) {
            case "Česká pošta (Balík Do ruky)":
                $sm_transcript = "shipping:ceska_posta_dr:";
                break;
            case "Česká pošta (Balík Na poštu)":
                $sm_transcript = "shipping:ceska_posta_np:";
                break;
            case "Česká pošta (Balík Do balíkovny)":
                $sm_transcript = "shipping:ceska_posta_balikomat:";
                break;
            case "Slovenská pošta":
                $sm_transcript = "shipping:zasilkovna_sk_post:";
                break;
            case "Zásilkovna":
                $sm_transcript = "shipping:zasilkovna_cz:";
                break;
            case "Zásielkovňa":
                $sm_transcript = "shipping:zasilkovna_sk:";
                break;
            case "GLS":
                $sm_transcript = "shipping:zasilkovna_sk_gls:";
                break;
            case "DPD":
                $sm_transcript = "shipping:zasilkovna_cz_dpd:";
                break;
            case "Geis":
                $sm_transcript = "shipping:geis:";
                break;
            case "Geis Slovensko":
                $sm_transcript = "shipping:geis_sk:";
                break;
            default:
                return false;
        }

        $product_ids = Order_product::where('order_id', $order->order_id)->pluck('product_id');
        $free_shipping = 0;
        foreach ($product_ids as $product_id) {
            $free_shipping = Product::where('product_id', $product_id)->value('free_shipping');
            if ($free_shipping == 1) {
                break;
            }
        }
        $key = $sm_transcript . $keySuffix;
        $domain_setup = DB::table('oc_domain_setup')
            ->where('key', $key)
            ->where('domain', $order->domain)
            ->value('value');
        $price = self::domain_setupValue($domain_setup, $free_shipping, $order->total);
        if ($price === false) return false;
        if (strpos($price, "<EUR>"))
        {
            $price = str_replace("<EUR>", "", $price);
            $price = $price / Currency::getEuroValue();
        }
        return $price;
    }


    public static function domain_setupValue($domain_setup, $free_shipping, $total)
    {
        $arr = explode(",", $domain_setup);
        foreach ($arr as $el) {
            if ($el[0] === 'f') {
                if ($free_shipping === 1) {
                    $val = 0;
                    return $val;
                } else {
                    continue;
                }
            } elseif (is_numeric($el[0])) {
                $arr2 = explode(":", $el);
                if (strpos($arr2[0], "<EUR>") and strpos($total, "<EUR>")) {
                    $arr2[0] = str_replace("<EUR>", "", $arr2[0]);
                    $total = str_replace("<EUR>", "", $total);
                } elseif ((strpos($arr2[0], "<EUR>") and !strpos($total, "<EUR>"))) {
                    //v korunách
                    $arr2[0] = str_replace("<EUR>", "", $arr2[0]);
                    $arr2[0] = $arr2[0] / Currency::getEuroValue();
                } elseif (!(strpos($arr2[0], "<EUR>")) and (strpos($total, "<EUR>"))) {
                    $total = str_replace("<EUR>", "", $total);
                    $value = Currency::getEuroValue();
                    $total = $total / $value;
                }
                if ($total <= $arr2[0]) {
                    $val = $arr2[1];
                    return $val;
                } else {
                    continue;
                }
            } elseif ($el[0] === ':') {
                $val = ltrim($el, ':');
                return $val;
            } else return false;
        }
    }

    public static function getTransitAndPaymentPurchasePrice(Order $order)
    {
        $sm_transcript = "";
        switch($order->shipping_method) {
            case "Česká pošta (Balík Do ruky)":
                $sm_transcript = "ceska_posta_purchase_dr";
                break;
            case "Česká pošta (Balík Na poštu)":
                $sm_transcript = "ceska_posta_purchase_np";
                break;
            case "Česká pošta (Balík Do balíkovny)":
                $sm_transcript = "ceska_posta_purchase_balikomat";
                break;
            case "Slovenská pošta":
                $sm_transcript = "zasilkovna_sk_purchase_post";
                break;
            case "Zásilkovna":
                $sm_transcript = "zasilkovna_cz_purchase";
                break;
            case "Zásielkovňa":
                $sm_transcript = "zasilkovna_sk_purchase";
                break;
            case "GLS" or "Geis" or "DPD":
                $sm_transcript = "gls_purchase";
                break;
            case "Geis Slovensko":
                $sm_transcript = "zasilkovna_sk_purchase_gls";
                break;
            default:
                return false;
        }
        $shipping_price = Setting::where('key', $sm_transcript)->value('value');

        if($order->payment_method === "Platba kartou")
        {
            $value = Setting::where('key','agmo_purchase_fixed')->value('value');
            $pct = Setting::where('key','agmo_purchase_pct')->value('value');
            return $shipping_price + $value + $pct / 100 * $order->value;
        }

        if($order->payment_method === "Na dobírku" or $order->payment_method === "Na dobierku")
        {
            $sm_transcript = $sm_transcript . "_cod";
            $codPrice = Setting::where('key',$sm_transcript)->value('value');
            return $shipping_price + $codPrice;
        }

        return $shipping_price;
    }
}
