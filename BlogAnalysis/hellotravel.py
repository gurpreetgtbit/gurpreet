from call import call
from alchemy import insert_compet
from urlsoup import convert
from urldetails import send_detail
details=send_detail()
name='hellotravel'
class hello(call):
	def run(self):
		comp_id=details[name]['comp_id'] #c1		
		insert_compet(comp_id,details[name]['name'],details[name]['site_url'])#c2
		no_of_pages=1	
		x=1
		super(hello,self).setcompet(details[name]['name'])
		while(x<=no_of_pages):
			urlboss=details[name]['blog_url']
			soup = convert(urlboss)
			arr=[]
			arr=soup.find("div",{"class":"itemscontainer offset-1"}).findChildren("a")
		#	arr=soup.findAll("a",{"class":"post-readmore"}) arr also changed change 4
			i=0
			while(i<len(arr)):
				arr[i]['href']='https://www.'+name+'.com/'+arr[i]['href'] if 'https://www.'+name+'.com/' not in arr[i]['href'] else arr[i]['href']		
				i=i+1		
			self.storeblog(len(arr),x,arr,comp_id)
			x=x+1
	
	def storeblog(self,num,inc,arr,comp_id):
		i=0
		while(i<num):
			i=i+1
			no_=i+(inc-1)*10
			super(hello,self).passvalues(no_,i,arr,comp_id)


