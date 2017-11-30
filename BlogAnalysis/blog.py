from urlsoup import convert
class travel(object):
	def getdata(self,url):
 		raise notImplementedError()
class thrillophilia(travel):
	@classmethod
	def check(self,mstr):
		return mstr=="thrillophilia"
	def getdata(self,url):		
		soup = convert(url)
		father=soup.find_all("div",{"class":"badge"})[0]
		page_tags=father.findChildren()
		page_tags.pop()
		page_tags_data=[]
		for values in page_tags:
			page_tags_data.append(values.text)		
		
		dict={'seo_title':soup.title.text,
			'seo_desc':soup.findAll("meta", { "property" : "og:description" })[0]['content'],
 			'seo_tag':soup.find("meta", {"property" : "article:tag"})['content'] if soup.find("meta", {"property" : "article:tag"}) else None,
			'cover_image':soup.findAll("meta", { "property" : "og:image" })[0]['content'],
			'page_title':soup.h1.text,
			'page_tag':page_tags_data[0],
			'page_body':soup.find_all("div",{"class":"postcontent content"})[0].text,
			'published_time':soup.findAll("meta", { "property" : "article:published_time" })[0]['content'],
			'modified_time':soup.findAll("meta", { "property" : "article:modified_time" })[0]['content'] if soup.findAll("meta", { "property" : "article:modified_time" }) else None,
			'author_image':soup.find_all("img",{"class":"avatar avatar-38 photo"})[0]['src'],
			'author_link':soup.find_all("a",{"rel":"author"})[0].text}
		return dict
class hellotravel(travel):
	@classmethod
	def check(self,mystr):
		return mystr=="hellotravel"
	def getdata(self,url):
		soup = convert(url)
		dict={'seo_title':soup.title.text,
			'cover_image':soup.findAll("meta", { "property" : "og:image" })[0]['content'] if soup.findAll("meta", { "property" : "og:image" })[0]['content'] else 'None',
			'page_title':soup.h1.text,
			'page_body':soup.findAll("div", { "class" : "fl bg_cont w_lt pd20" })[0].text
			}
		return dict
class holidify(travel):
	@classmethod
	def check(self,mystr):				
		return mystr=="holidify"	
	def getdata(self,url):		
		soup=convert(url)
		if soup.find_all("div",{"class":"authorsure-author-box"}):
			father=soup.find_all("div",{"class":"authorsure-author-box"})[0]  
			children=father.findChildren()
			author_info=children[len(children)-1].text
		else:
			author_info='None'	
		page_tags=soup.findAll("a", {"rel" : "category tag"})[0]
		page_tags_data=	soup.findAll("a", {"rel" : "category tag"})[0].text		
		'''page_tags_data=[]	
		for values in page_tags:
			page_tags_data.append(values.text)'''
		dict={}
		dict={'seo_title':soup.title.text,
		      'seo_desc':soup.findAll("meta", { "property" : "og:description" })[0]['content'],
			'page_title':soup.findAll("a", { "rel" : "bookmark" })[0].text,
			'page_tag':page_tags_data,	
			'page_body':soup.findAll("div", { "class" : "post-bodycopy" })[0].text if soup.findAll("div", { "class" : "post-bodycopy" }) else 'None',
			'published_time':soup.findAll("meta", { "property" : "article:published_time" })[0]['content'],
			'modified_time':soup.findAll("meta", { "property" : "article:modified_time" })[0]['content'] if soup.findAll("meta", { "property" : "article:modified_time" }) else 'None',
			'author_image':soup.find_all("img",{"class":"avatar avatar-60 photo"})[0]['src'] if soup.find_all("img",{"class":"avatar avatar-60 photo"}) else 'None',
			'author_title':soup.h4.text if soup.h4 else 'None',
			'author_desc':author_info}
		return dict
			
class shoesonloose(travel):
	@classmethod
	def check(self,mstr):
		return mstr=="shoesonloose"
	def getdata(self,url):		
		soup = convert(url)
		dict={'seo_title':soup.title.text,
			'seo_desc':soup.findAll("meta", { "property" : "og:description" })[0]['content'],
			'seo_tag':soup.find("meta",{"name":"keywords"})['content'],
			'cover_image':soup.findAll("meta", { "property" : "og:image" })[0]['content'],
			'page_title':soup.h1.text,
			'page_body':soup.find("div",{"id":"blogContent"}).text,	
			'author_image':soup.find("img",{"alt":"avatar"})['src'],
			'author_title':soup.h3.text,
			'author_desc':soup.find("div",{"class":"authorDiv"}).text	
		}	
		return dict	
class traveltriangle(travel):
	@classmethod
	def check(self,mstr):
		return mstr=="traveltriangle"
	def getdata(self,url):		
		soup = convert(url)
		i=0
		seo_tags_arr=[]
		while(i<len(soup.findAll("meta", {"property" : "article:tag"}))):
			seo_tags_arr.append(soup.find_all("meta", {"property" : "article:tag"})[i]['content'])
			i=i+1
		seo_tags=",".join(seo_tags_arr)
		dict={'seo_title':soup.title.text,
		'seo_desc':soup.findAll("meta", { "property" : "og:description" })[0]['content'],
		'seo_tag':seo_tags,
		'cover_image':soup.findAll("meta", { "property" : "og:image" })[0]['content'],
		'page_title':soup.h1.text,
		'page_body':soup.article.text,	
		'published_time':soup.findAll("meta", { "property" : "article:published_time" })[0]['content'],
		'modified_time':soup.findAll("meta", { "property" : "article:modified_time" })[0]['content'] if soup.findAll("meta", 	{ "property" : "article:modified_time" }) else None,
		'author_link':soup.find_all("a",{"rel":"author"})[0]['href']}
		return dict	
class triphobo(travel):
	@classmethod
	def check(self,mstr):
		return mstr=="triphobo"
	def getdata(self,url):		
		soup = convert(url)
		dict={'seo_title':soup.title.text,
		'seo_desc':soup.findAll("meta", { "property" : "og:description" })[0]['content'],
		'seo_tag':soup.find("meta",{"name":"keywords"})['content'],
		'page_title':soup.h1.text,
		'page_tag':soup.find("div",{"class":"blog-info"}).findChildren('li')[3].text,		
		'page_body':soup.find("div",{"id":"main_blog_div"}).text,	
		'published_time':soup.find("div",{"class":"blog-info"}).findChildren('li')[1].text,
		'author_image':soup.find("div",{"class":"author-image"}).findChildren('img')[0]['src'],
		'author_title':soup.find("div",{"class":"author-image"}).findChildren('span')[0].text,
		'author_desc':soup.find("div",{"class":"author-desc"}).findChildren('p')[1].text }
		return dict	


