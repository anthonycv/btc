<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\BtcPrice;
use RuntimeException;

class BtcController extends Controller
{
    /**
     * Response of api request
     *
     * @var array
     */
    protected $apiResponse = [
        'status' => true,
        'message' => 'success',
        'data' => ''
    ];

    /**
     * Crypto to consult price
     *
     * @var
     */
    protected $crypto;

    /**
     * Currency of price the crypto to consult
     *
     * @var
     */
    protected $currency;

    /**
     * Index route
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view("btc");
    }

    /**
     * Get the crypto price Api endpoint route
     *
     * @param Request $request
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function getBtcPrice(Request $request)
    {
        try {
            $this->setParams($request->all(), ['crypto', 'currency']);
            $this->requestBtcPriceInfo();
            $this->store();
            return response()->json($this->apiResponse, 200);
        } catch (\Exception $e) {
            Log::error("ERROR: BtcController::getBtcPrice -> {$e}");
            $this->apiResponse['status'] = false;
            $this->apiResponse['message'] = "Error: {$e->getMessage()}";
            return response()->json($this->apiResponse, ((int)$e->getCode() !== 0) ? $e->getCode() : 500);
        }
    }

    /**
     * Set and validate params in request
     *
     * @param $params
     * @param $validateKeys
     */
    private function setParams($params, $validateKeys)
    {
        foreach ($validateKeys as $key) {
            if (array_key_exists($key, $params) && !empty($params[$key])) {
                $this->{$key} = $params[$key];
                continue;
            }
            throw new RuntimeException("The param {$key} is required.", 400);
        }
    }

    /**
     * Request to external API to consult the crypto price
     *
     * @throws GuzzleException
     */
    private function requestBtcPriceInfo()
    {
        try {
            $client = new Client();
            $requestURL = env('BLOCK_CHAIN_BTC_PRICE_END_POINT') . $this->crypto . '-' . $this->currency;
            $singleCurrencyRequest = $client->request('GET', $requestURL);
            $this->apiResponse['data'] = json_decode($singleCurrencyRequest->getBody(), true);
        } catch (\Exception $e) {
            Log::error("ERROR: BtcController::requestBtcPriceInfo -> {$e}");
            throw new RuntimeException("Error: {$e->getMessage()}");
        }
    }

    /**
     * Register in DB the crypto price
     */
    private function store()
    {
        try {
            DB::beginTransaction();
            $btcPrice = new BtcPrice();
            $btcPrice->crypto = $this->crypto;
            $btcPrice->currency = $this->currency;
            $btcPrice->priceDay = $this->apiResponse['data']['price_24h'];
            $btcPrice->volumeDay = $this->apiResponse['data']['volume_24h'];
            $btcPrice->lastTradePrice = $this->apiResponse['data']['last_trade_price'];
            $btcPrice->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error("ERROR: BtcController::store -> {$e}");
            throw new RuntimeException("Error: {$e->getMessage()}");
        }
    }
}
