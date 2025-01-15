<?php

namespace App\Http\Controllers;

use App\Models\Almacen_AdminModel;
use App\Models\Ingenieria_AdminModel;
use App\Models\Oficina_AdminModel;
use Illuminate\Http\Request;
use App\Models\Herramienta;
//use PDF;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function generatePDF()
    {
        $datos = Herramienta::all();

        // Contar las herramientas disponibles y ocupadas
        $disponibles = Herramienta::where('disponibilidad', 'Disponible')->count();
        $ocupadas = Herramienta::where('disponibilidad', 'Ocupado')->count();

        // Configurar los datos para el gráfico
        $chartData = [
            'labels' => ['Disponibles', 'Ocupadas'],
            'datasets' => [
                [
                    'label' => 'Numero De Herramientas Disponibles Y Ocupadas',
                    'data' => [$disponibles, $ocupadas],
                    'backgroundColor' => ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    'borderColor' => ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    'borderWidth' => 1
                ]
            ]
        ];

        // Configuración del gráfico para QuickChart
        $chartConfig = [
            'type' => 'bar', // Gráfico de barras para representar proporciones
            'data' => $chartData,
            'options' => [
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                                'precision' => 0 // Para mostrar números enteros
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // Convertir la configuración del gráfico a JSON
        $chartConfigJson = json_encode($chartConfig);

        // Generar la URL para obtener el gráfico desde QuickChart
        $chartUrl = 'https://quickchart.io/chart?c=' . urlencode($chartConfigJson);

        // Obtener la imagen del gráfico en formato Base64
        $chartImage = $this->getChartImage($chartUrl);

        $pdf = PDF::loadView('report', compact('datos','chartImage'));

        return $pdf->download('reporte de almacen de paileria.pdf');
    }
    protected function getChartImage($chartUrl)
    {
        // Obtener la imagen del gráfico desde QuickChart
        $imageData = file_get_contents($chartUrl);

        // Codificar la imagen en Base64
        return 'data:image/png;base64,' . base64_encode($imageData);
    }

    public function generarPDF()
    {
        $datos = Oficina_AdminModel::all();
        // Contar las herramientas disponibles y ocupadas
        $disponibles = Oficina_AdminModel::where('disponibilidad', 'Disponible')->count();
        $ocupadas = Oficina_AdminModel::where('disponibilidad', 'Ocupado')->count();

        // Configurar los datos para el gráfico
        $chartData = [
            'labels' => ['Disponibles', 'Ocupadas'],
            'datasets' => [
                [
                    'label' => 'Numero De Herramientas Disponibles Y Ocupadas',
                    'data' => [$disponibles, $ocupadas],
                    'backgroundColor' => ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    'borderColor' => ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    'borderWidth' => 1
                ]
            ]
        ];

        // Configuración del gráfico para QuickChart
        $chartConfig = [
            'type' => 'bar', // Gráfico de barras para representar proporciones
            'data' => $chartData,
            'options' => [
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                                'precision' => 0 // Para mostrar números enteros
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // Convertir la configuración del gráfico a JSON
        $chartConfigJson = json_encode($chartConfig);

        // Generar la URL para obtener el gráfico desde QuickChart
        $chartUrl = 'https://quickchart.io/chart?c=' . urlencode($chartConfigJson);

        // Obtener la imagen del gráfico en formato Base64
        $chartImage = $this->getChartImage($chartUrl);

        $pdf = PDF::loadView('report', compact('datos','chartImage'));

        return $pdf->download('reporte de almacen de Oficina.pdf');
    }

    public function InfomePDF()
    {
        $datos = Ingenieria_AdminModel::all();
        
         // Contar las herramientas disponibles y ocupadas
         $disponibles = Ingenieria_AdminModel::where('disponibilidad', 'Disponible')->count();
         $ocupadas = Ingenieria_AdminModel::where('disponibilidad', 'Ocupado')->count();
 
         // Configurar los datos para el gráfico
         $chartData = [
             'labels' => ['Disponibles', 'Ocupadas'],
             'datasets' => [
                 [
                     'label' => 'Numero De Herramientas Disponibles Y Ocupadas',
                     'data' => [$disponibles, $ocupadas],
                     'backgroundColor' => ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                     'borderColor' => ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                     'borderWidth' => 1
                 ]
             ]
         ];
 
         // Configuración del gráfico para QuickChart
         $chartConfig = [
             'type' => 'bar', // Gráfico de barras para representar proporciones
             'data' => $chartData,
             'options' => [
                 'scales' => [
                     'yAxes' => [
                         [
                             'ticks' => [
                                 'beginAtZero' => true,
                                 'precision' => 0 // Para mostrar números enteros
                             ]
                         ]
                     ]
                 ]
             ]
         ];
 
         // Convertir la configuración del gráfico a JSON
         $chartConfigJson = json_encode($chartConfig);
 
         // Generar la URL para obtener el gráfico desde QuickChart
         $chartUrl = 'https://quickchart.io/chart?c=' . urlencode($chartConfigJson);
 
         // Obtener la imagen del gráfico en formato Base64
         $chartImage = $this->getChartImage($chartUrl);
 
        $pdf = PDF::loadView('report', compact('datos','chartImage'));

        return $pdf->download('reporte de almacen de Ingenieria.pdf');
    }

    public function infoPDF()
    {
        $datos = Almacen_AdminModel::all();

                // Contar las herramientas disponibles y ocupadas
                $disponibles = Almacen_AdminModel::where('disponibilidad', 'Disponible')->count();
                $ocupadas = Almacen_AdminModel::where('disponibilidad', 'Ocupado')->count();
        
                // Configurar los datos para el gráfico
                $chartData = [
                    'labels' => ['Disponibles', 'Ocupadas'],
                    'datasets' => [
                        [
                            'label' => 'Numero De Herramientas Disponibles Y Ocupadas',
                            'data' => [$disponibles, $ocupadas],
                            'backgroundColor' => ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                            'borderColor' => ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                            'borderWidth' => 1
                        ]
                    ]
                ];
        
                // Configuración del gráfico para QuickChart
                $chartConfig = [
                    'type' => 'bar', // Gráfico de barras para representar proporciones
                    'data' => $chartData,
                    'options' => [
                        'scales' => [
                            'yAxes' => [
                                [
                                    'ticks' => [
                                        'beginAtZero' => true,
                                        'precision' => 0 // Para mostrar números enteros
                                    ]
                                ]
                            ]
                        ]
                    ]
                ];
        
                // Convertir la configuración del gráfico a JSON
                $chartConfigJson = json_encode($chartConfig);
        
                // Generar la URL para obtener el gráfico desde QuickChart
                $chartUrl = 'https://quickchart.io/chart?c=' . urlencode($chartConfigJson);
        
                // Obtener la imagen del gráfico en formato Base64
                $chartImage = $this->getChartImage($chartUrl);

        $pdf = PDF::loadView('report', compact('datos','chartImage'));

        return $pdf->download('reporte de Almacen.pdf');
    }
}
