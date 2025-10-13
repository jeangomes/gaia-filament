<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Widgets\ChartWidget\Concerns\HasFiltersSchema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PurchasesMadeChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'purchasesMadeChart';
    protected static ?int $sort = 1;

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Compras realizadas';

    use HasFiltersSchema;

    public function filtersSchema(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('year')->numeric()
                ->default('2025'),
        ]);
    }

    /**
     * Use this method to update the chart options when the filter form is submitted.
     */
    public function updatedInteractsWithSchemas(string $statePath): void
    {
        $this->updateOptions();
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $year = $this->filters['year'];

        $comprasPorMes = DB::table('purchases')
            ->selectRaw("EXTRACT(MONTH FROM purchased_at) as mes, COUNT(*) as total")
            ->whereYear('purchased_at', (int)$year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $dadosFormatados = $comprasPorMes->map(function ($item) { //dd($item->mes);
            return [
                'mes' => Carbon::create()->month((int)$item->mes)->translatedFormat('F'),
                'total' => $item->total,
            ];
        });

        $meses = $dadosFormatados->pluck('mes')->toArray();
        $quantidades = $dadosFormatados->pluck('total')->toArray();

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Realizadas',
                    'data' => $quantidades,//[7, 10, 13, 15, 18],
                ],
            ],
            'xaxis' => [
                'categories' => $meses,//['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => true,
                ],
            ],
        ];
    }
}
