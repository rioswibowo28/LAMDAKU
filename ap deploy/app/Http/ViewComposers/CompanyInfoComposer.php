<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\CompanyInfo;

class CompanyInfoComposer
{
    /**
     * Create a new company info composer.
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $companyInfo = CompanyInfo::getActiveCompanyInfo();
        
        $view->with([
            'globalCompanyInfo' => $companyInfo,
            'globalWebsiteUrl' => $companyInfo && $companyInfo->website ? $companyInfo->website : url('/')
        ]);
    }
}
