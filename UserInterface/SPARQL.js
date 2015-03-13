//SPARQL.js
//This document will contain tools needed to query the virtuoso db programmatically

var prefix = "prefix dc: <http://purl.org/dc/terms/> prefix egg: <http://purl.org/nsidc/jcomm/egg#> prefix esip: <http://www.itsc.uah.edu/esip_data#> prefix geo: <http://www.opengis.net/ont/OGC-GeoSPARQL/1.0/> prefix gml: <http://www.opengis.net/def/dataType/OGC-GML/3.0/> prefix prov: <http://www.w3.org/ns/prov#> prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> prefix sigrid: <http://purl.org/nsidc/jcomm/sigrid#> prefix sio: <http://semanticscience.org/resource/>  prefix ssiii: <http://purl.org/nsidc/ssiii/seaice#> ";

var globalGraph  = 'http://purl.org/ssiii/layers';
var sparqlServer = 'http://virtuoso.dev.int.nsidc.org:8890/sparql';


function queryServer(form) {
	var query = encodeURIComponent(form.query.value);
	return sparqlServer + '?default-graph-uri=' + globalGraph + '&query=' + prefix + query;
}

function makeLink(desiredLink,desiredText) {
	var a = document.createElement('a');
	a.setAttribute('href',desiredLink);
	a.innerHTML = desiredText;
	// apend the anchor to the body
	// of course you can append it almost to any other dom element
	document.getElementsByTagName('body')[0].appendChild(a);
}

function displayResults(sourceLink) {
	var iFrame = document.createElement('iframe');
	iFrame.setAttribute('src',sourceLink);
	iFrame.setAttribute('style','width:1000px;height:700px');
	document.getElementsByTagName('body')[0].appendChild(iFrame);
}
//this is the function called by the form for searching by desired zone properties
function getShapeFiles(form) {
	var r  = form.region.value;
	var tc = form.totalConc.value;
	var ps = form.predominantSOD.value;
	var ss = form.secondarySOD.value;
	var cs = form.compSOD.value;
	var cc = form.compConc.value;
	var cf = form.compForm.value;
	displayResults(queryZonesByProperties(r,tc,ps,ss,cs,cc,cf));
}
//this is for testing purposes when I want to know why nothing is happening:
function showSPARQL(form) {
	var r  = form.region.value;
	var tc = form.totalConc.value;
	var ps = form.predominantSOD.value;
	var ss = form.secondarySOD.value;
	var cs = form.compSOD.value;
	var cc = form.compConc.value;
	var cf = form.compForm.value;
	var para = document.createElement('p');
	document.write(queryZonesByProperties(r,tc,ps,ss,cs,cc,cf));
}
//This function returns a query that takes the desired properties for a zone and returns the zone with its associated shapefile
function queryZonesByProperties(region,totalConc,predominantSOD,secondarySOD,compSOD,compConc,compForm) {
	var query = prefix + " SELECT ?Shapefile ?zone WHERE { ?Shapefile a esip:DataGranule . ";
	if region != "none" {
		query += "?Shapefile sio:is-model-of <http:purl.org/nsidc/cis/Sea-Ice-Chart-Regions#" + region + "> .";
	}
	query += " ?map sio:is-modeled-by ?Shapefile . ?zone sio:is-member-of ?map . ";
	if totalConc != "none" {
		query += "?zone sigrid:hasSigrid3ConcentrationCode " + totalConc + " . ";
	}
	if predominantSOD != "none" {
		query += "?zone egg:hasComponent ?predominant . ?predominant a egg:PredominantForm . ?predominant sigrid:hasSigrid3DevelopmentStageCode " + predominantSOD + " . ";
	}
	if secondarySOD != "none" {
		query += "?zone egg:hasComponent ?secondary . ?secondary a egg:SecondaryForm . ?secondary sigrid:hasSigrid3DevelopmentStageCode " + secondarySOD + " . ";
	}
	if "none" not in [compSOD,compConc,compForm] {
		query += "?zone egg:hasComponent ?component . ?component a ssiii:ZoneComponent . ";
	}
	if compSOD != "none" {
		query += "?component sigrid:hasSigrid3DevelopmentStageCode " + compSOD + " . ";
	}
	if compConc != "none" {
		query += "?component sigrid:hasSigrid3ConcentrationCode " + compConc + " . ";
	}
	if compForm != "none" {
		query += "?component sigrid:hasSigrid3IceFormCode " + compForm + " . ";
	}
	query += "}";
	return sparqlServer + '?default-graph-uri=' + globalGraph + '&query=' + encodeURIComponent(query);
}
