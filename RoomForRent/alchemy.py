from flask import Flask 
from flask_sqlalchemy import SQLAlchemy
from config import sendconfig
config=sendconfig()
app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'postgresql://'+config['username']+':'+config['password']+'@'+config['servername']+'/'+config['database']
# change the databse name to which you want to open it goes like 'postgresql://username:password@sever/db_you_want_to_open
app.config['SQLALCHEMY_TRACK_MODIFICATIONS']=True
db = SQLAlchemy(app)
class acre(db.Model):
	__tablename__ = 'acre'
	id = db.Column('id', db.Integer, primary_key=True)
	url=db.Column('url', db.String(1000))
	configuration=db.Column('configuration', db.Text)
	rent=db.Column('rent', db.Integer)
	furnish=db.Column('furnish', db.String(1000))
	address=db.Column('address', db.String(10000))
	description=db.Column('description', db.String(10000))
	postedOnAndByLabel=db.Column('postedOnAndByLabel', db.String(200))
	def __init__(self,url,furnish,configuration,postedOnAndByLabel,rent,address,description):
		self.id=db.session.query(acre).count()+1
		self.url=url
		self.postedOnAndByLabel=postedOnAndByLabel
		self.description=description
		self.address=address
		self.rent=rent
		self.furnish=furnish
		self.configuration=configuration
def insert_acre(url1,dict1):
	db.create_all()
	present=acre.query.filter_by(url=url1).first()
	if not present:			
		a_ob=acre(url1,dict1['furnish'],dict1['configuration'],dict1['postedOnAndByLabel'],dict1['rent'],dict1['address'],dict1['description'])
		db.session.add(a_ob)
		db.session.commit()

def find(amount,start_value=0,limit_no=25):
#	find=acre.query.filter_by(rent=amount).first()
#	row=Blog.query.filter_by(competitor_id=find.id).first()	
#	print row.id
	start=start_value
	no=0
	data=[]
	after=1
	while(no<limit_no):		
		row=acre.query.filter_by(id=(start+1)).first()
#		print row.competitor_id,row.id
		start=start+1
		if(row==None):
			dict1={'data':{'page info':data},'next':''}
			return dict1		
		if row.rent<=amount:
			data.append({'page_id':row.id,'url':row.url,'rent':row.rent})
			after=row.id			
			no=no+1
	dict1={'data':{'page info':data},
	'next':'http://localhost:5000/search?search_value='+str(amount)+'&start='+str(after)+'&limit='+str(limit_no)}
	return dict1

def update(id_value):
	detail=acre.query.filter_by(id=id_value).first()
	dict1={	'id':detail.id,
		'url':detail.url,
		'postedOnAndByLabel':detail.postedOnAndByLabel,
		'description':detail.description,
		'address':detail.address,
		'rent':detail.rent,
		'furnish':detail.furnish,
		'configuration':detail.configuration}
	return dict1























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
def insert_pin(dict):
	db.create_all()
	present=pingroupie.query.filter_by(url=dict['link']).first()
	if not present:			
		a_ob=pingroupie(dict)
		db.session.add(a_ob)
		db.session.commit()

