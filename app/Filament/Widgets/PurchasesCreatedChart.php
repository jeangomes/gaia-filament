<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Widgets\ChartWidget\Concerns\HasFiltersSchema;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class PurchasesCreatedChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'purchasesCreatedChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Compras cadastradas';

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
            ->selectRaw("EXTRACT(MONTH FROM created_at) as mes, COUNT(*) as total")
            ->whereYear('created_at', (int)$year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $dadosFormatados = $comprasPorMes->map(function ($item) {
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
                    'name' => 'Cadastradas',
                    'data' => $quantidades,
                ],
            ],
            'xaxis' => [
                'categories' => $meses,
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
