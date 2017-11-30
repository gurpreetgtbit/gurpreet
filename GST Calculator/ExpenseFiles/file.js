
//$id, table , col , type
var arr={
			"ExpensePaymentMode":{"table":"Expense Register","col":"Payment Mode","type":"option","run":true},
			"ExpenseExpenseType": {"table":"Expense Register","col":"Expense Type","type":"option","run":true},
			"PaymentSourceID": {"table":"Payment Sources","col":"Payment Source ID","type":"IndirectEx","run":true},
			"PurchaseOrderID": {"table":"Purchase Register","col":"Order ID","type":"IndirectEx","run":true},
			"DirectPaymentCurrency": {"table":"Direct Expense Register","col":"Payment Currency","type":"option","run":true},
			"DirectPaymentType": {"table":"Direct Expense Register","col":"Payment Type","type":"option","run":true},
			"DirectPaymentMode": {"table":"Direct Expense Register","col":"Payment Mode","type":"option","run":true},
			"DirectPaymentSourceID": {"table":"Payment Sources","col":"Payment Source ID","type":"IndirectEx","run":true},
			"DirectVendorID": {"table":"Vendor Register","col":"Vendor ID","type":"IndirectEx","run":true},
			"ExpenseExpenseID": {"table":"Expense Register","col":"Expense ID","type":"IndirectEx","run":true},
			"DirectExpenseID": {"table":"Direct Expense Register","col":"Expense ID","type":"IndirectEx","run":true},
			"DirectExpenseFile": {"table":"Direct Expense Register","col":"Expense ID","type":"details","run":true},
			"ExpenseFile": {"table":"Expense Register","col":"Expense ID","type":"details","run":true}
};	
function fetch(current,$ID,$value='')
{
	
//Get the record(enum or column values) from db using tablename and columnname
//@param string $counter to ensure values are fetch at once
//@param col as columnname
//@param table as tablename
//@param fieldId as the id where ajax result is to be shown
//@param type for talling fetch.php which fuction to run
//@param value if a particular value is to taken
var $table=(arr[$ID]['table']);
var $col=(arr[$ID]['col']);
var $fieldId=current.id;
var $type=(arr[$ID]['type']);

	if((arr[$ID]['run'])==true)
	{
		//makes request to have value from php in req variable
		var req=new XMLHttpRequest();
		req.open("get","fetch.php?type="+$type+"&col="+$col+"&table="+$table);
		req.send();
		req.onreadystatechange=function(){
			if(req.readyState==4&&req.status==200)
			{
				//req.response contains the option tags which are store in element with id input_11
				document.getElementById($fieldId).innerHTML=req.responseText;
			}
		}
		arr[$ID]['run']=false;
	}	
}	
function details(current,$ID)
{
	//Put the values fetched in the columns of remaing fields
	//@param type for telling fetch which function to run
	//@param table as tablename
	//param col for columname 
var $table=(arr[$ID]['table']);
var $col=(arr[$ID]['col']);
var $fieldId=current.id;
var $type=(arr[$ID]['type']);
	var e=document.getElementById($fieldId);
	strUser = e.options[e.selectedIndex].value;	
	if (strUser=="Please select your Expense ID")
		alert("Please select a valid Id");
	else
	{
		
		var req=new XMLHttpRequest();
		req.open("get","fetch.php?type="+$type+"&table="+$table+"&col="+$col+"&id="+strUser,true);
		req.send();
		
		req.onreadystatechange=function(){
		
			if(req.readyState==4&&req.status==200)
			{
				str=JSON.parse(req.responseText);
				
				var no=(Object.keys(str).length);

				for (i=1;i<no/2;i++)
				{
					val=i+3
					document.getElementById('input_'+val).value=str[i];
				}
			}
		}
	}	                                           
}
