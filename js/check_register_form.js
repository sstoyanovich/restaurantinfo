function check_register_form(rand_num, admin_adding, member_type)
{
	if (member_type != 'C') // candidates dont enter this.
	{
		if (document.register_form.company_name.value == '')
		{
			alert("Please enter your company name into the form.");
			document.register_form.company_name.focus();
			return false;
		}
	}
	
	if (document.register_form.first_name.value == "")
	{
		alert("Please enter your First Name.");
		document.register_form.first_name.focus();
    	return false;
	}
	if (document.register_form.last_name.value == "")
	{
		alert("Please enter your Last Name.");
		document.register_form.last_name.focus();
    	return false;
	}
	if (document.register_form.address.value == '')
	{
		alert("Please enter your address into the form.");
		document.register_form.address.focus();
		return false;
	}
	if (document.register_form.city.value == '')
	{
		alert("Please enter your city into the form.");
		document.register_form.city.focus();
    	return false;
	}
	if (document.register_form.state.value == '')
	{
		alert("Please select your state from the popup list.");
		document.register_form.state.focus();
		return false;
	}
	if (document.register_form.zip.value == "")
	{
		alert("Please enter your Zip Code.");
		document.register_form.zip.focus();
    	return false;
	}

	if (document.register_form.phone.value == '')
	{
		alert("Please enter your phone number into the form.");
		document.register_form.phone.focus();
		return false;
	}
	if (document.register_form.email.value == "")
	{
		alert("Please enter your Email address.");
		document.register_form.email.focus();
    	return false;
	}
	if (document.register_form.email2.value == "")
	{
		alert("Please Re-enter your Email address.");
		document.register_form.email2.focus();
    	return false;
	}
	if (document.register_form.email.value != document.register_form.email2.value)
	{
		alert("The Email address that you re-entered does not match the first one you entered.");
		document.register_form.email2.focus();
    	return false;
	}
	if (validate_email(document.register_form.email.value) == false)
	{
		alert("Your email address does not appear to be valid.");
		document.register_form.email.focus();
		return false
	}
	
	if (document.register_form.password.value == "")
	{
		alert("Please enter your Password.");
		document.register_form.password.focus();
    	return false;
	}
	if (document.register_form.password2.value == "")
	{
		alert("Please Re-enter your Password.");
		document.register_form.password2.focus();
    	return false;
	}
	if (document.register_form.password.value != document.register_form.password2.value)
	{
		alert("The Password that you re-entered does not match the first one you entered.");
		document.register_form.password2.focus();
    	return false;
	}


	if (document.register_form.security_question.value == "" || document.register_form.security_question.value == 0)
	{
		alert("Please select a Security Question.");
		document.register_form.security_question.focus();
    	return false;
	}
	if (document.register_form.security_response.value == "")
	{
		alert("Please enter the answer to the selected security question.");
		document.register_form.security_response.focus();
    	return false;
	}

	if (admin_adding == 0)
	{
		if (!document.register_form.accept.checked)
		{
			alert("Please indicate that you have read and accept the terms and conditions by checking the box.");
			document.register_form.accept.focus();
			return false;
		}
	
	
		if (document.register_form.reg_code.value == '')
		{
			alert('Please enter the 4-digit code as shown next to the code box in the form.');
			document.register_form.reg_code.focus();
			return false;
		}
		if (document.register_form.reg_code.value != rand_num)
		{
			alert('The 4-digit registration code was not entered correctly.  Please verify.');
			document.register_form.reg_code.focus();
			return false;
		}
	}

	return true;
}

function validate_email(str) 
{
	var at="@";
	var dot=".";
	var lat=str.indexOf(at);
	var lstr=str.length;
	var ldot=str.indexOf(dot);
	
	if (str.indexOf(at)==-1)
		return false;
	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr)
		return false;
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)
		return false;
	if (str.indexOf(at,(lat+1))!=-1)
		return false;
	if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot)
		return false;
	if (str.indexOf(dot,(lat+2))==-1)
		return false;
	if (str.indexOf(" ")!=-1)
		return false;
	
	 return true;				
}
$(function () {
    $('input#member_type').change(function () {
        var membershipForm = $("#register_form_membership_type"),
            submitButton = $("#register_form_membership_type input[type=submit]");
        
        submitButton.click();
        
        return false;
    });
});
