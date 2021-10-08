var template;



function CaptureFingerprintEncrypted()
{
  var url = "https://localhost:8000/CaptureFingerprintEncrypted";
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
	   fpobject = JSON.parse(xmlhttp.responseText);
	   alert("Device Status: "+fpobject.ReturnCode);
	   alert("Base64finaldata: "+fpobject.DataWithEncryptTemplate);
	   alert("Base64EncryptedWsqImage: "+fpobject.DataWithEncryptWsqImage);
	    document.getElementById("crypt").value = fpobject.DataWithEncryptWsqImage;
     }
	 
				
	 xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }

  }
  
  var timeout = 5;
  var diversificationData = "123114";
  xmlhttp.open("POST",url+"?"+timeout+"$"+diversificationData,true);
  xmlhttp.send();

}



function CaptureFingerprintForPid()
{
  var url = "https://localhost:8000/CaptureFingerprintForPid";
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
	   fpobject = JSON.parse(xmlhttp.responseText);
	   alert("Device Status: "+fpobject.ReturnCode);
	   alert("Base64ISOTemplate: "+fpobject.Base64ISOTemplate);
	   alert("Base64RAWIMage: "+fpobject.Base64RAWIMage);
	   alert("Base64BMPIMage: "+fpobject.Base64BMPIMage);
	   alert("NFIQ: "+fpobject.NFIQ);
       template = fpobject.Base64ISOTemplate; 
     }
				
	 xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
  }
  
  var timeout = 5;
  var fingerindex = 1;
  xmlhttp.open("POST",url+"?"+timeout+"$"+fingerindex,true);
  xmlhttp.send();

}





function captureFpForPidwithISOFlag()
{
  var url = "https://localhost:8000/captureFpForPidwithISOFlag";
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
	   fpobject = JSON.parse(xmlhttp.responseText);
	   alert("Device Status: "+fpobject.ReturnCode);
	   alert("Base64ISOTemplate: "+fpobject.Base64ISOTemplate);
	   alert("Base64RAWIMage: "+fpobject.Base64RAWIMage);
	   alert("Base64BMPIMage: "+fpobject.Base64BMPIMage);
	   alert("NFIQ: "+fpobject.NFIQ);
       template = fpobject.Base64ISOTemplate; 
     }
				
	 xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
  }
  
  var timeout = 5;
  var fingerindex = 1;
  var imgFlag = 2;
  var isoFlag = 1;
  xmlhttp.open("POST",url+"?"+timeout+"$"+fingerindex+"$"+imgFlag+"$"+isoFlag,true);
  xmlhttp.send();

}


function captureFpForBfdwithISOFlag()
{
  var url = "https://localhost:8000/captureFpForBfdwithISOFlag";
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
	   fpobject = JSON.parse(xmlhttp.responseText);
	   alert("Device Status: "+fpobject.ReturnCode);
	   alert("Base64ISOTemplate: "+fpobject.Base64ISOTemplate);
	   alert("Base64RAWIMage: "+fpobject.Base64RAWIMage);
	   alert("Base64BMPIMage: "+fpobject.Base64BMPIMage);
	   alert("NFIQ: "+fpobject.NFIQ);
       template = fpobject.Base64ISOTemplate; 	   
     }
  }
  
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
  
  var timeout = 5;
  var fingerindex = 10;
  var imgFlag = 2;
  var isoFlag = 1;
  xmlhttp.open("POST",url+"?"+timeout+"$"+fingerindex+"$"+imgFlag+"$"+isoFlag,true);
  xmlhttp.send();

}


function captureFpForBfd()
{
  var url = "https://localhost:8000/captureFpForBfd";
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
	   fpobject = JSON.parse(xmlhttp.responseText);
	   alert("Device Status: "+fpobject.ReturnCode);
	   alert("Base64ISOTemplate: "+fpobject.Base64ISOTemplate);
	   alert("Base64RAWIMage: "+fpobject.Base64RAWIMage);
	   alert("Base64BMPIMage: "+fpobject.Base64BMPIMage);
	   alert("NFIQ: "+fpobject.NFIQ);
       template = fpobject.Base64ISOTemplate; 	   
     }
  }
  
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
  
  var timeout = 5;
  var fingerindex = 1;

   xmlhttp.open("POST",url+"?"+timeout+"$"+fingerindex,true);

  
  xmlhttp.send();

}



function CompareTemplates()
{
  var url = "https://localhost:8000/CompareTemplates";
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
		fpobject = JSON.parse(xmlhttp.responseText);
	    alert("CompareTemplate return code: "+fpobject.ReturnCode);
		alert("Matching Result: "+fpobject.MatchingResult);
     }
  }
  
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
	
  var templatesArray = [1];
  templatesArray[0] = template;  

 // alert("templatearray1: "+ templatesArray[0]);
  var numberOfTemplates = 1;
  xmlhttp.open("POST",url+"?"+templatesArray+"$"+template+"$"+numberOfTemplates,true);
  xmlhttp.send();
  
}


function getDeviceDetails()
{
  var url = "https://localhost:8000/getDeviceDetails";
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
  {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
		fpobject = JSON.parse(xmlhttp.responseText);
	    
		alert("Device Make: "+fpobject.DeviceMake);
	    alert("Device Model: "+fpobject.DeviceModel);
	    alert("Device Serial: "+fpobject.DeviceSerial);
     }
  }
  
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
  
  
  xmlhttp.open("POST",url,true);
  xmlhttp.send();
}


function getPidDataWithFusion()
{
  var url = "https://localhost:8000/getPidDataWithFusion";
  var xmlhttp;
 if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
 {// code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
		fpobject = JSON.parse(xmlhttp.responseText);
	    alert("ReturnCode: "+fpobject.ReturnCode);
	    alert("encodeEncyptedPidBlock: "+fpobject.encodeEncyptedPidBlock);
	    alert("encodeEncyptedHmac: "+fpobject.encodeEncyptedHmac);
		alert("encodeEncyptedSessionKey: "+fpobject.encodeEncyptedSessionKey);
		alert("CertificateExpiryDate: "+fpobject.CertificateExpiryDate);
		alert("timestamp: "+fpobject.timeStamp);
     }
  }
  
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
  
  var version = "1.0";
  xmlhttp.open("POST",url+"?"+version,true);
  xmlhttp.send();
}


function getPidDataWithDemo()
{
  var url = "https://localhost:8000/getPidDataWithDemo";
  var xmlhttp;
 if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
 {// code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
		fpobject = JSON.parse(xmlhttp.responseText);
	    alert("ReturnCode: "+fpobject.ReturnCode);
	    alert("encodeEncyptedPidBlock: "+fpobject.encodeEncyptedPidBlock);
	    alert("encodeEncyptedHmac: "+fpobject.encodeEncyptedHmac);
		alert("encodeEncyptedSessionKey: "+fpobject.encodeEncyptedSessionKey);
		alert("CertificateExpiryDate: "+fpobject.CertificateExpiryDate);
		alert("timestamp: "+fpobject.timeStamp);
     }
  }
  
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
  
    
	var version = "1.0";
	var lang = "";            // 06->Hindi
  
	var PI = {
    ms       : "E",
	mv       : "",
    name     : "Abhishek Gupta", 
	lname    : "",
	lmv      : "",
	gender   : "M",
	dob      : "1992-10-08",
	dobt     : "",
	age      : "",
	phone    : "8004453675",
	email    : "",
	};
	
	
    var PA ={
	ms       : "",
	co       : "",
    house    : "",
	street   : "",
	lm       : "",
	loc      : "",
	vtc      : "",
	subdist  : "",
	dist     : "",
	state    : "",
	pc       : "",
	po       : "",
	};

	var PFA= {
	ms       : "P",
	mv       : "60",
    av       : "S/O: Sudhir Kumar Gupta, 260, Vikas Nagar Kanpur, K P University, Kanpur Nagar, Uttar Pradesh - 208024",        //full address as single string
	lav      : "",
	lmv      : "",

    };
	

    var Perso_ID = getURI(PI);
	var Perso_ADD = getURI(PA);
    var Perso_Full_ADD = getURI(PFA);
	var Demo_Data = "$PI$"+Perso_ID+"$PA$"+Perso_ADD+"$PFA$"+Perso_Full_ADD
    //xmlhttp.open("POST",url+"?"+version+"$"+lang+"$"+Perso_ID+"$"+Perso_ADD+"$"+Perso_Full_ADD,true);
	//alert(Demo_Data);
	
    xmlhttp.open("POST",url+"?"+version+"$"+lang+Demo_Data,true);

	
  xmlhttp.send();
  
}

function getURI(object)
{
	
	var URI = Object.keys(object).map(function(key){ 
    return encodeURIComponent(key) + '=' + encodeURIComponent(object[key]); 
	}).join('&');
		
	return URI;
	
}



function getPidDataWithOtp()
{
  var url = "https://localhost:8000/getPidDataWithOtp";
  var xmlhttp;
 if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
 {// code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
		fpobject = JSON.parse(xmlhttp.responseText);
	    alert("ReturnCode: "+fpobject.ReturnCode);
	    alert("encodeEncyptedPidBlock: "+fpobject.encodeEncyptedPidBlock);
	    alert("encodeEncyptedHmac: "+fpobject.encodeEncyptedHmac);
		alert("encodeEncyptedSessionKey: "+fpobject.encodeEncyptedSessionKey);
		alert("CertificateExpiryDate: "+fpobject.CertificateExpiryDate);
		alert("timestamp: "+fpobject.timeStamp);
     }
  }
  
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
  
  var version = "1.0";
  var otp = "12345";
  xmlhttp.open("POST",url+"?"+version+"$"+otp,true);
  xmlhttp.send();
}



function getPidDataWithProto()
{
  var url = "https://localhost:8000/getPidDataWithProto";
  var xmlhttp;
 if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
 {// code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
		fpobject = JSON.parse(xmlhttp.responseText);
	    alert("ReturnCode: "+fpobject.ReturnCode);
	    alert("encodeEncyptedPidBlock: "+fpobject.encodeEncyptedPidBlock);
	    alert("encodeEncyptedHmac: "+fpobject.encodeEncyptedHmac);
		alert("encodeEncyptedSessionKey: "+fpobject.encodeEncyptedSessionKey);
		alert("CertificateExpiryDate: "+fpobject.CertificateExpiryDate);
		alert("timestamp: "+fpobject.timeStamp);
     }
  }
  
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
  
  var version = "1.0";
 
  xmlhttp.open("POST",url+"?"+version,true);
  xmlhttp.send();
}




function clearTemplatesForPid()
{
  var url = "https://localhost:8000/clearTemplatesForPid";
  var xmlhttp;
 if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
}
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
		fpobject = JSON.parse(xmlhttp.responseText);
	    alert("Return Code: "+fpobject.ReturnCode);
     }
  }
   
  xmlhttp.open("POST",url,true);
  xmlhttp.send();
}


function getBfdData()
{
  var url = "https://localhost:8000/getBfdData";
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
 }
  else
 {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
		fpobject = JSON.parse(xmlhttp.responseText);
	    alert("ReturnCode: "+fpobject.ReturnCode);
	    alert("encodeEncyptedRBDBlock: "+fpobject.encodeEncyptedRBDBlock);
	    alert("encodeEncyptedHmac: "+fpobject.encodeEncyptedHmac);
		alert("encodeEncyptedSessionKey: "+fpobject.encodeEncyptedSessionKey);
		alert("CertificateExpiryDate: "+fpobject.CertificateExpiryDate);
		alert("timestamp: "+fpobject.timeStamp);
		var data = fpobject.ReturnCode + "$" + fpobject.encodeEncyptedRBDBlock + "$" + fpobject.encodeEncyptedHmac + "$" + fpobject.encodeEncyptedSessionKey + "$" + fpobject.CertificateExpiryDate + "$" + fpobject.timeStamp;
     }
  }
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
	
	
  var version = "1.0";
  xmlhttp.open("POST",url+"?"+version,true);
  xmlhttp.send();
}



function getBfdDataWithProto()
{
  var url = "https://localhost:8000/getBfdDataWithProto";
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
 }
  else
 {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
		fpobject = JSON.parse(xmlhttp.responseText);
	    alert("ReturnCode: "+fpobject.ReturnCode);
	    alert("encodeEncyptedRBDBlock: "+fpobject.encodeEncyptedRBDBlock);
	    alert("encodeEncyptedHmac: "+fpobject.encodeEncyptedHmac);
		alert("encodeEncyptedSessionKey: "+fpobject.encodeEncyptedSessionKey);
		alert("CertificateExpiryDate: "+fpobject.CertificateExpiryDate);
		alert("timestamp: "+fpobject.timeStamp);
		var data = fpobject.ReturnCode + "$" + fpobject.encodeEncyptedRBDBlock + "$" + fpobject.encodeEncyptedHmac + "$" + fpobject.encodeEncyptedSessionKey + "$" + fpobject.CertificateExpiryDate + "$" + fpobject.timeStamp;
     }
  }
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
	
	
  var version = "1.0";
  xmlhttp.open("POST",url+"?"+version,true);
  xmlhttp.send();
}


function clearTemplatesForBfd()
{
  var url = "https://localhost:8000/clearTemplatesForBfd";
  var xmlhttp;
 if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
}
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
		fpobject = JSON.parse(xmlhttp.responseText);
	    alert("Return Code: "+fpobject.ReturnCode);
     }
  }
  
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }
  
  xmlhttp.open("POST",url,true);
  xmlhttp.send();
}



function readCertificate()
{
  var url = "https://localhost:8000/readCertificate";
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

     xmlhttp=new XMLHttpRequest();
  
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }
     xmlhttp.onreadystatechange=function()
  {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
		fpobject = JSON.parse(xmlhttp.responseText);
	    alert("ReturnCode: "+fpobject.ReturnCode);
     }
  }
  
   xmlhttp.onerror = function () {
         alert("Check If Morpho Service/Utility is Running");
    }

var uidaiCertificate = "-----BEGIN CERTIFICATE-----<br>"+
"MIIFjDCCA3SgAwIBAgICEAAwDQYJKoZIhvcNAQELBQAwXTELMAkGA1UEBhMCSU4x<br>"+
"CzAJBgNVBAgMAlVQMQ4wDAYDVQQHDAVOb2lkYTEPMA0GA1UECgwGU2FmcmFuMQ8w<br>"+
"DQYDVQQLDAZTYWZyYW4xDzANBgNVBAMMBlNhZnJhbjAeFw0xNjAyMDMxMzE3MTNa<br>"+
"Fw0yNjAxMzExMzE3MTNaME0xCzAJBgNVBAYTAklOMQswCQYDVQQIDAJVUDEPMA0G<br>"+
"A1UECgwGU2FmcmFuMQ8wDQYDVQQLDAZNb3JwaG8xDzANBgNVBAMMBk1vcnBobzCC<br>"+
"AiIwDQYJKoZIhvcNAQEBBQADggIPADCCAgoCggIBAPepld9+vPb+uOqR5ZuuDKMa<br>"+
"LQIcwddtW4hRyevlAqLJFC2NDhMxLLXgw5+fmSF8EfjdrqHiDGHjGRuuYiOxuSJ7<br>"+
"fmjRgXVW899B9vGpkD/g4PQN3Pjya7i3yZP8Aw4Shzd+R5VzFeVBL+0YtK5W19dM<br>"+
"YKzHJ+1BwmToECYoXhICZv6GTqKT0X9OofCZxF9MrxuVSFuCNXor5HsRLJWpoqaW<br>"+
"BJ4/1WT0do/zZdRoht8jSJYxENB3ON7GLfna5WWEI3P6j+ckULdk+mzsg5MrlDPB<br>"+
"z2cgSDZ11dhThaIoELqxdmoQ9d9i0OX0A2bQhZOeftqnIdN7mB0EBrR4H+RJvb9f<br>"+
"i381e4xv/pLsiJJ9cu5xgm7QN6cvybsn7yTbe4hYt4eu0L+dpCOpGF6l6BkzRJvx<br>"+
"keQGA5FnqpPm1mz4ZpHvh2FVQlHNhiFvwWgMu14tXf2BHKkItOw3VgB3860CPNKo<br>"+
"2Er0ZwpMSMRWoEd1l9vgsiZ2frRa8i4uHGtZLdPk1AjnotCH+cXYm4mb4c8wo2DJ<br>"+
"izSljXMJiDceYoRL96RHkbjwtzwT6Blr7SE+0rH2LZ+c0eheG4o0Yv6aRy1/MW3N<br>"+
"UyQwCHhwMRbIqULzSqFRi8FsHEfDT2rw6Qg7wmMKpLCaNFNXgghmMW6YLlCWhmpv<br>"+
"cu47Eeioa9iM9s++Yp43AgMBAAGjZjBkMB0GA1UdDgQWBBQhl+Fgs8mOYCyputMK<br>"+
"a9I0b3CwtDAfBgNVHSMEGDAWgBTN5KzIH4lXi2jplj6a/Sjs4IxiGDASBgNVHRMB<br>"+
"Af8ECDAGAQH/AgEAMA4GA1UdDwEB/wQEAwIBhjANBgkqhkiG9w0BAQsFAAOCAgEA<br>"+
"G4asRzOiSrU7CKJ3o+wu3jLviYoS3r6XFK4RoU5E2fvb6wbQkl0Mnz2fJ4Jqvc9B<br>"+
"e6FWF7s+xHPrq8lstv4v2e/XkUVMH9wRBEjsqsMuZD61t1SWRSOz5nAl9ZtkJl5O<br>"+
"8ZNd7PjiIQcWGjjMtxJ36TqUOYWOoZL8b5e+tm1vtJJ0iq3t1rQpKDYS0izjDbJg<br>"+
"Zs5KhyrzczqQfVnSLC+um/KFsA3PIpu1hH1/LtEanU5fxnwIA3qjK9h08WSiEDJC<br>"+
"uWM3ZVEHGBQkSNBX9jZ922OlRwGzKUx+SG7V0fX6fU6FQtTd3p6EMiIhqaSfLSVj<br>"+
"HzrRBgeEcqLZk1YHBdbnR9QqSoM7SMMoQjtpGD5+b7P8iEfQ1N3qnpI7W++h/TTM<br>"+
"3qUZ5x8bxZqA9zSqTN0Axvu5DBHHI7FQGQcq9ymm4qliA/GopxptlCWVJX1mf23k<br>"+
"Y2xtsB0t6wlBkXXK2NxenRPHl1upJmmNtMaZupOkOCH/gz8VvkHsrgPHBYza+sQj<br>"+
"sdiiw2hvoj/yxJSqOPbt5akahhGfmcqhuAEqDmxa39zioNWSjww0Lmu7HJsIy9kd<br>"+
"NHGfNnxUAKFkG1fFPO49V4uhcnsx//WZpusBeWkBrf0ZnWQGcMFXb1jGhP2xPev7<br>"+
"gWlmOBM5Z1GW4PL6JmcfqT/inUKLShxkJxUvJO9nJlg=<br>"+
"-----END CERTIFICATE-----<br>";


   //var uidaiCertificate = "";
  xmlhttp.open("POST",url+"?"+uidaiCertificate,true);
  xmlhttp.send();
}



