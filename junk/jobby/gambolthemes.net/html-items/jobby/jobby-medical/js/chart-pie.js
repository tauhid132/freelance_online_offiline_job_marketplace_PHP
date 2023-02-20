$(function(){
    Chart.defaults.global.defaultFontFamily = "Roboto";
	
	// Pie Chart
	
	var ctx = document.getElementById('pieChart').getContext('2d');
	var pieChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: ['Members', 'Posted Jobs', 'Appointments', 'Favourite Jobs'],
			datasets: [{
				label: '# of Votes',
				data: [15, 20, 30, 25],
				backgroundColor: [
					'#496e9a',
					'#49d086',
					'#54a6d6',
					'#efa80f'
				],
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			legend: {
				display: false
			}
		}
	});
	
});