<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Review;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Review
 */
class ReviewController extends Controller
{
    /**
     * Display a listing of all reviews.
     * @bodyParam product_id required integer
     * @response  {[
     * "review_id":2,
     * "product_id":66,
     * "customer_id":0,
     * "author":'Jan',
     * "text":'Super.',
     * "rating":5,
     * "status":1,
     * "date_added":"2012-01-28 17:00:18",
     * "date_modified":"2012-01-28 17:00:18"
     * ]}
     *
     * @param Request $request
     * @return Review[]|Collection
     */
    public function index(Request $request)
    {
        return Review::where('product_id', $request->input('product_id'))->all();
    }

    /**
     * Store a newly created review in storage.
     * @bodyParam product_id integer required Example: 2
     * @bodyParam customer_id integer required Example: 5
     * @bodyParam author string Example: 'Kamila'
     * @bodyParam text string required ip address Example: "Je to moc dobré."
     * @bodyParam rating integer required Example: 5
     * @bodyParam status integer required Example: 1
     * @response  {
     * "review_id":2,
     * }
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if(!$request->has('author'))
            $customer = Customer::find($request->input('customer_id'));
        $rid = Review::insertGetId(
            [
                'product_id' => $request->input('product_id'),
                'customer_id' => $request->input('customer_id'),
                'author' => $request->input('author', $customer->firstname . ' ' . $customer->lastname),
                'text' => $request->input('text'),
                'rating' => $request->input('rating'),
                'status' => $request->input('status')
            ]
        );

        return response()->json(['review_id' => $rid]);
    }

    /**
     * Display the specified review.
     * @urlParam review required review id Example: 2
     * @response  {
     * "review_id":2,
     * "product_id":66,
     * "customer_id":0,
     * "author":'Jan',
     * "text":'Super.',
     * "rating":5,
     * "status":1,
     * "date_added":"2012-01-28 17:00:18",
     * "date_modified":"2012-01-28 17:00:18"
     * }
     *
     * @param Review $review
     * @return Review
     */
    public function show(Review $review)
    {
        return $review;
    }

    /**
     * Update the specified review in storage.
     * @urlParam review required review id Example: 2
     * @bodyParam author string Example: "Jaroslav"
     * @bodyParam text string
     * @bodyParam rating integer
     * @response  {
     * "author":true,
     * "text":true
     * }
     *
     * @param Request $request
     * @param Review $review
     * @return Response
     * @throws AuthorizationException
     */
    public function update(Request $request, Review $review)
    {
        $this->authorize('modify', Review::class);
        $ret_array = [];
        if ($request->has('author')) {
            $ret_array += array('author' => $review->update([
                'author' => $request->input('author')
            ]));
        }
        if ($request->has('text')) {
            $ret_array += array('text' => $review->update([
                'text' => $request->input('text')
            ]));
        }
        if ($request->has('rating')) {
            $ret_array += array('rating' => $review->update([
                'rating' => $request->input('rating')
            ]));
        }
        return response()->json($ret_array);
    }

    /**
     * Remove the specified resource from storage.
     * @urlParam review required review id Example: 2
     * @response true
     *
     * @param Review $review
     * @return Response
     * @throws Exception
     */
    public function destroy(Review $review)
    {
        $this->authorize('modify', Review::class);
        return response()->json($review->delete());
    }
}
