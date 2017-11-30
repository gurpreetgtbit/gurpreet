var arr={
		"CustomerBaseId":{"table":"CustomerBase","col":"Customer ID","type":"colvalue"},
		"ProductProductID":{"table":"Products","col":"Product ID","type":"colvalue"},
		"TaxClassId":{"table":"Tax Class","col":"Tax ID","type":"colvalue"},
		
}
var run=true;
//$id, table , col , type
function fetch(current,ID)
{
var table=(arr[ID]['table']);
var col=(arr[ID]['col']);
var fieldId=current.id;
var type=(arr[ID]['type']);
//alert(fieldId);
//fetches the customer id from customer table using ajax
//1st 3 lines are to run the function for once else user would not able to select any value
	var no=(document.getElementById("custommer").value);
	(document.getElementById("custommer").value)=(parseInt(no)+1);	
	if((run)!=current.id)
	{
		//makes request to have value from php in req variable
		var req=new XMLHttpRequest();
		req.open("get","fetchDetails.php?type="+type+"&table="+table+"&col="+col);
		req.send();
		req.onreadystatechange=function(){
			if(req.readyState==4&&req.status==200)
			{
				//req.response contains the option tags which are store in element with id input_7
				document.getElementById(fieldId).innerHTML=req.responseText;
			}
		}
		run=current.id;
	}	
}
function unitprice(current)
{
id=current.id;

//fetches the unit price and place that value to field with id numb
	uid=id;
	id=id.replace("input_","");
	num=parseInt(id)+1;
	numb="input_"+num;
	var e=document.getElementById(uid);
	strUser = e.options[e.selectedIndex].value;			
	if (strUser=="Please select your Product Id")
		alert("Please select a valid Id");
	else
	{
		var req=new XMLHttpRequest();
		req.open("get","fetchDetails.php?type=Value&attr=Sale Price&table=Products&key=Product ID&value="+strUser);
		req.send();
		
		req.onreadystatechange=function(){
		
			if(req.readyState==4&&req.status==200)
			{
				document.getElementById(numb).value=req.responseText;	
			}
		}
	}
}
function taxprice(current)
{
//fetches the tax price and tax percentage place that value to field with id numb and numb1
id=current.id;

	uid=id;
	id=id.replace("input_","");
	num=parseInt(id)+1;
	num1=parseInt(id)+2;	
	numb="input_"+num;
	numb1="input_"+num1;
	UnitPrice=(document.getElementById("input_"+(num-3)).value);
	Quantity=(document.getElementById("input_"+(num-2)).value);
	var e=document.getElementById(uid);
	strUser = e.options[e.selectedIndex].value;			
	if (strUser=="Please select your Tax Id")
		alert("Please select a valid Id");
	else
	{
		var req=new XMLHttpRequest();
		req.open("get","fetchDetails.php?type=Value&attr=Tax Percentage&table=Tax Class&key=Tax ID&value="+strUser);
		req.send();
		
		req.onreadystatechange=function(){
		
			if(req.readyState==4&&req.status==200)
			{
				
				var TaxAmount=(UnitPrice*(req.responseText)/100)*(Quantity);
				document.getElementById(numb).value=req.responseText;	
				document.getElementById(numb1).value=TaxAmount;	
				
			}
		}
	}
}
var tableTags=
{
	"name":["Product ID","Unit Price","Quantity","Tax ID","Tax Percentage","Tax Price"],
	"clickFunction":["ProductProductID","","","TaxClassId","",""],
	"changeFunction":["unitprice","","","taxprice","",""]
};
var value=14;
function tell()
{
	var no=(document.getElementById("create").value);
	no=parseInt(no);
	(document.getElementById("create").value)=(parseInt(no)+1);	
	var place=document.getElementById(no);
	
for(i=0;i<6;i++)
{
	var td = document.createElement("td");
	if(i%3==0)
	{
		input=createSelectField(tableTags['name'][i],"input_"+(value+i),tableTags['clickFunction'][i],tableTags['changeFunction'][i]);
	}
	else
	{
		input=createTextField(tableTags['name'][i],"input_"+(value+i));
		input.size="20";		
	}
	td.innerHTML=(input);
	place.appendChild(td);	
}
	value=value+6;
	
//dynamically add the product details when id is add anither product button is clicked 	

	var place1=document.getElementById("create_p");
	var tablenode=document.createElement("tr");
	tablenode.id=parseInt(no)+1;
	place1.appendChild(tablenode);		
}
function createTextField(name,idVal)
{
	var input='<input type="text" id="'+idVal+'" name="'+name+'" data-type="input-textbox" class="form-textbox" size="20" value="" data-component="textbox" /> ';
	
	return input;
}
function createSelectField(name,idVal,clickFun,changeFun)
{
//id,name,click fn ,changefn
	var input ='<select name="'+name+'" id="'+idVal+'" data-type="input-textbox" class="form-textbox"  value="" data-component="textbox" onclick="return fetch(this,'+"'"+clickFun+"'"+')" onchange="return '+changeFun+'(this)" >'+
	'<option>Please select your '+name+'</option>'+
	'</select>';
	return input;
}
function Hello()
{
 alert("a");
}
window.onload=function get()
{
n =  new Date();
y = n.getFullYear();
m = n.getMonth() + 1;
d = n.getDate();
document.getElementById('day_5').value = d;
document.getElementById('day_6').value = d;
document.getElementById('month_5').value = m ;
document.getElementById('month_6').value = m ;
document.getElementById('year_5').value = y;
document.getElementById('year_6').value = y;

}