import scrapy
import requests
import json
from time import sleep

class ManywebsiteSpider(scrapy.Spider):
    name = 'manyWebsite'

    def start_requests(self):
        response = requests.get("http://45.76.154.59:8080/api/comic?all=true")
        json_response = response.json()

        json_response = json_response['data']
        jumlah_comic = len(json_response)
        for item in json_response:
            id_comic = str(item['id'])
            response_comic = requests.get("http://45.76.154.59:8080/api/result?id_comic=" + id_comic)
            json_response_comic = response_comic.json()
            json_response_comic = json_response_comic['data']['results']
            
            # print( item['name'])
            jumlah_web = len(json_response_comic)
            for result in json_response_comic:
                if result:
                    web = result['web']['url']
                    if web == "readmng.com" or web == "mangastream.cc" or web == "mangaeden.com" or web == "mangainn.net" or web == "funmanga.com":
                        domain = 'https://www.'+web+result['short_url']
                    elif web == "manganelo.today" or web == "manga-here.online" or web == "fanfox.net" or web == "mangahasu.se":
                        domain = 'http://'+web+result['short_url']
                    elif web == "mangahere.cc":
                        domain = 'http://www.'+web+result['short_url']
                    elif web == "mangafox.online":
                        domain = 'https://ww3.'+web+result['short_url']
                    elif web == "mangakakalots.com":
                        domain = 'https://ww1.'+web+result['short_url']
                    else :
                        domain = 'https://'+web+result['short_url']
                    yield scrapy.Request(url=domain,callback = self.parse, meta={
                                                                                'domain':result['web']['url'],
                                                                                'xpath_chapter':result['web']['xpath_chapter'],
                                                                                'xpath_last_update':result['web']['xpath_last_update'], 
                                                                                'id' : result['id'],
                                                                                'id_comic' : id_comic,
                                                                                'nama_comic' : str(item['name']),
                                                                                'jumlah_comic' : jumlah_comic,
                                                                                'jumlah_web' : jumlah_web
                                                                                })
            sleep(5) 
    
    # def response_is_ban(self, request, response):
    #     return b'banned' in response.body

    # def exception_is_ban(self, request, exception):
    #     return None
    
    def parse(self, response):
        if response.status:
            id_comic = response.meta['id_comic']
            domain = response.meta['domain']
            xpath_chapter = response.meta['xpath_chapter']
            xpath_chapter = "//body"+ str(xpath_chapter)
            last_chapter = response.xpath(xpath_chapter).extract_first()

            xpath_last_update = response.meta['xpath_last_update']
            xpath_last_update = "//body"+ str(xpath_last_update)
            last_update = response.xpath(xpath_last_update).extract_first()

            if last_chapter == None:
                last_chapter = 'Down'
            else:
                last_chapter = str(last_chapter).replace('\t', '').replace('\n','').replace('Dr.','Dr ').replace('Ch.','Ch ').replace('  ', '').replace(' -', '')

                if domain == "mangahere.cc" or domain == "mangapark.net" or domain == "mangahasu.se":
                    if domain == "mangahere.cc":
                        last_chapter = last_chapter.replace("Ch.","Ch ")
                    elif domain =="mangapark.net":
                        last_chapter = last_chapter.replace("ch.","Ch ")

                    search = last_chapter.find("Ch")
                    if search > 0 :
                        last_chapter = last_chapter[search:]

                    if domain == "mangahasu.se":
                        search = last_chapter.find(":")
                        if search > 0 :
                            last_chapter = last_chapter[:search]

                elif domain == "mangaowl.net" or domain == "mangaeden.com" or domain == "mangafox.online" or domain == "kissmanga.org" or domain == "m.mangabat.com" or domain == "mangakakalots.com":
                    search = last_chapter.find(":")
                    if search > 0 :
                        last_chapter = last_chapter[:search]

                if id_comic == "48" :
                    last_chapter = last_chapter.replace('4000', 'fourOOO')
                elif id_comic == "44" :
                    last_chapter = last_chapter.replace('2020', 'twoOOO')
                elif id_comic == "37" :
                    last_chapter = last_chapter.replace('o.', 'o ')
                elif id_comic == "55" :
                    last_chapter = last_chapter.replace('80,000', 'eightOOOO').replace('80000', 'eightOOOO')
            
            if last_update == None:
                last_update = 'Down'
            else:
                last_update = str(last_update).replace('\t', '').replace('\n','').replace('  ', '')

        else:
            last_chapter = 'Down'
            last_update = 'Down'


        url = "http://45.76.154.59:8080/api/result/" + str(response.meta['id'])
        headers = {'Authorization': None, "Content-Type": "application/json"}
        data = {
                    "last_chapter" : last_chapter,
                    "last_update" : last_update,
                }
        api_laravel = requests.put(url, data=json.dumps(data), headers=headers)
        # my_ip = response.xpath('//body/text()').re('\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}')[0]



        # data = {"URL": response.request.url, "XPATH":xpath_chapter  , "XPATH2":xpath_last_update, "domain":domain  ,"Last Chapter":last_chapter, "Last Update":last_update, "Api_Laravel": api_laravel}
        data = {'jumlah_comic': response.meta['jumlah_comic'],'jumlah_web': response.meta['jumlah_web'],'id_comic': response.meta['id_comic'],'nama_comic': response.meta['nama_comic'],'id_result': response.meta['id'], "Api_Laravel": api_laravel}
        yield data
