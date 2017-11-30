from urlsoup import convert

class acres():
	@classmethod
	def check(self,mstr):
		return mstr=="99acres"
	def getdata(self,url):		
		soup = convert(url)
		arr=[]
		a= soup.find("div",{"id":"furnishing"}).findChildren("div") if(soup.find("div",{"id":"furnishing"})) else 'Null'
		if(a!='Null'):
			for val in a:
				v=val.findChildren("div",{"class":"opa5"})
				p=val.findChildren("div")
				if(v!=p and(len(p)!=0)):
					arr.append(p[0].text)
		arr2=[]
		arr1= soup.find("div",{"class":"noEllipsis pdFactVal configDetails"}).findChildren("span") if soup.find("div",{"class":"noEllipsis pdFactVal configDetails"}) else None
		if arr1!=None:
			for val in arr1:
				arr2.append(val.text)
		
		dict={"furnish":','.join(arr) if(len(arr)!=0) else 'Null',
			"configuration":','.join(arr2),
			"postedOnAndByLabel":soup.find("span",{"id":"postedOnAndByLabel"}).text,
			"rent":soup.find("span",{"id":"pdPrice2"}).text,
			"address":soup.find("span",{"id":"address"}).text,
			"description":soup.find("div",{"id":"description"}).text
			}
		dict["rent"]=dict["rent"].replace(",","")
		return dict

