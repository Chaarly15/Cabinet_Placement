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
                            <div class="col-md-6">
                                <canvas id="stagesParNiveauChart"></canvas>
                            </div>
                            <div class="col-md-6">
                                <canvas id="stagesParEntrepriseChart"></canvas>
                            </div>

                            <div class="col-md-6">
                                <h3>Modifier les données du graphique</h3>
                                <form id="updateChartForm">
                                    @csrf
                                    @foreach($stagesParNiveau as $stage)
                                        <div class="form-group">
                                            <label for="niveau_{{ $stage->niveau }}">Niveau {{ $stage->niveau }}</label>
                                            <input type="number" class="form-control" name="data[]" id="niveau_{{ $stage->niveau }}" value="{{ $stage->count }}">
                                            <input type="hidden" name="labels[]" value="Niveau {{ $stage->niveau }}">
                                        </div>
                                    @endforeach
                                    <button type="button" class="btn btn-primary" id="updateChartButton">Mettre à jour</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var ctx1 = document.getElementById('stagesChart').getContext('2d');
                            var stagesChart = new Chart(ctx1, {
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

                            var ctx3 = document.getElementById('stagesParNiveauChart').getContext('2d');
                            var stagesParNiveauChart = new Chart(ctx3, {
                                type: 'bar',
                                data: {
                                    labels: @json($stagesParNiveau->pluck('niveau')->map(fn($niveau) => 'Niveau ' . $niveau)),
                                    datasets: [{
                                        label: 'Nombre de Stages',
                                        data: @json($stagesParNiveau->pluck('count')),
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Niveau de Formation'
                                            }
                                        },
                                        y: {
                                            title: {
                                                display: true,
                                                text: 'Nombre de Stages'
                                            },
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });

                            document.getElementById('updateChartButton').addEventListener('click', function () {
                                var formData = new FormData(document.getElementById('updateChartForm'));

                                fetch('{{ route('dashboard.updateChart') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    stagesParNiveauChart.data.labels = data.labels;
                                    stagesParNiveauChart.data.datasets[0].data = data.data;
                                    stagesParNiveauChart.update();
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
