<?php

namespace App\Enums;

abstract class CacheKey
{
    public const TOTAL_SESSIONS_SINCE_LAST_MONTH = 'total:sessions_since_last_month';
    public const TOTAL_SESSIONS_SINCE_LAST_MONTH_PERCENTAGE = 'total:sessions_since_last_month_percentage';
    public const TOTAL_SESSIONS_TIME = 'total:session_time';
    public const TOTAL_SESSIONS_TIME_MONTHLY = 'total:session_time_monthly';
    public const TOTAL_SESSIONS_TIME_MONTHLY_PERCENTAGE = 'total:session_time_monthly_percentage';
    public const TOTAL_SESSIONS_TIME_TODAY = 'total:session_time_today';
    public const TOTAL_SESSIONS_TIME_TODAY_PERCENTAGE = 'total:session_time_today_percentage';
    public const TOTAL_REVENUE = 'total:revenue';
    public const TOTAL_REVENUE_MONTHLY = 'total:revenue_monthly';
    public const TOTAL_REVENUE_TODAY = 'total:revenue_today';
    public const TOTAL_REVENUE_TODAY_PERCENTAGE = 'total:revenue_today_percentage';
    public const TOTAL_PRODUCT_SALES = 'total:product_sales';
    public const TOTAL_PRODUCT_SALES_MONTHLY = 'total:product_sales_monthly';
    public const TOTAL_PRODUCT_SALES_TODAY = 'total:product_sales_today';
    public const TOTAL_PRODUCT_SALES_TODAY_PERCENTAGE = 'total:product_sales_today_percentage';
}
