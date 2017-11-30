def convert(url):
	from bs4 import BeautifulSoup
	import urllib2
	req = urllib2.Request(url)
	req.add_header('User-Agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 	Safari/537.36')
	resp = urllib2.urlopen(req).read()
	soup = BeautifulSoup(resp, 'html.parser')
	return soup

