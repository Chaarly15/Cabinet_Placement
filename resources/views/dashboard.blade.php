<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Vous êtes connecté !") }}

                    <div class="container">
                        <h1>{{ __('Tableau de Bord') }}</h1>

                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="stagesChart"></canvas>
                            </div>
                            <div class="col-md-6">
                                <canvas id="evolutionChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Inclure Chart.js -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Graphique des stages obtenus par le cabinet vs sans le cabinet
                            var ctx = document.getElementById('stagesChart').getContext('2d');
                            var stagesChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['Par le Cabinet', 'Sans le Cabinet'],
                                    datasets: [{
                                        label: 'Nombre de Stages',
                                        data: [{{ $stagesParCabinet }}, {{ $stagesSansCabinet }}],
                                        backgroundColor: ['#4CAF50', '#FF6384'],
                                    }]
                                },
                                options: {
                                    responsive: true,
                                }
                            });

                            // Graphique de l'évolution des stages par année
                            var ctx2 = document.getElementById('evolutionChart').getContext('2d');
                            var evolutionChart = new Chart(ctx2, {
                                type: 'line',
                                data: {
                                    labels: {!! json_encode($stagesParAnnee->pluck('year')) !!},
                                    datasets: [{
                                        label: 'Nombre de Stages',
                                        data: {!! json_encode($stagesParAnnee->pluck('count')) !!},
                                        borderColor: '#42A5F5',
                                        fill: false,
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Année'
                                            }
                                        },
                                        y: {
                                            title: {
                                                display: true,
                                                text: 'Nombre de Stages'
                                            }
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
