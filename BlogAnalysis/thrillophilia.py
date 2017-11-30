from call import call
from alchemy import insert_compet
from urlsoup import convert
from urldetails import send_detail

details=send_detail()
name='thrillophilia'
class thrillo(call):
	def run(self):
		comp_id=details[name]['comp_id'] #c1		
		insert_compet(comp_id,details[name]['name'],details[name]['site_url'])
		url=details[name]['blog_url']
		soup=convert(url)
		no_of_pages=int(soup.find("div",{"class":"pagenumbers"}).findChildren("a")[2].text)
		count=0
		x=1
		super(thrillo,self).setcompet(details[name]['name'])
		while(x<=no_of_pages):	
			urlboss=details[name]['blog_url']+'?paged_section='+str(x)+'/'
			soup = convert(urlboss)
			arr=[]
			arr=soup.find_all("a",{"class":"button outline"})
#			arr=soup.findAll("a",{"class":"post-readmore"}) arr also changed change 4
			count=self.storeblog(len(arr),x,arr,comp_id)
			x=x+1
	def storeblog(self,num,inc,arr,comp_id):#inc=2
		global no_	
		i=0
		while(i<num):
			i=i+1#i=1
			if(inc==1):
				no_=i
			if(inc>1) and (inc<=4):
				no_=i+(39)+(inc-2)*16
			if(inc>4):
				no_=i+39+(16*3)+(inc-5)*8
			super(thrillo,self).passvalues(no_,i,arr,comp_id)

