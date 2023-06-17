<?php

namespace App\Console\Commands;

use App\Enums\CacheKey;
use App\Models\Price;
use App\Models\Session;
use App\Models\SessionProduct;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class UpdateStatsForRedis extends Command
{
    protected $signature = 'redis:update-stats';

    protected $description = 'Update the statistics for Redis keys';

    public function handle()
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


        // Calculate total sessions since last month
        $totalSessionsSinceLastMonth = Session::where('started_at', '>=', now()->subMonth())->count();
        Redis::set($totalSessionsSinceLastMonthKey, $totalSessionsSinceLastMonth);

        // Calculate total sessions since last month percentage
        $totalSessionsCount = Session::count();
        $totalSessionsSinceLastMonthPercentage = ($totalSessionsSinceLastMonth / $totalSessionsCount) * 100;
        Redis::set($totalSessionsSinceLastMonthPercentageKey, number_format($totalSessionsSinceLastMonthPercentage, 2));


        // Calculate total sessions time for the current month
        $currentMonth = now()->format('Y-m');
        $totalSessionsTimeMonthly = Session::whereRaw("DATE_FORMAT(started_at, '%Y-%m') = ?", [$currentMonth])->sum('duration');
        Redis::set($totalSessionsTimeMonthlyKey, $totalSessionsTimeMonthly);


        // Calculate total sessions time for the current month
        $currentMonth = now()->format('Y-m');
        $totalSessionsTimeMonthly = Session::whereRaw("DATE_FORMAT(started_at, '%Y-%m') = ?", [$currentMonth])->sum('duration');
        // Calculate total sessions time for all months
        $totalSessionsTime = Session::sum('duration');
        // Calculate the percentage of sessions time for the current month
        $totalSessionsTimeMonthlyPercentage = ($totalSessionsTimeMonthly / $totalSessionsTime) * 100;
        Redis::set($totalSessionsTimeMonthlyPercentageKey, number_format($totalSessionsTimeMonthlyPercentage, 2));

        // Calculate total sessions time for all sessions
        $totalSessionsTime = Session::sum('duration');
        Redis::set($totalSessionsTimeKey, $totalSessionsTime);


        // Calculate total sessions time for today
        $today = Carbon::today();
        $todaySessions = Session::whereDate('started_at', $today)->get();

        $todaySessionsTime = 0;

        foreach ($todaySessions as $session) {
            $durationMinutes = $session->duration;
            if ($durationMinutes !== null) {
                $todaySessionsTime += $durationMinutes;
            }
        }

        Redis::set($totalSessionsTimeTodayKey, $todaySessionsTime);

        // Calculate total sessions time for today
        $todaySessionsTime = Session::whereDate('started_at', today())->sum('duration');
        // Calculate total sessions time for all sessions
        $totalSessionsTime = Session::sum('duration');
        // Calculate the percentage of sessions time for today
        $totalSessionsTimeTodayPercentage = ($todaySessionsTime / $totalSessionsTime) * 100;
        Redis::set($totalSessionsTimeTodayPercentageKey, number_format($totalSessionsTimeTodayPercentage,2));

        // Calculate total product sales
        $totalProductSales = 0;

        $sessionProducts = SessionProduct::all();

        foreach ($sessionProducts as $sessionProduct) {
            $product = $sessionProduct->product;
            $price = $product->price;
            $numberOfItems = $sessionProduct->number_of_items;

            $productSale = $price * $numberOfItems;
            $totalProductSales += $productSale;
        }

        Redis::set($totalProductSalesKey, $totalProductSales);

        // Calculate total product sales for the current month
        $currentMonth = now()->format('Y-m');
        $totalProductSalesMonthly = 0;

        $sessionProducts = SessionProduct::whereHas('session', function ($query) use ($currentMonth) {
            $query->whereRaw("DATE_FORMAT(started_at, '%Y-%m') = ?", [$currentMonth]);
        })->get();

        foreach ($sessionProducts as $sessionProduct) {
            $product = $sessionProduct->product;
            $price = $product->price;
            $numberOfItems = $sessionProduct->number_of_items;

            $productSale = $price * $numberOfItems;
            $totalProductSalesMonthly += $productSale;
        }

        Redis::set($totalProductSalesMonthlyKey, $totalProductSalesMonthly);

        // Calculate total product sales for today
        $today = now()->format('Y-m-d');
        $totalProductSalesToday = 0;

        $sessionProducts = SessionProduct::whereHas('session', function ($query) use ($today) {
            $query->whereDate('started_at', $today);
        })->get();

        foreach ($sessionProducts as $sessionProduct) {
            $product = $sessionProduct->product;
            $price = $product->price;
            $numberOfItems = $sessionProduct->number_of_items;

            $productSale = $price * $numberOfItems;
            $totalProductSalesToday += $productSale;
        }

        Redis::set($totalProductSalesTodayKey, $totalProductSalesToday);

        // Calculate total product sales today percentage
        $totalProductSales = Redis::get($totalProductSalesKey);
        $totalProductSalesToday = Redis::get($totalProductSalesTodayKey);

        if ($totalProductSales > 0) {
            $totalProductSalesTodayPercentage = ($totalProductSalesToday / $totalProductSales) * 100;
        } else {
            $totalProductSalesTodayPercentage = 0;
        }
        Redis::set($totalProductSalesTodayPercentageKey, number_format($totalProductSalesTodayPercentage, 2));



        // Calculate total revenue
        $totalRevenue = 0;

        $sessions = Session::all();

        foreach ($sessions as $session) {
            $durationMinutes = $session->duration;
            $pricePerHour = $session->price->price;
            $minPrice = $session->price->start_price;

            $price = $durationMinutes / 60 * $pricePerHour;
            $roundedPrice = ceil($price / 0.05) * 0.05; // Round up to the nearest 0.05 increment
            $sessionRevenue = max($roundedPrice, $minPrice); // Ensure the session revenue is at least the minimum price

            $totalRevenue += $sessionRevenue;
        }

        $totalProductSales = Redis::get($totalProductSalesKey);
        $totalRevenue += $totalProductSales;

        $totalRevenue = round($totalRevenue, 2); // Round to two decimal places

        Redis::set($totalRevenueKey, $totalRevenue);


        // Calculate total revenue for the month
        $totalRevenueMonthly = 0;

        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        $sessions = Session::whereBetween('started_at', [$startDate, $endDate])->get();

        foreach ($sessions as $session) {
            $durationMinutes = $session->duration;
            $pricePerHour = $session->price->price;
            $minPrice = $session->price->start_price;

            $price = $durationMinutes / 60 * $pricePerHour;
            $roundedPrice = ceil($price / 0.05) * 0.05; // Round up to the nearest 0.05 increment
            $sessionRevenue = max($roundedPrice, $minPrice); // Ensure the session revenue is at least the minimum price

            $totalRevenueMonthly += $sessionRevenue;
        }

        $totalProductSalesMonthly = Redis::get($totalProductSalesMonthlyKey);
        $totalRevenueMonthly += $totalProductSalesMonthly;

        $totalRevenueMonthly = round($totalRevenueMonthly, 2); // Round to two decimal places

        Redis::set($totalRevenueMonthlyKey, $totalRevenueMonthly);

        // Calculate today's revenue
        $totalRevenueToday = 0;

        $startDate = now()->startOfDay();
        $endDate = now()->endOfDay();

        $sessions = Session::where('started_at', '>=', $startDate)
                           ->where('started_at', '<=', $endDate)
                           ->where('paid', 1)
                           ->get();

        foreach ($sessions as $session) {
            $durationMinutes = $session->duration;
            $pricePerHour = $session->price->price;
            $minPrice = $session->price->start_price;

            $price = $durationMinutes / 60 * $pricePerHour;
            $roundedPrice = ceil($price / 0.05) * 0.05; // Round up to the nearest 0.05 increment
            $sessionRevenue = max($roundedPrice, $minPrice); // Ensure the session revenue is at least the minimum price

            $totalRevenueToday += $sessionRevenue;
        }

        $totalProductSalesToday = Redis::get($totalProductSalesTodayKey);
        $totalRevenueToday += $totalProductSalesToday;

        $totalRevenueToday = round($totalRevenueToday, 2); // Round to two decimal places

        Redis::set($totalRevenueTodayKey, $totalRevenueToday);


        // Calculate total revenue for today
        $totalRevenueToday = Redis::get($totalRevenueTodayKey);
        $totalRevenue = Redis::get($totalRevenueKey);

        if ($totalRevenue > 0) {
            $totalRevenueTodayPercentage = ($totalRevenueToday / $totalRevenue) * 100;
        } else {
            $totalRevenueTodayPercentage = 0;
        }

        Redis::set($totalRevenueTodayPercentageKey, number_format($totalRevenueTodayPercentage,2));

        $this->info('Statistics updated for Redis keys.');
    }
}
