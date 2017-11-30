from flask import Flask 
from flask_sqlalchemy import SQLAlchemy
from config import sendconfig
config=sendconfig()
app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'postgresql://'+config['username']+':'+config['password']+'@'+config['servername']+'/'+config['database']
# change the databse name to which you want to open it goes like 'postgresql://username:password@sever/db_you_want_to_open
app.config['SQLALCHEMY_TRACK_MODIFICATIONS']=True
db = SQLAlchemy(app)
class page(db.Model):
	__tablename__='page'
	id=db.Column('id', db.BigInteger, primary_key=True)
	name=db.Column('name', db.String(500))
	link=db.Column('link', db.String(1000))
	location=db.Column('location', db.String(1000))
	cover=db.Column('cover', db.String(1000))
	website=db.Column('website', db.String(300))
	about=db.Column('about', db.String(10000))
	likes=db.Column('likes', db.String(1000))
	contact_no=db.Column('contact_no', db.String(1000))
	emails=db.Column('emails', db.String(1000))
	search_keyword=db.Column('search_keyword',db.String(100))
	def __init__(self,id,name,likes,location,cover,website,about,link,contact_no,emails,search):
		self.id=id
		self.link=link
		self.name=name
		self.likes=likes
		self.location=location
		self.cover=cover
		self.website=website
		self.about=about
		self.emails=emails
		self.contact_no=contact_no
		self.search_keyword=search
class competitor(db.Model):
	__tablename__='competitor'
	id=db.Column('id', db.Integer, primary_key=True)
	name=db.Column('name', db.String(100))
	url=db.Column('url', db.String(1000))
	def __init__(self,id,name,url):
		self.id=id
		self.url=url
		self.name=name

class Blog(db.Model):
	__tablename__ = 'blog'
	id = db.Column('id', db.Integer, primary_key=True,autoincrement=True)
	url=db.Column('url', db.String(2000))
	seo_title= db.Column('seo_title', db.String(1000))
	seo_desc=db.Column('seo_desc', db.String(10000))
	seo_tag=db.Column('seo_tag', db.String(1000))
	cover_image=db.Column('cover_image', db.String(1000))
	page_title=db.Column('page_title', db.String(1000))
	page_tag=db.Column('page_tag', db.String(1000))
	page_body=db.Column('page_body', db.Text)
	published_time=db.Column('published_time', db.String(1000))
	modified_time=db.Column('modified_time', db.String(1000))	
	author_image=db.Column('author_image', db.String(1000))
	author_link=db.Column('author_link', db.String(1000))
	author_title=db.Column('author_title', db.String(1000))
	author_desc=db.Column('author_desc', db.String(1000))
	competitor_id=db.Column('competitor_id',db.Integer,db.ForeignKey('competitor.id'))
	def __init__(self,comp_id,url,s_t,s_d,s_tg,c_i,p_t,p_tg,p_b,p_tm,m_t,a_i,a_l,a_t,a_d):
		self.competitor_id=comp_id	 #change in different websites
		self.url=url 
		self.seo_title=s_t
		self.seo_desc=s_d
		self.seo_tag=s_tg
		self.cover_image=c_i
		self.page_title=p_t
		self.page_tag=p_tg
		self.page_body=p_b
		self.published_time=p_tm
		self.modified_time=m_t
		self.author_title=a_t
		self.author_desc=a_d
		self.author_link=a_l
		self.author_image=a_i

class pingroupie(db.Model):
	__tablename__ = 'pingroupie'
	id = db.Column('id', db.Integer, primary_key=True,autoincrement=True)
	url = db.Column('url', db.String(1000))
	title=db.Column('title', db.String(1000))
	description=db.Column('description', db.String(1000))
	category=db.Column('category', db.String(100))
	pins=db.Column('pins', db.Integer)
	Collaborators=db.Column('collaborators', db.Integer)
	Followers=db.Column('followers', db.Integer)
	LastCrawl=db.Column('lastCrawl', db.String(1000))
	def __init__(self,details):
		self.url=details['link']
		self.title=details['title']
		self.description=details['description']
		self.category=details['category']
		self.pins=details['pins']
		self.Collaborators=details['Collaborators']
		self.Followers=details['Followers']
		self.LastCrawl=details['LastCrawl']

def insert_compet(comp_id,name,url):
	db.create_all()
	present=competitor.query.filter_by(id=comp_id).first()
	if not present:			
		c_ob=competitor(comp_id,name,url)#c2
		db.session.add(c_ob)
		db.session.commit()#c last


def insert_blog(comp_id,blog_url,dict1):
	present=Blog.query.filter_by(url=blog_url).first()
	if not present:
		B_ob=Blog(comp_id,blog_url,dict1['seo_title'],dict1['seo_desc'],dict1['seo_tag'],dict1['cover_image'],dict1['page_title'],dict1['page_tag'],dict1['page_body'],dict1['published_time'],dict1['modified_time'],dict1['author_image'],dict1['author_link'],dict1['author_title'],dict1['author_desc'])
		db.session.add(B_ob)
		db.session.commit()


def insert_page(page_info,search):
	db.create_all()
	present=page.query.filter_by(id=page_info['id']).first()
	if not present:
		p_ob=page(page_info['id'],page_info['name'],page_info['likes'],page_info['location'],page_info['cover'],page_info['website'],page_info['about'],page_info['link'],page_info['phone'],page_info['emails'],search)
		db.session.add(p_ob)
		db.session.commit()


def update(id_value):
	detail=Blog.query.filter_by(id=id_value).first()
	dict1={'seo_title':detail.seo_title,	
		'seo_desc':detail.seo_desc,
		'seo_tag':detail.seo_tag,
		'cover_image':detail.cover_image,
		'page_title':detail.page_title,
		'page_tag':detail.page_tag,
		'page_body':detail.page_body,
		'published_time':detail.published_time,
		'modified_time':detail.modified_time,	
		'author_image':detail.author_image,
		'author_link':detail.author_link,
		'author_title':detail.author_title,
		'author_desc':detail.author_desc}
	
	
	print detail.id
	return dict1


def find(search,start_value=0,limit_no=25):
	find=competitor.query.filter_by(name=search).first()
#	row=Blog.query.filter_by(competitor_id=find.id).first()	
#	print row.id
	start=start_value
	no=0
	data=[]
	after=1

	while(no<limit_no):
		row=Blog.query.filter_by(id=(start+1)).first()
#		print row.competitor_id,row.id
		start=start+1
		if(row==None):
			dict1={'data':{'page info':data},'next':''}
			return dict1		
		if row.competitor_id==find.id:
			data.append({'page_id':row.id,'url':row.url})
			after=row.id			
			no=no+1
	dict1={'data':{'page info':data},'next':'http://localhost:5000/search?search_value='+str(search)+'&start='+str(after)+''+str(limit_no)}
	return dict1
def find_fb(search,start_value=0,limit_no=25):
	find=page.query.filter_by(search_keyword=search)
	no=start_value
	print no
	data=[]
	limit_no+=no
	while(no<limit_no):
		try:
			data.append({'id':find[no].id,'url':find[no].link})
			no=no+1
		except IndexError:
			dict1={'data':{'page info':data},'next':''}
			return dict1
	dict1={'data':{'page info':data},'next':'http://localhost:5000/search?search_value='+str(search)+'&start='+str(no)+'&limit='+str(limit_no-start_value)}
	return dict1
#print find_fb("travel_agent",120,35)
def update_fb(id_value):
	detail=page.query.filter_by(id=id_value).first()
	dict1={'name':detail.name,
		'link':detail.link,
		'location':detail.location,
		'cover':detail.cover,
		'website':detail.website,
		'about':detail.about,
		'likes':detail.likes,
		'contact_no':detail.contact_no,
		'emails':detail.emails		
		}
	print detail.id
	return dict1
	
#print update_fb(301395993643410L)	

def insert_pin(dict):
	db.create_all()
	present=pingroupie.query.filter_by(url=dict['link']).first()
	if not present:			
		a_ob=pingroupie(dict)
		db.session.add(a_ob)
		db.session.commit()

