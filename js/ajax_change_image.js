var _ms_XMLHttpRequest_ActiveX = ""; // Holds type of ActiveX to instantiate

var versions = ["Msxml2.XMLHTTP.7.0", "Msxml2.XMLHTTP.6.0", "Msxml2.XMLHTTP.5.0", "Msxml2.XMLHTTP.4.0", "MSXML2.XMLHTTP.3.0", "MSXML2.XMLHTTP", "Microsoft.XMLHTTP"];
var AJAX_obj;
var last_image = "";
var image1 = "";
var image2 = "";
var image3 = "";
var image4 = "";
var image5 = "";
var image6 = "";

var last_comm_image = "";


function check_cached(num)
{
	if (num == 1 && image1 != '')
		return image1;
	else if (num == 2 && image2 != '')
		return image2;
	else if (num == 3 && image3 != '')
		return image3;
	else if (num == 4 && image4 != '')
		return image4;
	else if (num == 5 && image5 != '')
		return image5;
	else if (num == 6 && image6 != '')
		return image6;
	else 
		return false;
}

function cache_image(img,num)
{
	switch(num)
	{
		case 1: image1 = img; break;
		case 2: image2 = img; break;
		case 3: image3 = img; break;
		case 4: image4 = img; break;
		case 5: image5 = img; break;
		case 6: image6 = img; break;
	}
	return true;
}

function get_ajax_obj()
{
	if (window.XMLHttpRequest) 	// Non I.E. browsers
	{
		AJAX_obj = new XMLHttpRequest();
	} 
	else if (window.ActiveXObject)  // Internet Explorer
	{
		// Instantiate the latest MS ActiveX Objects
		if (_ms_XMLHttpRequest_ActiveX) {
			AJAX_obj = new ActiveXObject(_ms_XMLHttpRequest_ActiveX);
		} 
		else // loops through the various versions of XMLHTTP to ensure we're using the latest
		{
			for (var i = 0; i < versions.length ; i++) 
			{
				try 
				{
					AJAX_obj = new ActiveXObject(versions[i]);
					if (AJAX_obj) {
						_ms_XMLHttpRequest_ActiveX = versions[i]; // save a reference to the proper one to speed up future instantiations
						break;
					}
				}
				catch (objException) {
				// trap; try next one
				} ;
			} ;
		}
	}
}

function change_image(img,num)
{
	var url = "/ajax/change_image.php?img=/prodimages/" + img;
	var image_cached = check_cached(num);
	
	if (img != last_image)
	{
		if (image_cached)
			document.getElementById("show_image").innerHTML = "<img src='" + image_cached + "' border='0' width='100%'>";
		else
			document.getElementById("show_image").innerHTML = "<img src='/animations/loading.gif' width='70' height='18' border='0'>";

		get_ajax_obj();
		
		AJAX_obj.onreadystatechange = call_back;    
		AJAX_obj.open( "GET", url, true );
		AJAX_obj.send(null);
	}
	last_image = img;
	cache_image(img,num);
}

function call_back() 
{
	if ( AJAX_obj.readyState == 4) 
	{
		if (AJAX_obj.status == 200) 
		{
				document.getElementById("show_image").innerHTML = AJAX_obj.responseText;

				//alert();
		}
	}
}

