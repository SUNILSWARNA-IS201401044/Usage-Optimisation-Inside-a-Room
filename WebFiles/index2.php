
<!doctype html>
<html>
<head>
<!--<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="viewport" content="width=device-width, initial-scale=1">
	-->
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="jQuery-plugin-progressbar.css">
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="jQuery-plugin-progressbar.js"></script>
   <title>FusionCharts XT - Column 2D Chart - Data from a database</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css" />

        <!-- You need to include the following JS file to render the chart.
        When you make your own charts, make sure that the path to this JS file is correct.
        Else, you will get JavaScript errors. -->

        <script src="fusioncharts.js"></script>

</head>
<body>


<?php
$conn=new mysqli('localhost','root','lion123','test');
$result=$conn->query("select * from temperature");
$result1=$conn->query("select * from appliance");
$result2=$conn->query("select * from Tags_ID");
if($result->num_rows>0)
{
	while($row=$result->fetch_assoc())
	{
		//echo $row['TIME'] . '<br>';
		$r=$row['TIME'];
		$r1=$row['DATA'];
	}
	echo " The final one in the array is TIME: $r and  temperature :$r1 ". '<br>';
	
}
if($result1->num_rows>0){
while($row=$result1->fetch_assoc())
{
	if($row['FLAG']==1)
		echo "<h2>Appliance".$row['APPLI']." Status is ON</h2>";
		
	else
		echo "<h2>Appliance".$row['APPLI']." Status is OFF</h2>";
}
}
if($result2->num_rows>0){
$sum=0;
while($row=$result2->fetch_assoc()){
echo "Persons with ID ".$row['ID']." are in Number ".$row['count']. '<br>';
$sum=$sum+$row['count'];
}
echo "Total No. of people present in the room ".$sum. '<br>';
}
?>
<!--
<div id="jquery-script-menu">
<div class="jquery-script-center">
<ul>
<!
<li><a href="http://www.jqueryscript.net/loading/Dynamic-Circular-Progress-Bar-with-jQuery-CSS3.html">Download This Plugin</a></li>
<li><a href="http://www.jqueryscript.net/">Back To jQueryScript.Net</a></li>
</ul>
<!<div class="jquery-script-ads"><script type="text/javascript"><!
//google_ad_client = "ca-pub-2783044520727903";
/* jQuery_demo */
//google_ad_slot = "2780937993";
//google_ad_width = 728;
//google_ad_height = 90;
//
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
<div class="jquery-script-clear"></div>
</div>
</div>
-->
	<!--<div class="progress-bar position"></div>
	<div class="progress-bar position" data-percent="100" data-duration="1000" data-color="#ccc,yellow"></div>-->
	<div class="progress-bar position" data-percent="<?php echo"$r1"; ?>" data-color="#a456b1,#12b321"></div>
	<input type="hidden" value="">
	<script>
		$(".progress-bar").loading();
		$('input').on('click', function () {
			 $(".progress-bar").loading();
		});
	</script>
  <!--  <script type="text/javascript">

 // var _gaq = _gaq || [];
  //_gaq.push(['_setAccount', 'UA-36251023-1']);
  //_gaq.push(['_setDomainName', 'jqueryscript.net']);
 // _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>-->
<?php

/* Include the `fusioncharts.php` file that contains functions	to embed the charts. */

   include("fusioncharts.php");

/* The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

   $hostdb = "localhost";  // MySQl host
   $userdb = "root";  // MySQL username
   $passdb = "lion123";  // MySQL password
   $namedb = "test";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }
?>


   <head>
  	<title>FusionCharts XT - Column 2D Chart - Data from a database</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css" />

  	<!-- You need to include the following JS file to render the chart.
  	When you make your own charts, make sure that the path to this JS file is correct.
  	Else, you will get JavaScript errors. -->

  	<script src="fusioncharts.js"></script>
  </head>

  
  	<?php

     	// Form the SQL query that returns the top 10 most populous countries
     	$strQuery = "SELECT * FROM temperature ORDER BY TIME DESC LIMIT 10";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
        	    "chart" => array(
                  "caption" => "TEMPERARTURE READING",
                  "paletteColors" => "#0075c2",
                  "bgColor" => "#ffffff",
                  "borderAlpha"=> "20",
                  "canvasBorderAlpha"=> "0",
                  "usePlotGradientColor"=> "0",
                  "plotBorderAlpha"=> "10",
                  "showXAxisLine"=> "1",
                  "xAxisLineColor" => "#999999",
                  "showValues" => "0",
                  "divlineColor" => "#999999",
                  "divLineIsDashed" => "1",
                  "showAlternateHGridColor" => "0"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array
        	while($row = mysqli_fetch_array($result)) {
           
           	array_push($arrData["data"], array(
              	"label" => $row["TIME"],
              	"value" => $row["DATA"]
              	)
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	}

  	?>

  	<div id="chart-1"><!-- Fusion Charts will render here--></div>

   </body>

</html>
