<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenerateInventoryReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:inventory {--month=} {--year=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate monthly inventory report and save to storage/reports';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $month = $this->option('month') ?: Carbon::now()->month;
        $year = $this->option('year') ?: Carbon::now()->year;
        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end = (clone $start)->endOfMonth();

        $productsCount = Product::count();
        $suppliersCount = Supplier::count();
        $totalQuantity = Product::sum('quantity');
        $totalValue = Product::select(DB::raw('SUM(quantity * price) as total'))->value('total') ?: 0;

        $stockIns = DB::table('stock_ins')
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->select(DB::raw('SUM(quantity) as total_in'))->value('total_in') ?: 0;

        $stockOuts = DB::table('stock_outs')
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->select(DB::raw('SUM(quantity) as total_out'))->value('total_out') ?: 0;

        $lines = [];
        $lines[] = "# Inventory Report for {$start->format('F Y')}";
        $lines[] = "";
        $lines[] = "- Generated at: " . Carbon::now()->toDateTimeString();
        $lines[] = "";
        $lines[] = "- Products count: {$productsCount}";
        $lines[] = "- Suppliers count: {$suppliersCount}";
        $lines[] = "- Total quantity on hand: {$totalQuantity}";
        $lines[] = "- Total inventory value: " . number_format($totalValue, 2);
        $lines[] = "- Stock In (this month): {$stockIns}";
        $lines[] = "- Stock Out (this month): {$stockOuts}";
        $lines[] = "";
        $lines[] = "## Top 10 Products by Quantity";
        $lines[] = "";

        $topProducts = Product::orderBy('quantity', 'desc')->limit(10)->get();
        foreach ($topProducts as $p) {
            $lines[] = "- {$p->name} (ID: {$p->product_id}) — Qty: {$p->quantity} — Price: " . number_format($p->price, 2);
        }

        $dir = storage_path('reports');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $filename = $dir . DIRECTORY_SEPARATOR . "inventory-report-{$year}-" . str_pad($month, 2, '0', STR_PAD_LEFT) . ".md";
        file_put_contents($filename, implode(PHP_EOL, $lines));

        $this->info("Report saved to {$filename}");

        return 0;
    }
}
