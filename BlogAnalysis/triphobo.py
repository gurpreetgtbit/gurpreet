from call import call
from alchemy import insert_compet
from urlsoup import convert
from urldetails import send_detail
details=send_detail()
name='triphobo'
class triphobo1(call):
	def run(self):
		comp_id=details[name]['comp_id'] #c1		
		insert_compet(comp_id,details[name]['name'],details[name]['site_url'])
		urlmain=details[name]['blog_url']
		soup=convert(urlmain)		
		i=-1
		arr=soup.findAll("a",{"class":"explore-more"})
		while(i<len(arr)-1):
			i=i+1
			url1=arr[i]['href']
			j=-1
			soup1=convert(url1)
			arr1=soup1.findAll("a",{"class":"explore-more"})
			while(j<len(arr1)-1):
				j=j+1
				url2=arr1[j]['href']
				print url2
				soup2=convert(url2)
				no_of_pages=len(soup2.find("ul",{"class":"js_num_pagination"}).findChildren("li"))-1 if soup2.find("ul",{"class":"js_num_pagination"}) else 1		
				
				x=1
				super(triphobo1,self).setcompet("triphobo")
				while(x<=no_of_pages):
					urlboss=url2+"?page="+str(x)
					urlboss=urlboss.replace(" ?page","?page")
					print urlboss
					soup_= convert(urlboss)
					arr_=soup_.find_all("a",{"class":"mstr-cat-cont"})
#					arr=soup.findAll("a",{"class":"post-readmore"}) arr also changed change 4
					self.storeblog(len(arr_),x,arr_,comp_id)
					x=x+1
	
	def storeblog(self,num,inc,arr,comp_id):
		i=0
		while(i<num):
			i=i+1
			no_=i+(inc-1)*32
			super(triphobo1,self).passvalues(no_,i,arr,comp_id)


