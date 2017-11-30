from flask import Flask, abort, request, jsonify
from flask import Flask ,render_template,request
from flask_sqlalchemy import SQLAlchemy
from config import sendconfig
from alchemy import *
from flask_wtf import Form
from wtforms import TextField

config=sendconfig()
app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'postgresql://'+config['username']+':'+config['password']+'@'+config['servername']+'/'+config['database']
# change the databse name to which you want to open it goes like 'postgresql://username:password@sever/db_you_want_to_open
app.config['SQLALCHEMY_TRACK_MODIFICATIONS']=True
db = SQLAlchemy(app)
db.init_app(app)


@app.route('/search', methods=['GET', 'POST'])
def login():
    search = None
    if request.method == 'POST':
	if request.form['search']!=None:
	        search=request.form['search']
	        start=request.form['start'] if (request.form['start']!='') else 0 
	        limit=request.form['limit'] if request.form['limit']!='' else 25
		start=int(start) 
		limit=int(limit)
		dict1=find(search,start,limit)
		if dict1['next']!='':
			dict1=dict1['data']
			dict1['next']={'url':'http://localhost:5000/welcome','search':search,'start':dict1['page info'][len(dict1['page info'])-1]['page_id'],'limit':limit}
		else:
			dict1['next']="No Further Results:( :("
		return render_template('login.html',dict1=dict1,search=search,start=start)
    return render_template('login.html',search=search)

@app.route('/api/v2/events/page', methods=['GET', 'POST'])
def view_page():
	page_id = None
        if request.method == 'POST':
		if request.form['page_id']!=None:
		        page_id=request.form['page_id']
		        dict1=update(page_id)
			return render_template('form.html',page_id=page_id,dict1=dict1)
        return render_template('form.html',page_id=page_id)


if __name__=='__main__':
	app.run(debug=True)
