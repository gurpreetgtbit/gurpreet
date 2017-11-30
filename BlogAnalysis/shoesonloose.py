from call import call
from alchemy import insert_compet#change line
from urlsoup import convert
from urldetails import send_detail
details=send_detail()
name='shoesonloose'
class shoesonloose1(call):
	def run(self):
		comp_id=details[name]['comp_id'] #c1		
		insert_compet(comp_id,details[name]['name'],details[name]['site_url'])
		url=details[name]['blog_url']
		soup=convert(url)
		no_of_pages=int(soup.find("a",{"aria-label":"Last"})['href'].replace('/blogs/',''))
		x=1
		super(shoesonloose1,self).setcompet(details[name]['name'])
		while(x<=no_of_pages):
			urlboss=details[name]['blog_url']+str(x)+'/'
			soup = convert(urlboss)
			arr=[]
			arr=soup.findAll("a",{"class":"blog_link"})
			i=0
			while(i<len(arr)):
				arr[i]['href']='https://www.'+details[name]['name']+'.com'+arr[i]['href']
				i=i+1			
			self.storeblog(len(arr),x,arr,comp_id)
			x=x+1
	def storeblog(self,num,inc,arr,comp_id):
		i=0
		while(i<num):
			i=i+1
			no_=i+(inc-1)*10
			super(shoesonloose1,self).passvalues(no_,i,arr,comp_id)

