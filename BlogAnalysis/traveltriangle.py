from call import call
from alchemy import insert_compet#change line
from urlsoup import convert
from urldetails import send_detail
details=send_detail()
name='traveltriangle'
class traveltriangle1(call):
	def run(self):
		comp_id=details[name]['comp_id'] #c1		
		insert_compet(comp_id,details[name]['name'],details[name]['site_url'])
		url=details[name]['blog_url']
		soup=convert(url)
		no_of_pages=int(soup.findAll("a",{"class":"page-numbers"})[2].text)
		x=1
		super(traveltriangle1,self).setcompet(details[name]['name'])
		while(x<=no_of_pages):
			urlboss=details[name]['blog_url']+'/page/'+str(x)+'/'if x!=1 else details[name]['blog_url']
			soup = convert(urlboss)
			arr=[]
			arr=soup.findAll("a",{"rel":"bookmark"})
			self.storeblog(len(arr),x,arr,comp_id)
			x=x+1
	def storeblog(self,num,inc,arr,comp_id):
		i=0
		while(i<num):
			i=i+1
			no_=i+(inc-1)*10
			super(traveltriangle1,self).passvalues(no_,i,arr,comp_id)

