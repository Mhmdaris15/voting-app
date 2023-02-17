<div class="w-[60em] h-screen m-auto my-10">
    <h1 id="countdown" class="block text-6xl text-center text-transparent bg-clip-text bg-gradient-to-r to-red-600 from-orange-400 font-extrabold">10</h1>
    <button type="button" id="chart-button" class="inline-block mx-auto text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Start Countdown</button>
    <canvas id="myChart"></canvas>
</div>

@push('scripts')
    <script src="{{ asset('js/jquery-3.6.3.slim.min.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/chartjs-plugin-datalabels.js') }}"></script>

    <script type="text/javascript">
        // import ChartDataLabels from 'chartjs-plugin-datalabels';
        // import {Chart} from 'chart.js';

        let candidate_names = @json($candidate_names);
        // generate n_candidate_voters random colors
        let n_candidate_voters = @json($n_candidate_voters); // The number of Voters each candidate has
        let n_candidate_voters_length = n_candidate_voters.length - 1;
        let candidate_colors = [];
        for (let i = 0; i < n_candidate_voters_length; i++) {
            candidate_colors.push('#' + Math.floor(Math.random() * 16777215).toString(16));
        }
        candidate_colors.push('#808080');
        const data = {
            labels: candidate_names,
            datasets: [{
                label: 'Voters',
                data: n_candidate_voters,
                backgroundColor: candidate_colors,
                hoverOffset: 4
            }]
        };
        const config = {
            type: 'doughnut',
            data: data,
            options : {
                tooltips: {
                    enabled: true,
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Voters per Candidate'
                    },
                    datalabels : {
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value*100 / sum).toFixed(2)+"%";
                            return ['Count : ' + value, 'Percentage : ' + percentage];
                        },
                        color: '#fff',
                        font: {
                            weight: 'bold',
                        }
                    }
                }
            },
            plugins: [ChartDataLabels],
        };
        $(document).ready(function() {
            // Hide Chart for the first time
            $('#myChart').hide();
            $('#chart-button').click(function() {
                // if (config.type === 'doughnut') {
                //     config.type = 'pie';
                // } else {
                //     config.type = 'doughnut';
                // }
                $('#countdown').text(10);
                let count = parseInt($('#countdown').text());
                
                // Set Timeout for 10 seconds, and show the chart after 10 seconds

                let timer = setInterval(function() {
                    count--;
                    $('#countdown').text(count);
                    if (count == 0) {
                        clearInterval(timer);
                        $('#chart-button').hide(); // Hide Button
                        $('#countdown').text('Winner is ' + candidate_names[n_candidate_voters.indexOf(Math.max(...n_candidate_voters))] + ' with ' + Math.max(...n_candidate_voters) + ' votes');
                        // Change h-screen to h-auto
                        $('.w-[60em]').removeClass('h-screen').addClass('h-auto');
                        $('#myChart').show(); // Show Chart
                    }
                }, 1000);

            });
            
        });
        const myChart = new Chart(
            document.getElementById('myChart'),
            config,
        );
    </script>
@endpush
