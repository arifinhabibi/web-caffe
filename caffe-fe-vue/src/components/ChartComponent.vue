<template>
    <canvas id="myChart" class="p-4"></canvas>
</template>


<script>
import Chart from 'chart.js/auto';

export default {
    name: 'ChartComponent',
    mounted() {
        const ctx = document.getElementById('myChart').getContext('2d');

        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Laporan Perminggu',
                    data: [12, 19, 3, 5, 2, 3],
                    
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        myChart
    },
}
</script>