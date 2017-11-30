from alchemy import insert_blog
from blog import hellotravel,holidify,shoesonloose,triphobo,traveltriangle,thrillophilia,travel
#from thrillophilia import 
#from holidify import holidify
#from triphobo import 
#from traveltriangle import 
#from shoesonloose import shoesonloose
class call(object):
	dict1={'seo_title':'None',	
		'seo_desc':'None',
		'seo_tag':'None',
		'cover_image':'None',
		'page_title':'None',
		'page_tag':'None',
		'page_body':'None',
		'published_time':'None',
		'modified_time':'None',	
		'author_image':'None',
		'author_link':'None',
		'author_title':'None',
		'author_desc':'None'}

#change the name to name of site you want to analyze i.e hellotravel,hollidify
#chang1=holidify->hellotravel
	competitor = {"name":"None",
		      "url": "None"}
	def setcompet(self,name,url="None"):
		self.competitor['name']=name
		self.competitor['url']=url

#code tp get url from check.py from blogs page
#code for my factory to choose one among thrillophilia,hellotravel

	def MyFactory(self,compete_name):
		for cls in travel.__subclasses__():
			if cls.check(compete_name):
				return cls()


#print dict1['seo_title'],dict1['seo_tag']

	
	def passvalues(self,no_,i,arr,comp_id):
#3		tn='blog'+str(no_)
		dict1=self.senddata(i,arr)	
		print "done:"			
		insert_blog(comp_id,self.competitor['url'],dict1)		
	def sendblogcount(self):
		return len(arr)
	
	#code to send the dict to another file
	def senddata(self,i,arr):
		j=i-1
		self.competitor['url']=arr[j]['href'] # change in url
		print self.competitor['url']
		clas=self.MyFactory(self.competitor['name'])
		dict=clas.getdata(self.competitor['url'])
		#code for storing values from dict to dict1 present in this file containg 'None' for not present attr
		for values in dict:
			if(dict[values]!=None):
				self.dict1[values]=dict[values]
		
		return self.dict1;
	#change 3 urlboss 'https://www.holidify.com/blog/page/'+str(x)+'/'->'http://www.hellotravel.com/stories'
	

