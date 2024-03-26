<?php

namespace App\Providers;

use App\Models\TransactionBatches;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('currency', function ($expression) {
            return "<?php echo number_format($expression,0,',',','); ?>";
        });

        Blade::directive('invoiceNumber', function () {
            $prefix = date('y');
            $nextNumber = str_pad(TransactionBatches::count() + 1, 10, '0', STR_PAD_LEFT); 
        
            return "<?php echo 'TRX-$prefix$nextNumber'; ?>";
        });
        
        Blade::directive('shortenText', function ($expression) {
            return "<?php echo str_word_count($expression, 2) > 10 ? implode(' ', array_slice(str_word_count($expression, 2), 0, 10)) . '...' : $expression; ?>";
        });

        Blade::directive('separator', function ($expression) {
            return "<?php echo number_format($expression, 0, ',', ','); ?>";
        });
    }
}
