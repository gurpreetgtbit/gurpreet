from mywork import acres
from urlsoup import convert
from alchemy import insert_acre
#pg subash
url='https://www.99acres.com/search/property/rent/residential/subhash-nagar-delhi-west?search_type=QS&search_location=CP1&lstAcn=CP_R&lstAcnId=1&src=CLUSTER&preference=P&selected_tab=4&city=5&res_com=R&property_type=R&isvoicesearch=N&keyword_suggest=subhash%20nagar%2C%20delhi%20west%3B&fullSelectedSuggestions=subhash%20nagar%2C%20delhi%20west&strEntityMap=W3sidHlwZSI6ImxvY2FsaXR5In0seyIxIjpbInN1Ymhhc2ggbmFnYXIsIGRlbGhpIHdlc3QiLCJDSVRZXzUsIExPQ0FMSVRZXzQ3MjUsIFBSRUZFUkVOQ0VfUiwgUkVTQ09NX1IiXX1d&texttypedtillsuggestion=subhash&refine_results=Y&Refine_Localities=Refine%20Localities&action=%2Fdo%2Fquicksearch%2Fsearch&suggestion=CITY_5%2C%20LOCALITY_4725%2C%20PREFERENCE_R%2C%20RESCOM_R&searchform=1&locality=4725&price_min=null&price_max=5000'
url='https://www.99acres.com/search/property/rent/residential-all/rajouri-garden-delhi-west?search_type=QS&search_location=SH&lstAcn=SEARCH&lstAcnId=7348032256738871&src=CLUSTER&preference=R&city=5&res_com=R&property_type=R&locality_array_for_zedo=327&selected_tab=4&isvoicesearch=N&keyword_suggest=rajouri%20garden%2C%20delhi%20west%3B&bedroom_num=2&fullSelectedSuggestions=rajouri%20garden%2C%20delhi%20west&strEntityMap=W3sidHlwZSI6ImxvY2FsaXR5In0seyIxIjpbInJham91cmkgZ2FyZGVuLCBkZWxoaSB3ZXN0IiwiQ0lUWV81LCBMT0NBTElUWV8zMzcsIFBSRUZFUkVOQ0VfUiwgUkVTQ09NX1IiXX1d&texttypedtillsuggestion=Rahouri&refine_results=Y&Refine_Localities=Refine%20Localities&action=%2Fdo%2Fquicksearch%2Fsearch&suggestion=CITY_5%2C%20LOCALITY_337%2C%20PREFERENCE_R%2C%20RESCOM_R&searchform=1&locality=337&price_min=null&price_max=null'

soup=convert(url)
b=soup.findAll("div",{"class":"wrapttl"})
for val in b:
	r=val.findChildren("a",{"target":"_blank"})
	#if "/2-bhk" in r[0]['href']:for flats 
#	r[0]['href']=r[0]['href'].replace("/2-bhk","https://www.99acres.com/2-bhk")	
	r[0]['href']="https://www.99acres.com/"+r[0]['href']	
	url=r[0]['href']
	print url
	ob=acres()
	p=ob.getdata(url)
	insert_acre(url,p)

