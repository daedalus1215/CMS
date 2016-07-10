  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    
    <!-- WYSIWYG -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Google Charts-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script src="js/scripts.js"></script>
    
    <!-- Google Charts-->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      
      function drawChart() {

        var data = google.visualization.arrayToDataTable([   
          ['TASKS', 'HOURS'],
          ['Views',       <?php echo $session->count; ?>],
          ['Photos',      <?php echo Photo::count_all(); ?>],
          ['Users',       <?php echo User::count_all(); ?>],
          ['Comments',    <?php echo Comment::count_all(); ?>],
        ]);

        var options = {
          title:            'Site Stats',
          pieSliceText:     'label',
          legend:           'none',
          backgroundColor:  'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    
    
    
</body>

</html>
