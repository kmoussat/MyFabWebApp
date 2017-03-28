  <!-- jQuery -->

    <script src="js/jquery.js"></script>



    <!-- Bootstrap Core JavaScript -->

    <script src="js/bootstrap.min.js"></script>



    <!-- Morris Charts JavaScript -->

    <script src="js/plugins/morris/raphael.min.js"></script>

    <script src="js/plugins/morris/morris.min.js"></script>

    <script src="js/plugins/morris/morris-data.js"></script>

	

	 <!-- Flot Charts JavaScript -->

    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->

    <script src="js/plugins/flot/jquery.flot.js"></script>

    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>

    <script src="js/plugins/flot/jquery.flot.resize.js"></script>

    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    <script src="js/plugins/flot/flot-data.js"></script>

    <!-- Chart.js scripts 
		- nombre de projets en cours : $graph1['nbProj']
                                        - nombre de projets finis : $graph2['nbProjDone']
                                        - Pourcentage de projets réalisés (calcul direct)
                                        - graph temporel des départ de projets avec pourcentage
    -->
    <script>
        
//1 ->  graphique 1 colonne gauche haut [FONCTIONNE SAUF CAS NULL]
        var graph1_p = document.getElementById('graph1_p').getContext('2d');
        var projE = <?php echo $graph1['nbProj'] ?> ;
        var projF = <?php echo $graph2['nbProjDone'] ?> ;

        var Graph1_p = new Chart('graph1_p', {
            type: 'pie',
            data: {
            	label: 'Répartition des projets',
                labels: ["Projets en cours", "Projets fini"],
                datasets: [{
                    backgroundColor: [
                        "#2ecc71",
                        "#3498db"
                    ],
                    data: [projE, projF]
                }]
            }
        });

//2 ->  graphique 2 en barres
		
		var graph2_p = document.getElementById("graph2_p").getContext('2d');
		var Graph2_p = new Chart(graph2_p, {
  			type: 'bar',
  			data: {
    			labels: ["2017-02-23", "2017-03-01", "2017-03-02", "2017-03-07", "2017-03-16"], //remplacer par tableau de dates
    			datasets: [{
    	  			label: 'Projets',
    	  			backgroundColor: 'rgba(255, 99, 132, 0.7)',
	      			data: [25,25,50,75,25]
    			}],
    			xAxisID: 'Etat d\'avancement',
    			yAxisID: 'Date de création'
  			}
		});

//3 -> Graphique radar
		/*
		var graph3_p = document.getElementById("graph3_p").getContext('2d');
		var Graph3_p = new Chart(graph3_p, {
    		type: 'radar',
    		data: graph3_p_data
		});
		var graph3_p_data = {
    		labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
    		datasets: [
        	{
            	label: "My First dataset",
            	backgroundColor: "rgba(179,181,198,0.2)",
            	borderColor: "rgba(179,181,198,1)",
            	pointBackgroundColor: "rgba(179,181,198,1)",
            	pointBorderColor: "#fff",
            	pointHoverBackgroundColor: "#fff",
            	pointHoverBorderColor: "rgba(179,181,198,1)",
            	data: [65, 59, 90, 81, 56, 55, 40]
        	},
        	{
	            label: "My Second dataset",
    	        backgroundColor: "rgba(255,99,132,0.2)",
        	    borderColor: "rgba(255,99,132,1)",
            	pointBackgroundColor: "rgba(255,99,132,1)",
	            pointBorderColor: "#fff",
            	pointHoverBackgroundColor: "#fff",
            	pointHoverBorderColor: "rgba(255,99,132,1)",
            	data: [28, 48, 40, 19, 96, 27, 100]
        	}
    		]
		};		
		*/

    </script>



</body>



</html>