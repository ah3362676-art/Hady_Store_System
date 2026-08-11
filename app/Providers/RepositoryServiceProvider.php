<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;

use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CustomerPaymentRepositoryInterface;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\UnitRepositoryInterface;
use App\Repositories\BrandRepository;
use App\Repositories\UnitRepository;
use App\Repositories\productRepository;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\PurchaseItemRepositoryInterface;
use App\Interfaces\PurchaseRepositoryInterface;
use App\Interfaces\ReportRepositoryInterface;
use App\Interfaces\SaleItemRepositoryInterface;
use App\Interfaces\SaleRepositoryInterface;
use App\Interfaces\StatementRepositoryInterface;
use App\Interfaces\SupplierPaymentRepositoryInterface;
use App\Interfaces\SupplierRepositoryInterface;
use App\Repositories\CustomerPaymentRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\PurchaseItemRepository;
use App\Repositories\PurchaseRepository;
use App\Repositories\ReportRepository;
use App\Repositories\SaleItemRepository;
use App\Repositories\SaleRepository;
use App\Repositories\StatementRepository;
use App\Repositories\SupplierPaymentRepository;
use App\Repositories\SupplierRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

         $this->app->bind(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

         $this->app->bind(
            UnitRepositoryInterface::class,
            UnitRepository::class
        );

         $this->app->bind(
            ProductRepositoryInterface::class,
            productRepository::class
        );

         $this->app->bind(
            SupplierRepositoryInterface::class,
            SupplierRepository::class
        );
         $this->app->bind(
            PurchaseItemRepositoryInterface::class,
            PurchaseItemRepository::class
        );
         $this->app->bind(
            PurchaseRepositoryInterface::class,
            PurchaseRepository::class
        );

          $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );

        $this->app->bind(
        SaleRepositoryInterface::class,
        SaleRepository::class
        );

        $this->app->bind(
        SaleItemRepositoryInterface::class,
        SaleItemRepository::class
        );

        $this->app->bind(
    CustomerPaymentRepositoryInterface::class,
    CustomerPaymentRepository::class
);

$this->app->bind(
    SupplierPaymentRepositoryInterface::class,
    SupplierPaymentRepository::class
);

$this->app->bind(
    ReportRepositoryInterface::class,
    ReportRepository::class
);

$this->app->bind(
    StatementRepositoryInterface::class,
    StatementRepository::class
);
    }

    public function boot(): void
    {
        //
    }
}
