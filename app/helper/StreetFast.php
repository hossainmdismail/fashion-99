<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class SteadfastCourierService
{
    protected $base_url = 'https://portal.packzy.com/api/v1';
    private $api_key = 'your_api_key_here';
    private $secret_key = 'your_secret_key_here';

    /**
     * Create a single order.
     *
     * @param array $orderData
     * @return array
     */
    public function createOrder(array $orderData): array
    {
        $response = Http::withHeaders($this->getHeaders())->post("{$this->base_url}/create_order", $orderData);
        return $response->json();
    }

    /**
     * Create bulk orders.
     *
     * @param array $ordersData
     * @return array
     */
    public function createBulkOrders(array $ordersData): array
    {
        $response = Http::withHeaders($this->getHeaders())->post("{$this->base_url}/create_order/bulk-order", [
            'data' => json_encode($ordersData)
        ]);
        return $response->json();
    }

    /**
     * Check delivery status by consignment ID.
     *
     * @param string $consignmentId
     * @return array
     */
    public function checkStatusByConsignmentId(string $consignmentId): array
    {
        $response = Http::withHeaders($this->getHeaders())->get("{$this->base_url}/status_by_cid/{$consignmentId}");
        return $response->json();
    }

    /**
     * Check delivery status by invoice ID.
     *
     * @param string $invoiceId
     * @return array
     */
    public function checkStatusByInvoiceId(string $invoiceId): array
    {
        $response = Http::withHeaders($this->getHeaders())->get("{$this->base_url}/status_by_invoice/{$invoiceId}");
        return $response->json();
    }

    /**
     * Check delivery status by tracking code.
     *
     * @param string $trackingCode
     * @return array
     */
    public function checkStatusByTrackingCode(string $trackingCode): array
    {
        $response = Http::withHeaders($this->getHeaders())->get("{$this->base_url}/status_by_trackingcode/{$trackingCode}");
        return $response->json();
    }

    /**
     * Get the current balance.
     *
     * @return array
     */
    public function getCurrentBalance(): array
    {
        $response = Http::withHeaders($this->getHeaders())->get("{$this->base_url}/get_balance");
        return $response->json();
    }

    /**
     * Get the necessary headers for making API requests.
     *
     * @return array
     */
    protected function getHeaders(): array
    {
        return [
            'Api-Key' => $this->api_key,
            'Secret-Key' => $this->secret_key,
            'Content-Type' => 'application/json'
        ];
    }
}
