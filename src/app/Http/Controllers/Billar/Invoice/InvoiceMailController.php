<?php

namespace App\Http\Controllers\Billar\Invoice;

use App\Http\Controllers\Controller;
use App\Jobs\InvoiceAttachmentJob;
use App\Jobs\SendInvoiceJob;
use App\Jobs\SendMessageJob;
use App\Models\Billar\Invoice\Invoice;
use App\Repositories\Core\Setting\SettingRepository;
use App\Services\Billar\Invoice\InvoiceService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InvoiceMailController extends Controller
{
    public function __construct(InvoiceService $service)
    {
        $this->service = $service;
    }

    public function sendInvoice(Request $request, Invoice $invoice)
    {
        $this->service
            ->setSendInvoiceValidation();

        $invoiceInfo = $this->service->loadInvoiceInfo($invoice);

        $this->service
            ->setAttribute('file_path', 'public/pdf/send_invoice_' . $invoice->id . '.pdf')
            ->pdfGenerate($invoiceInfo);


        $message = $this->service->tags($invoiceInfo, $request->message);

        SendInvoiceJob::dispatch($invoiceInfo, $request->subject, $message)->onQueue('high');

        return response()->json([
            'status' => true,
            'message' => trans('default.invoice_email_send'),
        ]);
    }

    public function resendInvoice(Invoice $invoice): \Illuminate\Http\JsonResponse
    {
        $invoiceInfo = $this->service->loadInvoiceInfo($invoice);

        $invoiceNote = resolve(SettingRepository::class)->getFormattedSettings('app');

        $invoiceInfo->invoice_note = @$invoiceNote['invoice_note'];

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $invoiceInfo->date)->format('d-m-y h:i A');

        $this->service
            ->setAttribute('file_path', 'public/pdf/invoice_' . $invoice->id . '.pdf')
            ->pdfGenerate($invoiceInfo);

        InvoiceAttachmentJob::dispatch($invoiceInfo)->onQueue('high');
        if ($invoiceInfo->received_amount) {
            SendMessageJob::dispatch('book-confirmation-message', $invoiceInfo->client_number, $invoiceInfo->received_amount, $date);
        }

        return response()->json([
            'status' => true,
            'message' => trans('default.invoice_send_success'),
            'date' => $date,
            'invoice' => $invoiceInfo
        ], 200);
    }

    public function thankyouInvoice(Invoice $invoice): \Illuminate\Http\JsonResponse
    {
        $invoiceInfo = $this->service->loadInvoiceInfo($invoice);

        $invoiceNote = resolve(SettingRepository::class)->getFormattedSettings('app');

        $invoiceInfo->invoice_note = @$invoiceNote['invoice_note'];

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $invoiceInfo->date)->format('d-m-y h:i A');

        $this->service
            ->setAttribute('file_path', 'public/pdf/invoice_' . $invoice->id . '.pdf')
            ->pdfGenerate($invoiceInfo);

        InvoiceAttachmentJob::dispatch($invoiceInfo)->onQueue('high');
        if ($invoiceInfo->received_amount) {
            SendMessageJob::dispatch('onboard-message', $invoiceInfo->client_number, $invoiceInfo->received_amount, $date);
        }

        return response()->json([
            'status' => true,
            'message' => trans('default.invoice_thank_you_success'),
            'invoice' => $invoiceInfo
        ], 200);
    }
}
