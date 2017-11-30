from urlsoup import convert
from alchemy import insert_pin
class ping():
	@classmethod
	def check(self,mstr):
		return mstr=="ping"
	def getdata(self,url):		
		soup = convert(url)
		arr=[]
		dict={"title":soup.find("tr").findChildren("a",{"rel":"nofollow"})}
		return dict
def run(topic):
	url="http://pingroupie.com/?cat="+topic+"&order=0&sort=asc&tq=&dq="
	soup = convert(url)
	length= len(soup.find_all("ul",{"class":"pagination"})[0].findChildren("a"))
	no_of_page= (soup.find_all("ul",{"class":"pagination"})[0].findChildren("a"))[length-2].text
	print "There are total of "+str(no_of_page)+" pages"
	i=1
	while(i<=int(no_of_page)):
		print"			****Page NO:"+str(i)+"****		"
		page_no=i
		url="http://pingroupie.com/?cat="+topic+"&order=0&sort=asc&tq=&dq=&page="+str(page_no)
		soup = convert(url)
		print url
		no_of_rows= len(soup.find_all("tr"))
		print no_of_rows
		j=1
		while(j<no_of_rows):
			dict1={
			 "row no ":str(j),
			 "title": soup.find_all("tr")[j].findChildren("a")[0].text,
			 "link": soup.find_all("tr")[j].findChildren("a")[0]['href'],
			 "description": soup.find_all("tr")[j].findChildren("button")[0]['data-content'],
			 "category": soup.find_all("tr")[j].findChildren("td")[3].text,
			 "pins":soup.find_all("tr")[j].findChildren("td")[4].text,
			 "Collaborators":soup.find_all("tr")[j].findChildren("td")[5].text,
			 "Followers":soup.find_all("tr")[j].findChildren("td")[6].text,
			 "LastCrawl":soup.find_all("tr")[j].findChildren("td")[7].text
											}
			insert_pin(dict1)
			j=j+1
		i=i+1


