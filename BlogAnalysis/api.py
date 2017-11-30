from flask import Flask, abort, request, jsonify
from flask import Flask,render_template,redirect, url_for, request
from flask_sqlalchemy import SQLAlchemy
from config import sendconfig
from alchemy import find,update


config=sendconfig()
app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'postgresql://'+config['username']+':'+config['password']+'@'+config['servername']+'/'+config['database']
# change the databse name to which you want to open it goes like 'postgresql://username:password@sever/db_you_want_to_open
app.config['SQLALCHEMY_TRACK_MODIFICATIONS']=True
db = SQLAlchemy(app)
db.init_app(app)

#for getting url information

@app.route('/search', methods=['GET', 'POST'])
def view():
	search_value=request.args.get('search_value')
	start=0 if request.args.get('start')==None else int(request.args.get('start'))  
	limit=25 if request.args.get('limit')==None else int(request.args.get('limit'))
	dict1=(find(search_value,start,limit))
	return jsonify(dict1)	

#for getting page information
@app.route('/api/v1/blog/<page_id>', methods=['GET', 'POST'])
def viewPage(page_id):
	return jsonify(update(page_id))	
if __name__=='__main__':
	app.run(debug=True)

