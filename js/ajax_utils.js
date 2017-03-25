
var AJAX_obj = 0;
var AJAX_obj2 = 0;
var AJAX_obj3 = 0;
var AJAX_obj4 = 0;
var AJAX_obj5 = 0;

function issue_query(url, call_back) 
{
	if (AJAX_obj == 0)
		AJAX_obj = new XMLHttpRequest();
	
	AJAX_obj.onreadystatechange = call_back;    
	AJAX_obj.open( "GET", url, true );
	AJAX_obj.send(null);
	
}

function issue_query2(url, call_back) 
{
	if (AJAX_obj2 == 0)
		AJAX_obj2 = new XMLHttpRequest();
	
	AJAX_obj2.onreadystatechange = call_back;    
	AJAX_obj2.open( "GET", url, true );
	AJAX_obj2.send(null);
}

function issue_query3(url, call_back) 
{
	if (AJAX_obj3 == 0)
		AJAX_obj3 = new XMLHttpRequest();
	
	AJAX_obj3.onreadystatechange = call_back;    
	AJAX_obj3.open( "GET", url, true );
	AJAX_obj3.send(null);
}

function issue_query4(url, call_back) 
{
	if (AJAX_obj4 == 0)
		AJAX_obj4 = new XMLHttpRequest();
	
	AJAX_obj4.onreadystatechange = call_back;    
	AJAX_obj4.open( "GET", url, true );
	AJAX_obj4.send(null);
}

function issue_query5(url, call_back) 
{
	if (AJAX_obj5 == 0)
		AJAX_obj5 = new XMLHttpRequest();
	
	AJAX_obj5.onreadystatechange = call_back;    
	AJAX_obj5.open( "GET", url, true );
	AJAX_obj5.send(null);
}

function ajax_debug_msg_call_back() 
{
	if ( AJAX_obj3.readyState == 4)  {
		if (AJAX_obj3.status == 200)  {
			if (AJAX_obj3.responseText) {
				alert("ajax_debug_msg_call_back: " + AJAX_obj3.responseText);
			}
		}
	}
}
