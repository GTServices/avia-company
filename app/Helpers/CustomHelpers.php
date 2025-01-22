<?php

use App\Models\CompanyInfo;

if (!function_exists('getLogoUrl')) {
    /**
     * Get the logo URL from SiteInfo.
     * If user is not authenticated, return an empty string.
     *
     * @return string
     */
    function getLogoUrl()
    {

        // SiteInfo modelindən logo URL-ni əldə et
        $siteInfo = CompanyInfo::first(); // SiteInfo modelindən ilk məlumatı götürürük

        // Logo sahəsi boş deyilsə, URL-ni qaytar
        if ($siteInfo && !empty($siteInfo->image)) {
            return \Illuminate\Support\Facades\Storage::url($siteInfo->image); // Əgər fayl public/storage-da saxlanırsa
        }

        // Əgər logo yoxdursa, default dəyər qaytar
        return asset('assets/admin/assets/images/default-logo.png'); // Default logo şəkili
    }


    function getFaviconUrl()
    {

        // SiteInfo modelindən logo URL-ni əldə et
        $siteInfo = CompanyInfo::first(); // SiteInfo modelindən ilk məlumatı götürürük

        // Logo sahəsi boş deyilsə, URL-ni qaytar
        if ($siteInfo && !empty($siteInfo->favicon)) {
            return \Illuminate\Support\Facades\Storage::url($siteInfo->favicon); // Əgər fayl public/storage-da saxlanırsa
        }

        // Əgər logo yoxdursa, default dəyər qaytar
        return asset('assets/admin/assets/images/default-favicon.png'); // Default logo şəkili
    }


    function getImage($img)
    {
        return \Illuminate\Support\Facades\Storage::url($img);
    }
}
