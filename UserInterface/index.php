<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Ice Data</title>
        <script type="text/javascript" src="d3/d3.v3.js"></script>
	<script type="text/javascript" src="SPARQL.js"></script>
    </head>
    <body>
	<h3>Search Sigrid III Ice Data</h3>
	<form>
		<p>Search for zones matching the following properties:</p>
		<select name="region">
			<option value="none">Select Region</option>
			<option value="EastCoast">East Coast</option>
			<option value="EasternArctic">Eastern Arctic</option>
			<option value="GreatLakes">Great Lakes</option>
			<option value="HudsonBay">Hudson Bay</option>
			<option value="WesternArctic">Western Arctic</option>
		</select>
		<select name="totalConc">
			<option value="none">Total Concentration</option>
			<option value="00">Ice Free</option>
			<option value="01">Less than 1/10</option>
			<option value="02">Bergy Water</option>
			<option value="10">1/10</option>
			<option value="20">2/10</option>
			<option value="30">3/10</option>
			<option value="40">4/10</option>
			<option value="50">5/10</option>
			<option value="60">6/10</option>
			<option value="70">7/10</option>
			<option value="80">8/10</option>
			<option value="90">9/10</option>
			<option value="92">10/10</option>
			<option value="13">1/10 to 3/10</option>
			<option value="46">4/10 to 6/10</option>
			<option value="79">7/10 to 9/10</option>
			<option value="91">9/10 to 10/10</option>
		</select>
		<select name="predominantSOD">
			<option value="none">Predominant Stage of Development(Thickness)</option>
			<option value="00">Ice Free</option>
			<option value="81">New Ice</option>
			<option value="82">Nilas, Ice Rind (&lt 10cm)</option>
			<option value="83">Young Ice (1-30cm)</option>
			<option value="84">Grey Ice (10-15cm)</option>
			<option value="85">Grey/White Ice (15-30cm)</option>
			<option value="86">First Year Ice (30-200cm)</option>
			<option value="87">Thin First Year Ice (30-70cm)</option>
			<option value="88">Thin First Year Stage 1 (30-50cm)</option>
			<option value="89">Thin First Year Stage 2 (50-70cm)</option>
			<option value="91">Medium First Year Ice (10-120cm)</option>
			<option value="93">Thick First Year Ice (&gt 120cm)</option>
			<option value="95">Old Ice</option>
			<option value="96">Second Year Ice</option>
			<option value="97">Multi-Year Ice</option>
			<option value="98">Glacier Ice</option>
		</select>
		<select name="secondarySOD">
			<option value="none">Secondary Stage of Development(Thickness)</option>
			<option value="00">Ice Free</option>
			<option value="81">New Ice</option>
			<option value="82">Nilas, Ice Rind (&lt 10cm)</option>
			<option value="83">Young Ice (1-30cm)</option>
			<option value="84">Grey Ice (10-15cm)</option>
			<option value="85">Grey/White Ice (15-30cm)</option>
			<option value="86">First Year Ice (30-200cm)</option>
			<option value="87">Thin First Year Ice (30-70cm)</option>
			<option value="88">Thin First Year Stage 1 (30-50cm)</option>
			<option value="89">Thin First Year Stage 2 (50-70cm)</option>
			<option value="91">Medium First Year Ice (10-120cm)</option>
			<option value="93">Thick First Year Ice (&gt 120cm)</option>
			<option value="95">Old Ice</option>
			<option value="96">Second Year Ice</option>
			<option value="97">Multi-Year Ice</option>
			<option value="98">Glacier Ice</option>
		</select>
		<br>
		Containing Ice:
		<select name="compSOD">
			<option value="none">Stage of Development(Thickness)</option>
			<option value="00">Ice Free</option>
			<option value="81">New Ice</option>
			<option value="82">Nilas, Ice Rind (&lt 10cm)</option>
			<option value="83">Young Ice (1-30cm)</option>
			<option value="84">Grey Ice (10-15cm)</option>
			<option value="85">Grey/White Ice (15-30cm)</option>
			<option value="86">First Year Ice (30-200cm)</option>
			<option value="87">Thin First Year Ice (30-70cm)</option>
			<option value="88">Thin First Year Stage 1 (30-50cm)</option>
			<option value="89">Thin First Year Stage 2 (50-70cm)</option>
			<option value="91">Medium First Year Ice (10-120cm)</option>
			<option value="93">Thick First Year Ice (&gt 120cm)</option>
			<option value="95">Old Ice</option>
			<option value="96">Second Year Ice</option>
			<option value="97">Multi-Year Ice</option>
			<option value="98">Glacier Ice</option>
		</select>
		<select name="compConc">
			<option value="none">Concentration</option>
			<option value="00">Ice Free</option>
			<option value="01">Less than 1/10</option>
			<option value="02">Bergy Water</option>
			<option value="10">1/10</option>
			<option value="20">2/10</option>
			<option value="30">3/10</option>
			<option value="40">4/10</option>
			<option value="50">5/10</option>
			<option value="60">6/10</option>
			<option value="70">7/10</option>
			<option value="80">8/10</option>
			<option value="90">9/10</option>
			<option value="92">10/10</option>
			<option value="13">1/10 to 3/10</option>
			<option value="46">4/10 to 6/10</option>
			<option value="79">7/10 to 9/10</option>
			<option value="91">9/10 to 10/10</option>
		</select>
		<select name="compForm">
			<option value="none">Form</option>
			<option value="00">Pancake Ice (30cm-3m)</option>
			<option value="01">Shuga/Small Ice Cake, Brash Ice (&lt 2m across)</option>
			<option value="02">Ice Cake (&lt 20m across)</option>
			<option value="03">Small Floe (20-100m across)</option>
			<option value="04">Medium Floe (100-500m across)</option>
			<option value="05">Big Floe (500m-2km across)</option>
			<option value="06">Vast Floe (2-10km across)</option>
			<option value="07">Giant Floe (&gt 10km across)</option>
			<option value="08">Fast Ice</option>
			<option value="09">Growlers, Floebergs, or Floebits</option>
			<option value="10">Icebergs</option>
			<option value="11">Strips and Patches (concentrations 1/10)</option>
			<option value="12">Strips and Patches (concentrations 2/10)</option>
			<option value="13">Strips and Patches (concentrations 3/10)</option>
			<option value="14">Strips and Patches (concentrations 4/10)</option>
			<option value="15">Strips and Patches (concentrations 5/10)</option>
			<option value="16">Strips and Patches (concentrations 6/10)</option>
			<option value="17">Strips and Patches (concentrations 7/10)</option>
			<option value="18">Strips and Patches (concentrations 8/10)</option>
			<option value="19">Strips and Patches (concentrations 9/10)</option>
			<option value="20">Strips and Patches (concentrations 10/10)</option>
			<option value="21">Level Ice</option>
		</select>
		<br>
<!--
		2nd Thickest Ice:
		<select name="BSOD">
			<option value="none">Stage of Development(Thickness)</option>
			<option value="00">Ice Free</option>
			<option value="81">New Ice</option>
			<option value="82">Nilas, Ice Rind (&lt 10cm)</option>
			<option value="83">Young Ice (1-30cm)</option>
			<option value="84">Grey Ice (10-15cm)</option>
			<option value="85">Grey/White Ice (15-30cm)</option>
			<option value="86">First Year Ice (30-200cm)</option>
			<option value="87">Thin First Year Ice (30-70cm)</option>
			<option value="88">Thin First Year Stage 1 (30-50cm)</option>
			<option value="89">Thin First Year Stage 2 (50-70cm)</option>
			<option value="91">Medium First Year Ice (10-120cm)</option>
			<option value="93">Thick First Year Ice (&gt 120cm)</option>
			<option value="95">Old Ice</option>
			<option value="96">Second Year Ice</option>
			<option value="97">Multi-Year Ice</option>
			<option value="98">Glacier Ice</option>
		</select>
		<select name="BConc">
			<option value="none">Concentration</option>
			<option value="00">Ice Free</option>
			<option value="01">Less than 1/10</option>
			<option value="02">Bergy Water</option>
			<option value="10">1/10</option>
			<option value="20">2/10</option>
			<option value="30">3/10</option>
			<option value="40">4/10</option>
			<option value="50">5/10</option>
			<option value="60">6/10</option>
			<option value="70">7/10</option>
			<option value="80">8/10</option>
			<option value="90">9/10</option>
			<option value="92">10/10</option>
			<option value="13">1/10 to 3/10</option>
			<option value="46">4/10 to 6/10</option>
			<option value="79">7/10 to 9/10</option>
			<option value="91">9/10 to 10/10</option>
		</select>
		<select name="BForm">
			<option value="none">Form</option>
			<option value="00">Pancake Ice (30cm-3m)</option>
			<option value="01">Shuga/Small Ice Cake, Brash Ice (&lt 2m across)</option>
			<option value="02">Ice Cake (&lt 20m across)</option>
			<option value="03">Small Floe (20-100m across)</option>
			<option value="04">Medium Floe (100-500m across)</option>
			<option value="05">Big Floe (500m-2km across)</option>
			<option value="06">Vast Floe (2-10km across)</option>
			<option value="07">Giant Floe (&gt 10km across)</option>
			<option value="08">Fast Ice</option>
			<option value="09">Growlers, Floebergs, or Floebits</option>
			<option value="10">Icebergs</option>
			<option value="11">Strips and Patches (concentrations 1/10)</option>
			<option value="12">Strips and Patches (concentrations 2/10)</option>
			<option value="13">Strips and Patches (concentrations 3/10)</option>
			<option value="14">Strips and Patches (concentrations 4/10)</option>
			<option value="15">Strips and Patches (concentrations 5/10)</option>
			<option value="16">Strips and Patches (concentrations 6/10)</option>
			<option value="17">Strips and Patches (concentrations 7/10)</option>
			<option value="18">Strips and Patches (concentrations 8/10)</option>
			<option value="19">Strips and Patches (concentrations 9/10)</option>
			<option value="20">Strips and Patches (concentrations 10/10)</option>
			<option value="21">Level Ice</option>
		</select>
		<br>
		3rd Thickest Ice:
		<select name="CSOD">
			<option value="none">Stage of Development(Thickness)</option>
			<option value="00">Ice Free</option>
			<option value="81">New Ice</option>
			<option value="82">Nilas, Ice Rind (&lt 10cm)</option>
			<option value="83">Young Ice (1-30cm)</option>
			<option value="84">Grey Ice (10-15cm)</option>
			<option value="85">Grey/White Ice (15-30cm)</option>
			<option value="86">First Year Ice (30-200cm)</option>
			<option value="87">Thin First Year Ice (30-70cm)</option>
			<option value="88">Thin First Year Stage 1 (30-50cm)</option>
			<option value="89">Thin First Year Stage 2 (50-70cm)</option>
			<option value="91">Medium First Year Ice (10-120cm)</option>
			<option value="93">Thick First Year Ice (&gt 120cm)</option>
			<option value="95">Old Ice</option>
			<option value="96">Second Year Ice</option>
			<option value="97">Multi-Year Ice</option>
			<option value="98">Glacier Ice</option>
		</select>
		<select name="CConc">
			<option value="none">Concentration</option>
			<option value="00">Ice Free</option>
			<option value="01">Less than 1/10</option>
			<option value="02">Bergy Water</option>
			<option value="10">1/10</option>
			<option value="20">2/10</option>
			<option value="30">3/10</option>
			<option value="40">4/10</option>
			<option value="50">5/10</option>
			<option value="60">6/10</option>
			<option value="70">7/10</option>
			<option value="80">8/10</option>
			<option value="90">9/10</option>
			<option value="92">10/10</option>
			<option value="13">1/10 to 3/10</option>
			<option value="46">4/10 to 6/10</option>
			<option value="79">7/10 to 9/10</option>
			<option value="91">9/10 to 10/10</option>
		</select>
		<select name="CForm">
			<option value="none">Form</option>
			<option value="00">Pancake Ice (30cm-3m)</option>
			<option value="01">Shuga/Small Ice Cake, Brash Ice (&lt 2m across)</option>
			<option value="02">Ice Cake (&lt 20m across)</option>
			<option value="03">Small Floe (20-100m across)</option>
			<option value="04">Medium Floe (100-500m across)</option>
			<option value="05">Big Floe (500m-2km across)</option>
			<option value="06">Vast Floe (2-10km across)</option>
			<option value="07">Giant Floe (&gt 10km across)</option>
			<option value="08">Fast Ice</option>
			<option value="09">Growlers, Floebergs, or Floebits</option>
			<option value="10">Icebergs</option>
			<option value="11">Strips and Patches (concentrations 1/10)</option>
			<option value="12">Strips and Patches (concentrations 2/10)</option>
			<option value="13">Strips and Patches (concentrations 3/10)</option>
			<option value="14">Strips and Patches (concentrations 4/10)</option>
			<option value="15">Strips and Patches (concentrations 5/10)</option>
			<option value="16">Strips and Patches (concentrations 6/10)</option>
			<option value="17">Strips and Patches (concentrations 7/10)</option>
			<option value="18">Strips and Patches (concentrations 8/10)</option>
			<option value="19">Strips and Patches (concentrations 9/10)</option>
			<option value="20">Strips and Patches (concentrations 10/10)</option>
			<option value="21">Level Ice</option>
		</select>
		<br>
-->
		<input type="button" name="button" value="Search" onClick="getShapeFiles(this.form)">
		<input type="button" name="debug" value="view query URI" onClick="showSPARQL(this.form)">
	</form>
    </body>
</html>     

<!-- Testing with the following query:
http://virtuoso.dev.int.nsidc.org:8890/sparql?default-graph-uri=http://purl.org/ssiii/layers&query=prefix%20dc%3A%20%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%20prefix%20egg%3A%20%3Chttp%3A%2F%2Fpurl.org%2Fnsidc%2Fjcomm%2Fegg%23%3E%20prefix%20esip%3A%20%3Chttp%3A%2F%2Fwww.itsc.uah.edu%2Fesip_data%23%3E%20prefix%20geo%3A%20%3Chttp%3A%2F%2Fwww.opengis.net%2Font%2FOGC-GeoSPARQL%2F1.0%2F%3E%20prefix%20gml%3A%20%3Chttp%3A%2F%2Fwww.opengis.net%2Fdef%2FdataType%2FOGC-GML%2F3.0%2F%3E%20prefix%20prov%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fprov%23%3E%20prefix%20rdfs%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%20prefix%20sigrid%3A%20%3Chttp%3A%2F%2Fpurl.org%2Fnsidc%2Fjcomm%2Fsigrid%23%3E%20prefix%20sio%3A%20%3Chttp%3A%2F%2Fsemanticscience.org%2Fresource%2F%3E%20%20prefix%20ssiii%3A%20%3Chttp%3A%2F%2Fpurl.org%2Fnsidc%2Fssiii%2Fseaice%23%3E%20%20SELECT%20%3FShapefile%20%3FDate%20WHERE%20%7B%20%3FShapefile%20a%20esip%3ADataGranule%20.%20%3FShapefile%20sio%3Ais-model-of%20%3Chttp%3A%2F%2Fpurl.org%2Fnsidc%2Fcis%2FSea-Ice-Chart-Regions%23EasternArctic%3E%20%7D
-->
