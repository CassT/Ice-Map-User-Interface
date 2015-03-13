<html>
  <head>
    <title>Map</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="d3/d3.v3.js"></script>
    <?php
	//using layer name, construct and call query for zone/geometry info
	$layer = $_POST['layer'];
	$base_url = 'http://qa.sigrid.apps.int.nsidc.org:8890/sparql';
	$def_graph = 'http://purl.org/ssiii/layers';
	$prefix = urlencode("prefix sio: <http://semanticscience.org/resource/> prefix geo: <http://www.opengis.net/ont/OGC-GeoSPARQL/1.0/> ");
	$query = urlencode("SELECT ?Zone ?Geometry WHERE {?Zone sio:is-member-of <http://purl.org/ssiii/layers/{$layer}> . ?Zone geo:hasGeometry ?GEO . ?GEO geo:asGML ?Geometry}");
	$url = "{$base_url}?default-graph-uri={$def_graph}&query={$prefix}{$query}&format=json";
	$data = file_get_contents($url);
	//print $data;
	$gml_start = '"<gml:Polygon srsName=\"EPSG:4326\">';
	$gml_end   = '</gml:Polygon>"';

	$outer_start = "<gml:outerBoundaryIs><gml:LinearRing><gml:coordinates>";
	$outer_end   = "</gml:coordinates></gml:LinearRing></gml:outerBoundaryIs>";

	$inner_start = "<gml:innerBoundaryIs><gml:LinearRing><gml:coordinates>";
	$inner_end   = "</gml:coordinates></gml:LinearRing></gml:innerBoundaryIs>";

	$search = array (
	        $gml_start,
	        $gml_end,
	        $outer_start,
	        $outer_end,
	        $inner_start,
	        $inner_end
	);
	$replace = array (
        	'[',
        	']',
        	'[[',
        	']]',
        	',[[',
        	']]'
	);
	$newData = str_replace($search,$replace,$data);

	//print $newData;

	//Then replace ' ' in coordinates with '],[' for svg-readable formatting
	$val_start = '"http://www.opengis.net/def/dataType/OGC-GML/3.0/GMLLiteral", "value": ';
	$val_end = "}}";

	$lastPos = 0;

	$positions = array();
	while (($lastPos = strpos($newData, $val_start, $lastPos))!== false) {
	    $positions[] = $lastPos;
	    $lastPos = $lastPos + strlen($val_start);
	}
	$newNewData = "";
	$end_pos = 0;
	$round = 0;
	foreach($positions as $value) {
        	$other_json = substr($newData,$end_pos,$value-$end_pos+strlen($val_start));
        	$end_pos = strpos($newData, $val_end, $value);
        	$data_length = $end_pos - $value - strlen($val_start);
        	$this_data = substr($newData,$value+strlen($val_start),$data_length);
        	$numbers = substr($this_data,1,strpos($this_data,'"',1)-1);
        	$numbers = str_replace(" ","],[",$numbers);
        	$newNewData = "{$newNewData}{$other_json}[{$numbers}";
	}

	$newNewData = "{$newNewData} }} ] } }";

    ?>
  </head>
  <body>
	<script type="text/javascript">
		<?php echo "var data =  {$newNewData};"; ?>
		var Results = data.results.bindings;
		//document.write(JSON.stringify(Results[0].Geometry.value));
		var geoJSONData = { "type":"FeatureCollection",
				"features":[] };
		for(var i=0; i < Results.length; i++ ){
		  geoJSONData.features.push( {
		    "type":"Feature",
		    "geometry": { 
		      "type":"Polygon"
		       // if(Results[i].Geometry.value.length > 1){return "Polygon";}
		       // else {return "MultiPolygon";}
		      ,
		      "coordinates": Results[i].Geometry.value
		    },
		    "properties": {
		      "Zone": Results[i].Zone.value
		    }		
		  });
//		  if(Results[i].Geometry.value.length > 1){geoJSONData.features[i].geometry.type = "MultiPolygon";}
		}
//		document.write(JSON.stringify(geoJSONData));
		var w = 960;
		var h = 480;
//		var projection = d3.geo.transverseMercator()
//			.translate(w/2,h/2)
//			.rotate([0,0,50])
//			.center([-60,60])
//			.scale([100]);
		var projection = d3.geo.equirectangular()
    			.scale([1000])
			.center([-60,50])
    			.translate([w / 2, h / 2])
    			.precision(.01);

		var path = d3.geo.path().projection(projection);

		var svg = d3.select("body")
				.append("svg")
				.attr("width",w)
				.attr("height",h);


//		svg.append("path")
//		    .datum(geoJSONData)
//		    .attr("id","theSVGdrawedupStuff")
//		    .attr("d", d3.geo.path())
//		    .attr("stroke","black")
//		    .attr("stroke-width",1)
//		    .attr("fill","red")
//		    .attr("transform","scale(3) translate(-800,0)");

//		svg.append("use")
//			.attr("xlink:href","#theSVGdrawedupStuff")
//			.attr("transform","translate()");

		svg.selectAll("path")
			.data(geoJSONData.features).enter()
			.append("path")
			.attr("d",path)
		//	.style("stroke","black")
		//	.style("stroke-width",1)
			.style("fill","steelblue");
		

	</script>
  </body>
</html>
