<div class="w-[40em] h-auto m-auto my-10">
    <canvas id="myChart"></canvas>
</div>

@push('scripts')
    <script src="{{ asset('js/jquery-3.6.3.slim.min.js') }}" ></script>
    <script src="{{ asset('js/chart.js') }}" ></script>
    <script type="text/javascript">
        const candidate_names = @json($candidate_names);
        // generate n_candidate_voters random colors
        const n_candidate_voters = @json($n_candidate_voters);
        const n_candidate_voters_length = n_candidate_voters.length;
        const candidate_colors = [];
        for (let i = 0; i < n_candidate_voters_length; i++) {
            candidate_colors.push('#' + Math.floor(Math.random() * 16777215).toString(16));
        }
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
                            return percentage;
                        },
                        color: '#fff',
                    }
                }
            },
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endpush
