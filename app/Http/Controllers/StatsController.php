<?php

namespace App\Http\Controllers;

use App\Enums\CacheKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $keyPrefix = config('app.name') . ':';
        $keyPrefix = strtolower(str_replace(' ', ':', $keyPrefix));

        $totalSessionsSinceLastMonthKey = $keyPrefix . CacheKey::TOTAL_SESSIONS_SINCE_LAST_MONTH;
        $totalSessionsSinceLastMonthPercentageKey = $keyPrefix . CacheKey::TOTAL_SESSIONS_SINCE_LAST_MONTH_PERCENTAGE;
        $totalSessionsTimeKey = $keyPrefix . CacheKey::TOTAL_SESSIONS_TIME;
        $totalSessionsTimeMonthlyKey = $keyPrefix . CacheKey::TOTAL_SESSIONS_TIME_MONTHLY;
        $totalSessionsTimeMonthlyPercentageKey = $keyPrefix . CacheKey::TOTAL_SESSIONS_TIME_MONTHLY_PERCENTAGE;
        $totalSessionsTimeTodayKey = $keyPrefix . CacheKey::TOTAL_SESSIONS_TIME_TODAY;
        $totalSessionsTimeTodayPercentageKey = $keyPrefix . CacheKey::TOTAL_SESSIONS_TIME_TODAY_PERCENTAGE;
        $totalRevenueKey = $keyPrefix . CacheKey::TOTAL_REVENUE;
        $totalRevenueMonthlyKey = $keyPrefix . CacheKey::TOTAL_REVENUE_MONTHLY;
        $totalRevenueTodayKey = $keyPrefix . CacheKey::TOTAL_REVENUE_TODAY;
        $totalRevenueTodayPercentageKey = $keyPrefix . CacheKey::TOTAL_REVENUE_TODAY_PERCENTAGE;
        $totalProductSalesKey = $keyPrefix . CacheKey::TOTAL_PRODUCT_SALES;
        $totalProductSalesMonthlyKey = $keyPrefix . CacheKey::TOTAL_PRODUCT_SALES_MONTHLY;
        $totalProductSalesTodayKey = $keyPrefix . CacheKey::TOTAL_PRODUCT_SALES_TODAY;
        $totalProductSalesTodayPercentageKey = $keyPrefix . CacheKey::TOTAL_PRODUCT_SALES_TODAY_PERCENTAGE;

        $totalSessionsSinceLastMonth = Redis::get($totalSessionsSinceLastMonthKey);
        $totalSessionsSinceLastMonthPercentage = Redis::get($totalSessionsSinceLastMonthPercentageKey);
        $totalSessionsTime = Redis::get($totalSessionsTimeKey);
        $totalSessionsTimeMonthly = Redis::get($totalSessionsTimeMonthlyKey);
        $totalSessionsTimeMonthlyPercentage = Redis::get($totalSessionsTimeMonthlyPercentageKey);
        $totalSessionsTimeToday = Redis::get($totalSessionsTimeTodayKey);
        $totalSessionsTimeTodayPercentage = Redis::get($totalSessionsTimeTodayPercentageKey);
        $totalRevenue = Redis::get($totalRevenueKey);
        $totalRevenueMonthly = Redis::get($totalRevenueMonthlyKey);
        $totalRevenueToday = Redis::get($totalRevenueTodayKey);
        $totalRevenueTodayPercentage = Redis::get($totalRevenueTodayPercentageKey);
        $totalProductSales = Redis::get($totalProductSalesKey);
        $totalProductSalesMonthly = Redis::get($totalProductSalesMonthlyKey);
        $totalProductSalesToday = Redis::get($totalProductSalesTodayKey);
        $totalProductSalesTodayPercentage = Redis::get($totalProductSalesTodayPercentageKey);


        return view('stats', compact(
            'totalSessionsSinceLastMonth',
            'totalSessionsSinceLastMonthPercentage',
            'totalSessionsTime',
            'totalSessionsTimeMonthly',
            'totalSessionsTimeMonthlyPercentage',
            'totalSessionsTimeToday',
            'totalSessionsTimeTodayPercentage',
            'totalRevenue',
            'totalRevenueMonthly',
            'totalRevenueToday',
            'totalRevenueTodayPercentage',
            'totalProductSales',
            'totalProductSalesMonthly',
            'totalProductSalesToday',
            'totalProductSalesTodayPercentage',
        ));
    }
}
