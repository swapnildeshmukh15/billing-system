<?php


use App\Http\Controllers\Billar\Frontend\FrontendController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'authorize']], function () {

    Route::get('clients/list/view', [FrontendController::class, 'clientView'])
        ->middleware('can:view_clients');
    Route::get('clients/{id}/details', [FrontendController::class, 'clientDetailsView'])
        ->middleware('can:client_invoice_details');

    Route::get('invoices/list/view', [FrontendController::class, 'invoiceView'])
        ->middleware('can:view_invoices');

    Route::get('invoices/create/view', [FrontendController::class, 'invoiceCreateView'])
        ->middleware('can:view_invoices');

    Route::get('invoice/{id}/edit', [FrontendController::class, 'invoiceEditView'])
        ->middleware('can:update_invoices');

    Route::get('invoices/{id}/details', [FrontendController::class, 'invoiceDetails'])
        ->middleware('can:view_invoices');

    Route::get('payment/list/view', [FrontendController::class, 'paymentView'])
        ->middleware('can:view_payment_histories');

    Route::get('products/list/view', [FrontendController::class, 'productView'])
        ->middleware('can:view_products');

    Route::get('categories/list/view', [FrontendController::class, 'categoryView'])
        ->middleware('can:view_categories');

    //    Route::get('general-summary', [FrontendController::class, 'generalSummaryView']);
    Route::get('payment-summary', [FrontendController::class, 'paymentSummaryView'])
        ->middleware('can:payment_summary_reports');
    Route::get('client-statement', [FrontendController::class, 'clientStatementView'])
        ->middleware('can:client_statement_report_reports');
    Route::get('invoice-report', [FrontendController::class, 'invoiceReportView'])
        ->middleware('can:invoice_report_reports');
    //Route::get('expense-report', [FrontendController::class, 'expenseReportView']);

    Route::get('app-setting', [FrontendController::class, 'settings'])
        ->name('app.settings')
        ->middleware('can:view_settings');

    Route::get('expenses/list/view', [FrontendController::class, 'expenseView'])
        ->middleware('can:view_expenses');

    Route::get('purposes/list/view', [FrontendController::class, 'purposeView'])
        ->middleware('can:view_purposes');

    Route::get('recurring/invoice/list/view', [FrontendController::class, 'recurringInvoiceView'])
        ->middleware('can:view_invoices');

    Route::get('estimates/list/view', [FrontendController::class, 'estimatesView'])
        ->middleware('can:view_estimates');

    Route::get('estimates/create/view', [FrontendController::class, 'estimatesCreateView'])
        ->middleware('can:view_estimates');

    Route::get('estimates/{id}/edit/view', [FrontendController::class, 'estimatesEditView'])
        ->middleware('can:update_estimates');

    Route::get('estimates/{id}/details', [FrontendController::class, 'invoiceDetails'])
        ->middleware('can:view_estimates');

    Route::get('receipts/list/view', [FrontendController::class, 'receiptView'])
        ->middleware('can:view_payment_histories');

    Route::get('receipt/{id}/details', [FrontendController::class, 'receiptDetails'])
        ->middleware('can:view_invoices');

    Route::get('bills/list/view', [FrontendController::class, 'billView'])
        ->middleware('can:view_payment_histories');

    Route::get('bill/{id}/details', [FrontendController::class, 'billDetails'])
        ->middleware('can:view_payment_histories');

    Route::get('inventory/list/view', [FrontendController::class, 'inventoryView'])
        ->middleware('can:update_invoices');

    Route::get('inventory/create/view', [FrontendController::class, 'inventoryCreateView'])
        ->middleware('can:view_invoices');

    Route::get('inventory/{id}/edit', [FrontendController::class, 'inventoryEditView'])
        ->middleware('can:update_invoices');

    Route::get('inventory/{id}/details', [FrontendController::class, 'inventoryDetailsView'])
        ->middleware('can:view_invoices');
});
