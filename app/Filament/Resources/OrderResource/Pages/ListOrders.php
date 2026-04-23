<?php
namespace App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('export')
                ->label('Export Laporan (CSV)')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                    $orders = \App\Models\Order::orderBy('created_at', 'desc')->get();
                    
                    // Create CSV content
                    $handle = fopen('php://temp', 'r+');
                    fputcsv($handle, ['ID', 'Pelanggan', 'HP', 'Total', 'Status', 'Tanggal']);
                    
                    foreach ($orders as $order) {
                        fputcsv($handle, [
                            $order->id,
                            $order->customer_name,
                            $order->phone,
                            $order->total,
                            $order->status,
                            $order->created_at->format('d/m/Y H:i'),
                        ]);
                    }
                    
                    rewind($handle);
                    $csv = stream_get_contents($handle);
                    fclose($handle);
                    
                    return response()->streamDownload(
                        fn () => print($csv),
                        "Laporan_Keuangan_DRM_" . date('Y-m-d') . ".csv"
                    );
                }),
        ];
    }
}
