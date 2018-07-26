$(document).ready(function(){
	$.ajax({
		url: 'http://localhost/multilanguage/data.php',
	     //url: <?php echo site_url('admin/raporlar/data.php');   ?>
		method: 'GET',
		success: function(data) {
			console.log(data);
			var player = [];
			var score = [];
			var mac=[];

			for(var i in data) {
				player.push("Player " + data[i].playerid);
				
				score.push(data[i].score);

				mac.push(data[i].mac);
				
			}

			var chartdata = {
				labels: player,
				datasets : [
					{
						label: 'Score',
						backgroundColor: 'rgba(100, 150, 0, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
						
					},
					{
						label: 'Maç',
						backgroundColor: 'rgba(200, 150, 0, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: mac
						
					}
				]
			};

			var ctx = $('#mycanvas');

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});