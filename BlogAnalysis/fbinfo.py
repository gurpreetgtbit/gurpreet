import urllib2
import json
import sys
import facebook
from alchemy import insert_page
def run(token,search_value):
	url='https://graph.facebook.com/search?q='+search_value+'&type=page&access_token='+token+'&limit=1'
	graph = facebook.GraphAPI(access_token=token, version='2.7')
	j=0	
	while(True):
		j=j+1
		try:	
			api_request = urllib2.Request(url)
			api_response = urllib2.urlopen(api_request)
			data= json.loads(api_response.read())
			url= data['paging']['next']
			arr=['id','name','likes','location','cover','website','about','link','emails','phone']	
			val=data['data']
			for i in val:
				page=fb_api(i['id'],token)		
				print"page id:",i['id']
				for val in arr :
					try:
						page[val]=page[val]
					except KeyError:
						page[val]='None'	
				loc_arr=[]
				if page['location']!='None':
					for val in  page['location']:
						try:
							loc_arr.append(str(page['location'][val]))	
						except UnicodeEncodeError:
							loc_arr.append((page['location'][val]).encode('utf-8'))
				page['location']=','.join(loc_arr)if page['location']!='None' else 'None'
				page['cover']=page['cover']['source'] if page['cover']!='None' else 'None'
				page['emails']=','.join(page['emails'])if page['emails']!='None' else 'None'
				insert_page(page,search_value)
				print"done"
		except KeyError:
			break
def fb_api(page_id,access_token):
    api_endpoint = "https://graph.facebook.com/v2.4/"
    fb_graph_url = api_endpoint+page_id+"?fields=id,name,likes,location,phone,emails,cover,website,about,link&access_token="+access_token
    api_request = urllib2.Request(fb_graph_url)
    api_response = urllib2.urlopen(api_request)    
    return json.loads(api_response.read())

