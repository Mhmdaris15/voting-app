<div class="w-full flex flex-col justify-start items-center h-auto m-auto my-10">
    <form action="{{ url('dashboard') }}" method="post">
        @csrf
        <input type="hidden" name="tab-choosen" value="statistics">
        <input type="date" name="showing-time" id="showing-time" class="bg-gray-600 rounded-xl text-gray-50 hover:bg-gray-700 py-3 px-5" required>
        <input type="time" name="detail-time" id="detail-time" class="bg-gray-600 rounded-xl text-gray-50 hover:bg-gray-700 py-3 px-5" required>
  
        <button type="submit" class="inline-block text-red-700 hover:text-white border border-red-700 bg-red-200 transition-all ease-in-out hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-800">Set End Time</button>    
    </form>
    <div class="relative countdown-timer flex gap-x-10 justify-evenly items-center w-2/3 h-36 text-gray-50 font-extrabold bg-gradient-to-bl from-blue-700 via-blue-800 to-gray-900 rounded-3xl">
        
        <div class="absolute top-1 font-normal text-xs">End Time : {{ $time['deadline'] }} {{ $time['started'] }}</div>
        <div class="text-2xl text-center">The voting will be end in </div>
        <p id="days" class="text-2xl text-center">10 Days</p>
        <p id="hours" class="text-2xl text-center">5 Hours</p>
        <p id="minutes" class="text-2xl text-center">12 Minutes</p>
        <p id="seconds" class="text-2xl text-center text-red-500">0 Seconds</p>
    </div>
    <button type="button" id="chart-button" class="inline-block text-blue-700 bg-blue-200 transition-all ease-in-out hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800 disabled:bg-slate-200 disabled:hover:bg-slate-200 disabled:text-blue-400" disabled>Start Countdown</button>
    <h1 id="countdown" class="block text-3xl mt-5 text-center text-transparent bg-clip-text bg-gradient-to-r to-red-600 from-orange-400 font-bold">Statistics will appear after voting time ends</h1>
    {{-- <form action="{{ url('dashboard') }}/{{ $time['id'] }}" method="post">
        @method('PUT')
        @csrf
        <input type="hidden" name="time_id" value="{{ $time['id'] }}">
        <button type="submit" class="inline-block text-blue-700 bg-blue-200 transition-all ease-in-out hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800 disabled:bg-slate-200 disabled:hover:bg-slate-200 disabled:text-blue-400" >IS CLICKED TRUE</button>
    </form> --}}
    <canvas class="" id="myChart"></canvas>
    
</div>

@push('scripts')
    <script src="{{ asset('js/jquery-3.6.3.slim.min.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/chartjs-plugin-datalabels.js') }}"></script>

    <script type="text/javascript">
        // import Datepicker from 'flowbite-datepicker/Datepicker';
     // we ned ending date and current date and we also need to subtract.
        

        // import ChartDataLabels from 'chartjs-plugin-datalabels';
        // import {Chart} from 'chart.js';
        
        let showingTime = @json($time); // declare showingTime variable that contains time variable with string data type from php
        console.log(showingTime);
        // convert is_clicked to boolean
        let isClicked = (showingTime['is_clicked'] == 1) ? true : false;
        console.log(isClicked);

        showingTime = new Date(showingTime['deadline'] + ' ' + showingTime['started']);
        console.log(showingTime);

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

            function formatTime(time) {
                return time < 10 ? `0${time}` : time;
            }

            let daysEl = $('#days');
            let hoursEl = $('#hours');
            let minsEl = $('#minutes');
            let secondsEl = $('#seconds');
            let intervalCountdown = setInterval(countdown, 1000);

            let date = showingTime;

            function countdown() {
                let newDate = new Date(date);
                let currentDate = new Date();

                let difference = Math.floor(newDate - currentDate);

                if (difference <= 0) {
                    difference = 0;
                    $('#chart-button').removeAttr('disabled');
                    $('#chart-button').removeClass('disabled');
                }

                let days = Math.floor(difference / (1000 * 3600 * 24));
                let hours = Math.floor(difference / (1000 * 3600)) % 24;
                let mins = Math.floor(difference / (1000 * 60)) % 60;
                let seconds = Math.floor(difference / 1000) % 60;

                console.log(days, hours, mins, seconds);

                daysEl.html(formatTime(days) + " <p class='text-xs'>Days</p>");
                hoursEl.html(formatTime(hours) + " <p class='text-xs'>Hours</p>");
                minsEl.html(formatTime(mins) + " <p class='text-xs'>Minutes</p>");
                secondsEl.html(formatTime(seconds) + " <p class='text-xs text-gray-50'>Seconds</p>");

                show();

            }

            function show() {
                // var count = $('#seconds').val();
                // count--;
                let da = (daysEl.text());
                let ho = (hoursEl.text());
                let min = (minsEl.text());
                let sec = (secondsEl.text());

                $('#days').text(da);
                $('#hours').text(ho);
                $('#minutes').text(min);
                $('#seconds').text(sec);
                if (min == "00 Minutes" && sec == "00 Seconds") {
                        // clearInterval(timer);
                        // $('#chart-button').hide(); // Hide Button
                        // $('#countdown').text('Winner is ' + candidate_names[n_candidate_voters.indexOf(Math.max(...n_candidate_voters))] + ' with ' + Math.max(...n_candidate_voters) + ' votes');
                        // Change #myChart hidden to show
                        clearInterval(intervalCountdown);
                        $('#chart-button').removeAttr('disabled');

                        // $('#myChart').removeClass('hidden');
                        // $('#myChart').show(); // Show Chart
                    }
            }

            countdown();

            // // Hide Chart for the first time when the page is loaded and show it after 10 seconds
            // console.log(showingTime > new Date());
            // if (isClicked){
            //     $('#myChart').show();
            // } else {
            //     $('#myChart').hide();
            // }
            if (showingTime > new Date()) {
                $('#chart-button').attr('disabled', 'disabled');
                $('#chart-button').addClass('disabled');
                $('#myChart').hide();
            } else {
                $('#countdown').text('Winner is ' + candidate_names[n_candidate_voters.indexOf(Math.max(...n_candidate_voters))] + ' with ' + Math.max(...n_candidate_voters) + ' votes');
                $('#countdown').removeClass('text-3xl');
                $('#countdown').addClass('text-6xl');
                $('#myChart').show();
            }

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
                        // $('h1#countdown') Replace class on h1#countdown
                        $('#countdown').removeClass('text-3xl');
                        $('#countdown').addClass('text-6xl');
                        // Change #myChart hidden to show
                        $('#myChart').removeClass('hidden');
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
